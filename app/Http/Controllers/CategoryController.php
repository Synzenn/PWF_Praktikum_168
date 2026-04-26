<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('manage-category');

        return view('category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize('manage-category');

        $validated = $request->validated();

        Category::create($validated);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        Gate::authorize('manage-category');

        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        Gate::authorize('manage-category');

        $category = Category::findOrFail($id);

        $validated = $request->validated();

        $category->update($validated);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        Gate::authorize('manage-category');

        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category berhasil dihapus');
    }
}
