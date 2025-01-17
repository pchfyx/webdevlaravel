<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(20);
        return view('admin.product_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('product-category')->with('success', 'Product Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.product_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $productCategory = Category::find($id);

        $productCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('product-category')->with('success', 'Product Category updated successfully');
    }

    public function destroy($id)
    {
        $productCategory = Category::find($id);

        $productCategory->delete();

        return redirect()->route('product-category')->with('success', 'Product Category deleted successfully');
    }
}
