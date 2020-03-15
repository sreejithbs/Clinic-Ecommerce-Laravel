<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Product;
use App\Models\Admin\InventoryPurchase;
use App\Models\Admin\InventoryLog;

use DB;
use Auth;

class InventoryPurchaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Define Constants
    const INVENTORY_PURCHASE_CREATE = 'Inventory Purchase has been added successfully';
    const INVENTORY_PURCHASE_CREATE_FAIL = 'Something went wrong. Inventory Purchase creation failure.';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $product =  Product::fetchModelByUnqId($uuid);
        return view('_admin.inventory_purchase_create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uuid)
    {
        $this->validate($request, [
            'purchase_reference_num' => 'required',
            'quantity' => 'required|integer|min:1',
            'purchase_date_time' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $addQty = (int)$request->quantity;

            $product = Product::fetchModelByUnqId($uuid);
            $openingQty = $product->stockQuantity;
            $product->increment('stockQuantity', $addQty); // Increment Overall Stock Qty

            $inventory_purchase = new InventoryPurchase();
            $inventory_purchase->createdByAdminId = Auth::guard('admin')->user()->id;
            $inventory_purchase->purchaseRefNum = $request->purchase_reference_num;
            $inventory_purchase->purchaseNumber = $request->purchase_order_number;
            $inventory_purchase->quantity = $addQty;
            $inventory_purchase->dateTime = InventoryPurchase::createTimestampFromDateTime($request->purchase_date_time);
            $inventory_purchase->supplier = $request->supplier;
            $inventory_purchase->totalPrice = (float)$product->sellingPrice * $addQty;
            $inventory_purchase->notes = $request->notes;
            $product->inventory_purchases()->save($inventory_purchase);

            $inventory_log = new InventoryLog();
            $inventory_log->refNum = $inventory_purchase->purchaseRefNum;
            $inventory_log->logEvent = static::LOG_INVENTORY_PURCHASE;
            $inventory_log->eventCode = static::STATUS_INVENTORY_PURCHASE;
            $inventory_log->dateTime = InventoryPurchase::createTimestampFromDateTime($request->purchase_date_time);
            $inventory_log->openingQty = $openingQty;
            $inventory_log->quantity = $inventory_purchase->quantity;
            $inventory_log->closingQty = $product->stockQuantity;
            $inventory_log->relatedEntryModel = 'App\Models\Admin\InventoryPurchase';
            $inventory_log->relatedEntryModelId = $inventory_purchase->id;
            $product->inventory_logs()->save($inventory_log);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return back()->withErrors(['error' => static::INVENTORY_PURCHASE_CREATE_FAIL]);
        }

        return redirect()->route('admin_inventory_logs_list', $product->unqId )->with('success', static::INVENTORY_PURCHASE_CREATE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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