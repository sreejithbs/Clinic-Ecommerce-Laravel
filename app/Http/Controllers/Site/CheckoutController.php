<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Cart;
use Stripe\Stripe;
use Stripe\Charge;

use App\Models\User;
use App\Models\UserOrder;
use App\Models\UserAddress;
use App\Models\Admin\InventoryLog;

class CheckoutController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * View Checkout Page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function createCheckout()
	{
		return view('_shop.checkout');
	}

	/**
	 * Initialize the stripe mode with token
	 */
	public static function initializeStripe()
	{
		$stripeCreds = config('services.stripe');
		try{
			if($stripeCreds['mode'] === 'test') {
				Stripe::setApiKey($stripeCreds['test_secret']);
			} elseif($mode === 'live') {
				Stripe::setApiKey($stripeCreds['live_secret']);
			}
		} catch(\Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function storeCheckout(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'phone_number' => 'required',
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zip_code' => 'required',
			'country' => 'required',
			'card_holder_name' => 'required',
			'card_expiry_month' => 'required',
			'card_expiry_year' => 'required',
			'card_last_4' => 'required',
			'stripeToken' => 'required',
		]);

		DB::beginTransaction();

		try {

			$user = Auth::guard('web')->user();

			$customer_address = new UserAddress();
			$customer_address->userId = $user->id;
			$customer_address->firstName = $request->first_name;
			$customer_address->lastName = $request->last_name;
			$customer_address->phoneNumber = $request->phone_number;
			$customer_address->address1 = $request->address;
			$customer_address->city = $request->city;
			$customer_address->state = $request->state;
			$customer_address->zipCode = $request->zip_code;
			$customer_address->country = $request->country;
			$customer_address->save();

		    $lastEntryId = UserOrder::latest()->first();
		    $order_reference_num = "order#" . ($lastEntryId ? $lastEntryId->id + 101 : 101);
		    $date_time = Carbon::now();

		    $user_order = new UserOrder();
		    $user_order->isWalkinCustomer = 0;
		    $user_order->userId = $user->id;
		    $user_order->orderRefNum = $order_reference_num;
		    $user_order->dateTime = $date_time;
		    $user_order->grossTotal = $user_order->netTotal = Cart::getTotal();
		    $user_order->customerAddressId = $customer_address->id;
		    $user_order->notes = $request->notes;
		    $user_order->orderStatus = $user_order->paymentStatus = 'processing';
		    $user_order->saleChannel = 'ecommerce';
		    $user_order->save();

		    $items = Cart::getContent();
		    foreach($items as $item){
		    	$openingQty = $item->model->stockQuantity;
		    	$deductQty = (int)$item->quantity;
		    	$item->model->decrement('stockQuantity', $deductQty); // Decrement Overall Stock Qty

		    	$user_order->products()->attach($item->model->id, ['quantity' => $deductQty, 'subTotal' => $item->getPriceSum()]);

		    	$inventory_log = new InventoryLog();
		    	$inventory_log->refNum = $order_reference_num;
		    	$inventory_log->logEvent = static::LOG_ECOMMERCE_SALE;
		    	$inventory_log->eventCode = static::STATUS_ECOMMERCE_SALE;
		    	$inventory_log->dateTime = $date_time;
		    	$inventory_log->openingQty = $openingQty;
		    	$inventory_log->quantity = $deductQty;
		    	$inventory_log->closingQty = $item->model->stockQuantity;
		    	$inventory_log->relatedEntryModel = 'App\Models\UserOrder';
		    	$inventory_log->relatedEntryModelId = $user_order->id;
		    	$item->model->inventory_logs()->save($inventory_log);
		    }

		    DB::commit();

		    // ************************ Payment Processing *******************************
		    try{
		    	self::initializeStripe();

		    	// Register a Customer
		    	$customer = \Stripe\Customer::create(array(
		    		"email" => $user->email,
		    		"name" => $user->name,
		    		"description" => 'Customer created during Order Creation',
		    		"metadata" => array(
		    			'user_unqId' => $user->unqId,
		    		),
		    		"source" => $request->stripeToken, // obtained with Stripe.js
		    	));

		    	// Charge a customer
		    	$charge = \Stripe\Charge::create(array(
		    		"customer" => $customer->id,
		    		"amount"   => (int)Cart::getTotal() * 100, // amount in cents converted to dollars
		    		"currency" => 'usd',
		    		"description" => "Payment for " . ucfirst($order_reference_num) . " | Inner Beauty",
		    		"metadata" => array(
		    			'user_order_unqId' => $user_order->unqId,
		    		),
		    		// "receipt_email" => 'sreejithbs2017@gmail.com',
		    	));

		    	// Update Payment Status
		    	$user_order->paymentStatus = 'completed';
		    	$user_order->save();

		    	Cart::clear();

		    } catch (\Stripe\Error\InvalidRequest $e) {
		    	dump('1');
		    	dd($e);
		    } catch (\Stripe\Error\Card $e) {
		    	dump('2');
		    	dd($e);
		    } catch (\Stripe\Exception\CardException $e) {
		    	// Since it's a decline, Exception\CardException will be caught
		    	dump('3');
		    	dd($e->getError()->message);
		    	echo 'Status is:' . $e->getHttpStatus() . '\n';
		    	echo 'Type is:' . $e->getError()->type . '\n';
		    	echo 'Code is:' . $e->getError()->code . '\n';
		    	// param is '' in this case
		    	echo 'Param is:' . $e->getError()->param . '\n';
		    	echo 'Message is:' . $e->getError()->message . '\n';
		    } catch (\Stripe\Exception\RateLimitException $e) {
		    	// Too many requests made to the API too quickly
		    	dump('4');
		    	dd($e);
		    } catch (\Stripe\Exception\InvalidRequestException $e) {
		    	// Invalid parameters were supplied to Stripe's API
		    	dump('5');
		    	dd($e->getError()->message);
		    } catch (\Stripe\Exception\AuthenticationException $e) {
		    	// Authentication with Stripe's API failed (maybe you changed API keys recently)
		    	dump('6');
		    	dd($e->getMessage());
		    } catch (\Stripe\Exception\ApiConnectionException $e) {
		    	// Network communication with Stripe failed
		    	dump('7');
		    	dd($e->getMessage());
		    } catch (\Stripe\Exception\ApiErrorException $e) {
		    	// Display a very generic error to the user
		    	dump('8');
		    	dd($e);
		    }

		} catch (\Exception $e) {
			dump('10');
			dd($e->getMessage());
		    DB::rollback();
		    // return $e->getMessage();
		    // return back()->withErrors(['error' => static::USER_ORDER_CREATE_FAIL]);
		}

		dd('Your Order (' . $order_reference_num . ') has been placed successfully');

		// return redirect()->route('product.index')->with('success', 'Your Order # ' . $order_number . ' was successful');
	}
}