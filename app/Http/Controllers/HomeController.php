<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class HomeController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $categories = $this->firebase->getCollection('categories');
        $wishlist = $this->firebase->getUserWishlist(auth()->id());
        return view('home', compact('categories', 'wishlist'));
    }

    public function keranjang()
    {
        $data['cart'] = Cart::where('user_id', auth()->user()->id)->first();
        return view('keranjang.index', $data);
    }

    public function wishlist()
    {
        $data['wishlistItems'] = WishlistItem::whereHas('wishlist', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('wishlist.index', $data);
    }

    public function addToCart()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
            ]);
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', request('product_id'))
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + request('qty'),
            ]);
            return back()->with('success', 'Product added to cart');
        }

        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => request('product_id'),
            'quantity' => request('qty'),
        ]);

        return back()->with('success', 'Product added to cart');
    }

    public function addToWishlist()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $wishlist = Wishlist::where('user_id', auth()->id())->first();

        if (!$wishlist) {
            $wishlist = Wishlist::create([
                'user_id' => auth()->id(),
            ]);
        }

        $wishlistItem = WishlistItem::where('wishlist_id', $wishlist->id)
            ->where('product_id', request('product_id'))
            ->first();

        if ($wishlistItem) {
            return back()->with('success', 'Product already in wishlist');
        }

        WishlistItem::create([
            'wishlist_id' => $wishlist->id,
            'product_id' => request('product_id'),
        ]);

        return back()->with('success', 'Product added to wishlist');
    }

    public function removeFromWishlist()
    {
        $wishlistItem = WishlistItem::where('product_id', request('product_id'))
            ->whereHas('wishlist', function ($query) {
                $query->where('user_id', auth()->id());
            })->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return back()->with('success', 'Product removed from wishlist');
        }

        return back()->with('error', 'Product not found in wishlist');
    }

    public function updateKeranjang(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)
            ->first();

        for ($i = 0; $i < count($request->product_id); $i++) {
            CartItem::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id[$i])
                ->update([
                    'quantity' => $request->quantity[$i],
                ]);
        }

        return back()->with('success', 'Cart updated successfully');
    }

    public function checkout()
    {
        $cart = Cart::where('user_id', auth()->user()->id)
            ->first();

        return view('keranjang.checkout', compact('cart'));
    }

    public function processCheckout(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)
            ->first();

        $cartItems = CartItem::where('cart_id', $cart->id)
            ->get();

        if ($cartItems->count() == 0) {
            return back()->with('error', 'Cart is empty');
        }
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'order_date' => now(),
            'total' => $total,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);

            $cartItem->delete();
        }

        $cart->delete();

        return redirect()->route('home')->with('success', 'Checkout success');
    }
}