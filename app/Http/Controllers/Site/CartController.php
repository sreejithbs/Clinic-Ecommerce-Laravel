<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Product;
use Cart;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with('product_images')->latest()->get();
        return view('_shop.home', compact('products'));
    }

    /**
     * View Cart Page
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCart()
    {
        return view('_shop.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart($uuid)
    {
        $product = Product::fetchModelByUnqId($uuid);
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->sellingPrice,
            'quantity' => 1,
            'attributes' => array(
                'image' => asset($product->product_images()->first()->originalImagePath)
            ),
            'associatedModel' => $product
        ));

        return back()->with('success', "$product->title has successfully added to your shopping cart");
    }

    /**
     * Remove an item from cart
     *
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart($uuid)
    {
        Cart::remove($uuid);
        return back();
    }

    /**
     * Clear entire cart
     *
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        Cart::clear();
        return back();
    }
}