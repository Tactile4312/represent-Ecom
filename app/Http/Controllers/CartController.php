<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Helper;

class CartController extends Controller
{
    protected $product;
    public function checkout()
{
    $user = Auth::user();
    $carts = Cart::where('user_id', $user->id)->where('order_id', null)->get();
    $totalAmount = session('totalAmount', 0);

    // Add any additional logic you need for the checkout process here.
    // For example, you might want to check if the user's cart is empty or handle payment processing.

    return view('frontend.pages.checkout', compact('carts', 'totalAmount'));
}
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'slug' => 'required|string',
        ]);

        $product = Product::where('slug', $request->slug)->first();

        if (!$product) {
            return back()->with('error', 'Invalid Product');
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)
                            ->where('order_id', null)
                            ->where('product_id', $product->id)
                            ->first();

        if ($already_cart) {
            $already_cart->quantity += 1;
            $already_cart->amount += $product->price;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $already_cart->save();
        } else {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = $product->price - ($product->price * $product->discount / 100);
            $cart->quantity = 1;
            $cart->amount = $cart->price * $cart->quantity;

            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $cart->save();
            Wishlist::where('user_id', auth()->user()->id)
                    ->where('cart_id', null)
                    ->update(['cart_id' => $cart->id]);
        }

        $this->updateTotalAmount();

        return back()->with('success', 'Product has been added to cart');
    }

    public function singleAddToCart(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please sign in to add products to the cart.');
        }

        $request->validate([
            'slug' => 'required|string',
            'quant' => 'required|array',
            'quant.*' => 'integer|min:1',
        ]);

        $product = Product::where('slug', $request->slug)->first();

        if (!$product || $product->stock < $request->quant[1]) {
            return back()->with('error', 'Out of stock, You may choose another products.');
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)
                            ->where('order_id', null)
                            ->where('product_id', $product->id)
                            ->first();

        if ($already_cart) {
            $already_cart->quantity += $request->quant[1];
            $already_cart->amount += $product->price * $request->quant[1];

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $already_cart->save();
        } else {
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = $product->price - ($product->price * $product->discount / 100);
            $cart->quantity = $request->quant[1];
            $cart->amount = $cart->price * $cart->quantity;

            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) {
                return back()->with('error', 'Stock not sufficient!');
            }

            $cart->save();
        }

        $this->updateTotalAmount();

        return back()->with('success', 'Product has been added to cart.');
    }




    public function cartDelete(Request $request)
    {
        $cart = Cart::find($request->id);

        if ($cart) {
            $cart->delete();
            $this->updateTotalAmount();
            return back()->with('success', 'Cart removed successfully');
        }

        return back()->with('error', 'Error please try again');
    }

    public function cartUpdate(Request $request)
{
    $request->validate([
        'quant' => 'required|array',
        'quant.*' => 'integer|min:1',
        'qty_id' => 'required|array',
        'qty_id.*' => 'integer|exists:carts,id',
    ]);

    $error = [];
    $totalAmount = 0;

    foreach ($request->quant as $k => $quant) {
        $id = $request->qty_id[$k];
        $cart = Cart::find($id);

        if ($cart && $quant > 0) {
            if ($cart->product->stock < $quant) {
                return back()->with('error', 'Out of stock');
            }

            $cart->quantity = $quant;
            $cart->amount = ($cart->product->price - ($cart->product->price * $cart->product->discount / 100)) * $quant;
            $cart->save();
            $totalAmount += $cart->amount;
        } else {
            $error[] = 'Cart Invalid!';
        }
    }

    if (!empty($error)) {
        return back()->with('error', implode(', ', $error));
    }

    $this->updateTotalAmount();

    return back()->with('success', 'Cart updated successfully!')->with('totalAmount', $totalAmount);
}

private function updateTotalAmount()
{
    $carts = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
    $totalAmount = 0;

    foreach ($carts as $cart) {
        $totalAmount += $cart->amount;
    }

    session()->put('totalAmount', $totalAmount);
}

}
