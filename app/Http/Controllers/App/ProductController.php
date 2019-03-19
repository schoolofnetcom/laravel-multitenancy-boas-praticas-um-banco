<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('app.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('app.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $categoryUuid = $request->get('category_uuid');
        $category = Category::whereUuid($categoryUuid)->first();
        Product::create($request->all() + ['category_id' => $category->id]);
        return redirect()->route('app.products.index')->;
    }

    public function show(Product $product)
    {
        return view('app.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('app.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $categoryUuid = $request->get('category_uuid');
        $category = Category::whereUuid($categoryUuid)->first();
        $product->update($request->all() + ['category_id' => $category->id]);
        return redirect()->route('app.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('app.products.index');
    }
}
