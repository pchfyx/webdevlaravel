<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productIndex()
    {
        $keyword = request('keyword');
        $products = Product::query();
        if ($keyword) {
            $products = $products->where('name', 'LIKE', "%$keyword%");
        }
        $products = $products->get();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
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
            'name' => 'required',
            'size' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $request->name,
            'size' => $request->size,
            'price' => $request->price,
            'discount' => $request->discount,
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
        try {
            $product = Product::find($id);
            $fields = [
                'name' => $request->name,
                'size' => $request->size,
                'price' => $request->price,
                'discount' => $request->discount,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ];

            if ($request->file('image')) {
                $fields['image'] = $request->file('image')->store('images', 'public');
            }
            $product->update($fields);
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully');
    }
}
