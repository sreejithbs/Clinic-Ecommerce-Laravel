<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Product;
use App\Models\Admin\Supplier;
use App\Models\Admin\InventoryPurchase;

use Illuminate\Support\Facades\Validator;
use File;
use DB;
use Auth;
use Carbon\Carbon;
use StringHelper;

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
        $this->abs_upload_path = public_path('/uploads/inventory');
        $this->rel_upload_path = '/uploads/inventory/';
    }

    // Define Constants
    const INVENTORY_PURCHASE_CREATE = 'Inventory Purchase has been added successfully';
    const SUPPLIER_CREATE = 'Supplier has been created successfully';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inventory_purchases = InventoryPurchase::latest()->get();
        return view('_admin.inventory_purchase_listing', compact('inventory_purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::latest()->get();
        $suppliers = Supplier::latest()->get();
        return view('_admin.inventory_purchase_create', compact('products', 'suppliers'));
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
            'quantity' => 'required',
            'supplier' => 'required',
            'purchase_date_time' => 'required',
            'notes' => 'required',
            'purchase_status' => 'required',
            'payment_mode' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $sync_data = [];
            $mainTotal = 0;
            foreach ($request->quantity as $prdt => $qty) {
                $product =  Product::fetchModelByUnqId($prdt);
                $product->increment('stockQuantity', $qty); // Increment Overall Stock Qty

                $subTotal = (float)$product->sellingPrice * (int)$qty;
                $mainTotal += $subTotal;

                // $inventory_purchase->products()->attach($product->id, ['quantity' => $qty, 'subTotalPrice' => $subTotal]);
                $sync_data[$product->id] = ['quantity' => $qty, 'subTotalPrice' => $subTotal];
            }

            $inventory_purchase = new InventoryPurchase();
            $inventory_purchase->createdByAdminId = Auth::guard('admin')->user()->id;
            $inventory_purchase->supplierId = Supplier::fetchModelByUnqId($request->supplier)->id;
            $inventory_purchase->dateTime = InventoryPurchase::createTimestampFromDateTime($request->purchase_date_time);
            $inventory_purchase->totalPrice = $mainTotal;
            $inventory_purchase->notes = $request->notes;

            if($request->hasFile('attachment')){
                if (!is_dir($this->abs_upload_path)) {
                    File::makeDirectory($this->abs_upload_path, 0777, true);
                }

                $realName = $request->attachment->getClientOriginalName();
                $fileName = pathinfo($realName, PATHINFO_FILENAME);
                $fileName = StringHelper::uniqueSlugString($fileName);
                $extension = pathinfo($realName, PATHINFO_EXTENSION);

                $originalImagePath = $fileName.'.'. $extension;

                if($request->attachment->move($this->abs_upload_path, $originalImagePath)){
                    $inventory_purchase->attachment = $this->rel_upload_path . $originalImagePath;
                }
            }

            $inventory_purchase->paymentMode = $request->payment_mode;
            $inventory_purchase->save();

            $inventory_purchase->products()->sync($sync_data);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect()->route('admin_inventory_purchase_list')->with('success', static::INVENTORY_PURCHASE_CREATE);
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

    // Create New Supplier
    public function storeSupplier(Request $request)
    {
        if($request->ajax()){
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:suppliers',
                'phone_number' => 'required|string',
            ]);

            if ($validation->passes()) {

                $supplier = new Supplier();
                $supplier->createdByAdminId = Auth::guard('admin')->user()->id;
                $supplier->name = $request->name;
                $supplier->email = $request->email;
                $supplier->phoneNumber = $request->phone_number;
                $supplier->companyName = $request->company_name;
                $supplier->companyAddress = $request->company_address;
                $supplier->save();

                return response()->json(['status' => TRUE, 'data' => $supplier, 'message' => static::SUPPLIER_CREATE]);
            }

            return response()->json(['status' => FALSE, 'errors' => $validation->errors()]);
        }
    }


    // Append New Product Row
    public function appendProduct(Request $request)
    {
        if($request->ajax()){
            $product = Product::fetchModelByUnqId($request->product);
            $contents = view('components.inventory_product_child', compact('product'))->render();

            return response()->json(['status' => TRUE, 'renderHtml' => $contents]);
        }
    }
}
