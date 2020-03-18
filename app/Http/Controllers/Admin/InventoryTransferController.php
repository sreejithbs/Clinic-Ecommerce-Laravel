<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clinic;
use App\Models\Admin\Product;
use App\Models\Admin\InventoryTransfer;
use App\Models\Admin\ClinicInventory;
use App\Models\Admin\InventoryLog;
use App\Events\InventoryWasTransferredEvent;

use DB;
use Auth;

class InventoryTransferController extends Controller
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
    const INVENTORY_TRANSFER_CREATE = 'Inventory Transfer has been added successfully';
    const INVENTORY_TRANSFER_CREATE_FAIL = 'Something went wrong. Inventory Transfer creation failure.';

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
        $clinics = Clinic::with('clinic_profile')->latest()->get();
        $product =  Product::fetchModelByUnqId($uuid);
        return view('_admin.inventory_transfer_create', compact('product', 'clinics'));
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
            'transfer_reference_num' => 'required',
            'quantity' => 'required|integer|min:1',
            'transfer_date_time' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $deductQty = (int)$request->quantity;
            $clinic = Clinic::fetchModelByUnqId($request->clinic);

            $product = Product::fetchModelByUnqId($uuid);
            $openingQty = $product->stockQuantity;
            $product->decrement('stockQuantity', $deductQty); // Decrement Overall Stock Qty

            $inventory_transfer = new InventoryTransfer();
            $inventory_transfer->createdByAdminId = Auth::guard('admin')->user()->id;
            $inventory_transfer->clinicId = $clinic->id;
            $inventory_transfer->transferRefNum = $request->transfer_reference_num;
            $inventory_transfer->transferNumber = $request->transfer_order_number;
            $inventory_transfer->quantity = $deductQty;
            $inventory_transfer->dateTime = InventoryTransfer::createTimestampFromDateTime($request->transfer_date_time);
            $inventory_transfer->totalPrice = (float)$product->sellingPrice * $deductQty;
            $inventory_transfer->notes = $request->notes;
            $product->inventory_transfers()->save($inventory_transfer);

            $clinic_inventory = ClinicInventory::firstOrNew(['productId' => $product->id, 'clinicId' => $clinic->id]);
            if ($clinic_inventory->exists) {
                $clinic_inventory->increment('stockQuantity', $deductQty);
            } else{
                $clinic_inventory->stockQuantity = $deductQty;
            }
            $clinic->inventories()->save($clinic_inventory);

            $inventory_log = new InventoryLog();
            $inventory_log->refNum = $inventory_transfer->transferRefNum;
            $inventory_log->logEvent = static::LOG_INVENTORY_TRANSFER;
            $inventory_log->eventCode = static::STATUS_INVENTORY_TRANSFER;
            $inventory_log->dateTime = InventoryTransfer::createTimestampFromDateTime($request->transfer_date_time);
            $inventory_log->openingQty = $openingQty;
            $inventory_log->quantity = $inventory_transfer->quantity;
            $inventory_log->closingQty = $product->stockQuantity;
            $inventory_log->relatedEntryModel = 'App\Models\Admin\InventoryTransfer';
            $inventory_log->relatedEntryModelId = $inventory_transfer->id;
            $product->inventory_logs()->save($inventory_log);

            event( new InventoryWasTransferredEvent($clinic, $inventory_transfer, $clinic_inventory) );

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return back()->withErrors(['error' => static::INVENTORY_TRANSFER_CREATE_FAIL]);
        }

        return redirect()->route('admin_inventory_logs_list', $product->unqId )->with('success', static::INVENTORY_TRANSFER_CREATE);
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