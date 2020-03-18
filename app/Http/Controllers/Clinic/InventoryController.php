<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Admin\ClinicInventory;
use App\Models\Admin\Product;

class InventoryController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clinic_inventories = Auth::guard('clinic')->user()->inventories()->latest()->get();
        return view('_clinic.inventory_listing', compact('clinic_inventories'));
    }

    /**
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

    // Append New Product Row
    public function appendProduct(Request $request)
    {
        if($request->ajax()){
            $product = Product::fetchModelByUnqId($request->product);
            $clinic_inventory = ClinicInventory::where([
                'productId' => $product->id,
                'clinicId' => Auth::guard('clinic')->id()
            ])->first();

            $contents = view('_clinic.components.inventory_product_child', compact('clinic_inventory'))->render();

            return response()->json(['status' => TRUE, 'renderHtml' => $contents]);
        }
    }
}