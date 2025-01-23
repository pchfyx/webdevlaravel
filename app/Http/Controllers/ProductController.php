<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productIndex()
    {
        $keyword = request('keyword');
        $start_price = request('start_price');
        $end_price = request('end_price');
        $category_id = request('category_id');
        $products = Product::query();
        if ($keyword) {
            $products = $products->where('name', 'LIKE', "%$keyword%");
        }
        if ($start_price) {
            $products = $products->where('price', '>=', $start_price);
        }

        if ($end_price) {
            $products = $products->where('price', '<=', $end_price);
        }

        if ($category_id) {
            $products = $products->where('category_id', $category_id);
        }

        $products = $products->get();
        $categories = Category::all();
        $all_products = Product::all();
        $arrayWishlist = WishlistItem::whereHas('wishlist', function ($query) {
            $query->where('user_id', auth()->id());
        })->pluck('product_id')->toArray();
        return view('products.index', compact('products', 'categories', 'arrayWishlist', 'all_products'));
    }

    public function detailProduct()
    {
        $product = Product::find(request('id'));
        $arrayWishlist = WishlistItem::whereHas('wishlist', function ($query) {
            $query->where('user_id', auth()->id());
        })->pluck('product_id')->toArray();
        return view('products.detail', compact('product', 'arrayWishlist'));
    }

    public function index(Request $request)
    {
        $products = Product::paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'size' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $request->name,
            'size' => $request->size,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath, // Simpan path gambar
        ]);

        return redirect()->route('products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);
        $product = Product::find($id);
        $fields = [
            'name' => $request->name,
            'size' => $request->size,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];

        if ($request->file('image')) {
            $fields['image'] = $request->file('image')->store('images', 'public');
        }
        $product->update($fields);
        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully');
    }
}