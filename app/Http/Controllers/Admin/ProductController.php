<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use File;
use Auth;

use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use App\Models\Admin\InventoryLog;
use StringHelper;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->abs_upload_path = public_path('/uploads/products');
        $this->rel_upload_path = '/uploads/products/';
    }

    // Define Constants
    const IN_STOCK = 'in_stock';
    const OUT_OF_STOCK = 'out_of_stock';
    const PRODUCT_CREATE = 'Product has been added successfully';
    const PRODUCT_UPDATE = 'Product has been updated successfully';
    const PRODUCT_DELETE = 'Product has been deleted successfully';
    const PRODUCT_DELETE_FAIL = 'Something went wrong. Product deletion failure.';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('product_images')->latest()->get();
        return view('_admin.product_listing', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('isSuper'), 403);
        return view('_admin.product_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('isSuper'), 403);
        $this->validate($request, [
            'product_title' => 'required',
            'product_desc' => 'required',
            'product_imgs.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_qty' => 'required',
            'regular_price' => 'required',
            'selling_price' => 'required',
        ]);

        $product = new Product();
        $product->createdByAdminId = Auth::guard('admin')->user()->id;
        $product->title = $request->product_title;
        $product->description = $request->product_desc;
        $product->remarks = $request->remarks;
        $product->initialStockQuantity = $product->stockQuantity = $request->stock_qty;
        $product->regularPrice = $request->regular_price;
        $product->sellingPrice = $request->selling_price;
        if($request->stock_qty == 0){
            $product->stockStatus = static::OUT_OF_STOCK;
        }

        if($product->save() && $request->hasFile('product_imgs')){
            if (!is_dir($this->abs_upload_path)) {
                File::makeDirectory($this->abs_upload_path, 0777, true);
            }
            foreach ($request->product_imgs as $key => $singleImg) {
                $realName = $singleImg->getClientOriginalName();
                $fileName = pathinfo($realName, PATHINFO_FILENAME);
                $fileName = StringHelper::uniqueSlugString($fileName);
                $extension = pathinfo($realName, PATHINFO_EXTENSION);

                $originalImagePath = $fileName.'.'. $extension;

                if($singleImg->move($this->abs_upload_path, $originalImagePath)){
                    $product_img = new ProductImage();
                    $product_img->originalImagePath = $this->rel_upload_path . $originalImagePath;
                    $product->product_images()->save($product_img);
                }
            }
        }

        $inventory_log = new InventoryLog();
        $inventory_log->logEvent = static::LOG_INITIAL_INVENTORY_STOCK;
        $inventory_log->eventCode = static::CODE_INITIAL_INVENTORY_STOCK;
        $inventory_log->dateTime = $product->created_at;
        $inventory_log->openingQty = 0;
        $inventory_log->quantity = $inventory_log->closingQty = $product->stockQuantity;
        $inventory_log->relatedEntryModel = 'App\Models\Admin\Product';
        $inventory_log->relatedEntryModelId = $product->id;
        $product->inventory_logs()->save($inventory_log);

        return redirect()->route('admin_product_list')->with('success', static::PRODUCT_CREATE);
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
    public function edit($uuid)
    {
        $product = Product::fetchModelByUnqId($uuid);
        return view('_admin.product_edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'product_title' => 'required',
            'product_desc' => 'required',
            // 'product_imgs.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'regular_price' => 'required',
            'selling_price' => 'required',
        ]);

        $product = Product::fetchModelByUnqId($uuid);
        $product->title = $request->product_title;
        $product->description = $request->product_desc;
        $product->remarks = $request->remarks;
        $product->regularPrice = $request->regular_price;
        $product->sellingPrice = $request->selling_price;

        // Delete removed entries from existing product images
        $product_images = $product->product_images()->whereNotIn('id', $request->existingImgs)->get();
        foreach ($product_images as $single) {
            $img_path = public_path($single->originalImagePath);
            if (is_file($img_path)) {
                unlink($img_path);
            }
            $single->forcedelete();
        }

        // Save newly uploaded images
        if($product->save() && $request->hasFile('product_imgs')){
            if (!is_dir($this->abs_upload_path)) {
                File::makeDirectory($this->abs_upload_path, 0777, true);
            }
            foreach ($request->product_imgs as $key => $singleImg) {
                $realName = $singleImg->getClientOriginalName();
                $fileName = pathinfo($realName, PATHINFO_FILENAME);
                $fileName = StringHelper::uniqueSlugString($fileName);
                $extension = pathinfo($realName, PATHINFO_EXTENSION);

                $originalImagePath = $fileName.'.'. $extension;

                if($singleImg->move($this->abs_upload_path, $originalImagePath)){
                    $product_img = new ProductImage();
                    $product_img->originalImagePath = $this->rel_upload_path . $originalImagePath;
                    $product->product_images()->save($product_img);
                }
            }
        }

        return redirect()->route('admin_product_list')->with('success', static::PRODUCT_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try{
            $product = Product::fetchModelByUnqId($uuid);

            // Delete Product Images
            $product_images = $product->product_images()->get();
            foreach ($product_images as $single) {
                $img_path = public_path($single->originalImagePath);
                if (is_file($img_path)) {
                    unlink($img_path);
                }
                $single->forcedelete();
            }

            $product->delete();

        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->withErrors(['error' => static::PRODUCT_DELETE_FAIL]);
        }

        return back()->with('success', static::PRODUCT_DELETE);
    }

}