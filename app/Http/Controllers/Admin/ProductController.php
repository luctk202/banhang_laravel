<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Category;
use App\Services\ProductService;

class ProductController extends Controller
{

    protected Category $category;
    protected ProductService $productService;

    public function __construct(Category $category, ProductService $productService)
    {
        $this->category = $category;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $products = $this->productService->getWithPaginate();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = $this->category->get(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }


    public function store(CreateProductRequest $request)
    {
        $this->productService->store($request);
        return redirect()->route('products.index')->with(['message' => 'create product success']);
    }

    public function show($id)
    {
        $product = $this->productService->findOrFail($id)->load(['details', 'categories']);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productService->findOrFail($id)->load(['details', 'categories']);

        $categories = $this->category->get(['id', 'name']);

        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $this->productService->update($request, $id);
        return redirect()->route('products.index')->with(['message' => 'Update product success']);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index')->with(['message' => 'Delete product success']);

    }
}
