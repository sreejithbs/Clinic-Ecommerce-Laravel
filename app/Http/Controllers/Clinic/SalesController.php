<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

use App\Models\Admin\Product;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\Admin\ClinicInventory;
use App\Models\Admin\InventoryLog;

class SalesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:clinic');
    }

    // Define Constants
    const USER_ORDER_CREATE = 'Customer order has been placed successfully';
    const USER_ORDER_CREATE_FAIL = 'Something went wrong. Customer order creation failure.';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_orders = UserOrder::where('saleClinicId', Auth::guard('clinic')->id())->latest()->get();
        return view('_clinic.sales_listing', compact('user_orders'));
    }

    /**', '
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinic_inventories = ClinicInventory::latest()->get();
        $users = User::latest()->get();
        return view('_clinic.sales_create', compact('clinic_inventories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity.*' => 'required|integer|min:1',
            "user" => "required_if:customer_type,==,registered"
        ]);

        DB::beginTransaction();

        try {

            $lastEntryId = UserOrder::latest()->first();
            $order_reference_num = "order#" . ($lastEntryId ? $lastEntryId->id + 101 : 101);
            $date_time = Carbon::now();

            $user_order = new UserOrder();
            $user_order->orderRefNum = $order_reference_num;
            $user_order->dateTime = $date_time;
            $user_order->grossTotal = $user_order->netTotal = 0; //temporary value setting
            $user_order->notes = $request->notes;
            $user_order->orderStatus = $user_order->paymentStatus = 'completed';
            $user_order->saleChannel = 'clinic';
            $user_order->saleClinicId = Auth::guard('clinic')->id();
            if($request->customer_type == 'registered'){
                $user = User::fetchModelByUnqId($request->user);
                $user_order->isWalkinCustomer = 0;
                $user_order->userId = $user->id;
            }
            $user_order->save();

            $mainTotal = 0;
            foreach ($request->quantity as $prd => $deductQty) {  //Looping products
                $product = Product::fetchModelByUnqId($prd);
                $clinic_inventory = ClinicInventory::where([
                    'productId' => $product->id,
                    'clinicId' => Auth::guard('clinic')->id()
                ])->first();
                $openingQty = $clinic_inventory->stockQuantity;
                $clinic_inventory->decrement('stockQuantity', $deductQty); // Decrement Clinic Inventory Stock Qty

                $subTotal = (float)$product->sellingPrice * (int)$deductQty;
                $mainTotal += $subTotal;

                $user_order->products()->attach($product->id, ['quantity' => $deductQty, 'subTotal' => $subTotal]);

                $inventory_log = new InventoryLog();
                $inventory_log->refNum = $order_reference_num;
                $inventory_log->logEvent = static::LOG_CLINIC_SALE;
                $inventory_log->eventCode = static::STATUS_CLINIC_SALE;
                $inventory_log->dateTime = $date_time;
                $inventory_log->openingQty = $openingQty;
                $inventory_log->quantity = $deductQty;
                $inventory_log->closingQty = $clinic_inventory->stockQuantity;
                $inventory_log->relatedEntryModel = 'App\Models\UserOrder';
                $inventory_log->relatedEntryModelId = $user_order->id;
                $product->inventory_logs()->save($inventory_log);
            }

            // Update Total Amount
            $user_order->grossTotal = $user_order->netTotal = $mainTotal;
            $user_order->save();

            // ### TODO
            // Mail Notification Event

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return back()->withErrors(['error' => static::USER_ORDER_CREATE_FAIL]);
        }

        return redirect()->route('clinic_sales_list')->with('success', static::USER_ORDER_CREATE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($uuid)
    {
        $user_order = UserOrder::fetchModelByUnqId($uuid);
        return view('_clinic.sales_view', compact('user_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}