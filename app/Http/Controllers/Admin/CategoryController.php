<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
        ], [
            'name.required' => 'Please provide a name for this category.',
            'name.unique' => 'A category with this name already exists. Please choose a different name.',
        ]);

        $data['slug'] = Str::slug($data['name']);
        Category::create($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category has been created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
        ], [
            'name.required' => 'Please provide a name for this category.',
            'name.unique' => 'A category with this name already exists. Please choose a different name.',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category details have been updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'This category cannot be deleted because it still contains active products. Please reassign or delete the products first.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category has been deleted successfully.');
    }
}
