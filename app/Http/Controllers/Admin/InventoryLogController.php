<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Product;
use App\Models\Admin\InventoryLog;

class InventoryLogController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($uuid)
    {
        $product =  Product::fetchModelByUnqId($uuid);
        $inventory_logs = $product->inventory_logs()->get();
        return view('_admin.inventory_logs_listing', compact('product', 'inventory_logs'));
    }

    /**', '
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($uuid)
    {
        $inventory_log = InventoryLog::fetchModelByUnqId($uuid);
        $statusCode = $inventory_log->eventCode;
        if($statusCode == 0){ // Initial Stock
            $product = $inventory_log->relatedEntryModel::find($inventory_log->relatedEntryModelId);
            $extra_view = 'product';
        } else if($statusCode == 1){ // Purchase
            $inventory_purchase = $inventory_log->relatedEntryModel::find($inventory_log->relatedEntryModelId);
            $extra_view = 'inventory_purchase';
        } else if($statusCode == 2){ // Transfer
            $inventory_transfer = $inventory_log->relatedEntryModel::find($inventory_log->relatedEntryModelId);
            $extra_view = 'inventory_transfer';
        } else{
            return;
        }

        return view('_admin.inventory_log_view', compact('inventory_log', 'statusCode', $extra_view));
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