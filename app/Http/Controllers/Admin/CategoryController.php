<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->latest('id')->paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCatgories = $this->category->getParents();
        return view('admin.categories.create', compact('parentCatgories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $dataCreat = $request->all();
        $category = $this->category->create($dataCreat);
        return redirect()->route('categories.index')->with(['message' => 'create new category:' . $category->name . "success"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->category->with('childrens')->findOrFail($id);
        $parentCatgories = $this->category->getParents();
        return view('admin.categories.edit', compact('category', 'parentCatgories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataUpdate = $request->all();
        $category = $this->category->findOrFail($id);
        $category->update($dataUpdate);
        return redirect()->route('categories.index')->with(['message' => 'update category:' . $category->name . "success"]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with(['message' => 'delete category:' . $category->name . "success"]);

    }
}
