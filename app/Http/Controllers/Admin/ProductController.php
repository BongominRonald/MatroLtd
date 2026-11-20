<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $s = $request->string('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('brand', 'like', "%{$s}%")
                    ->orWhere('origin', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest('id')->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.form', [
            'product' => null,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'origin' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
        ], [
            'name.required' => 'Please enter a product name.',
            'category_id.required' => 'Please select a category for this product.',
            'category_id.exists' => 'The selected category does not exist.',
            'price.required' => 'Please provide a unit price.',
            'price.numeric' => 'The price must be a valid number.',
            'unit.required' => 'Please specify the unit of measure (e.g., MT, Bag, kg).',
            'stock.required' => 'Please enter the available stock quantity.',
            'image_file.image' => 'The uploaded file must be an image (JPEG, PNG, JPG, or WebP).',
            'image_file.max' => 'Image size must not exceed 4MB.',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $data['image'] = 'storage/'.$path;
        }

        $data['slug'] = Str::slug($data['name']).'-'.Str::random(4);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_new'] = $request->boolean('is_new');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('status', 'Product has been added to the catalog successfully.');
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.form', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'origin' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
        ], [
            'name.required' => 'Please enter a product name.',
            'category_id.required' => 'Please select a category for this product.',
            'category_id.exists' => 'The selected category does not exist.',
            'price.required' => 'Please provide a unit price.',
            'price.numeric' => 'The price must be a valid number.',
            'unit.required' => 'Please specify the unit of measure (e.g., MT, Bag, kg).',
            'stock.required' => 'Please enter the available stock quantity.',
            'image_file.image' => 'The uploaded file must be an image (JPEG, PNG, JPG, or WebP).',
            'image_file.max' => 'Image size must not exceed 4MB.',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $data['image'] = 'storage/'.$path;
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_new'] = $request->boolean('is_new');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Product details have been updated successfully.');
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', "Product '{$name}' has been removed from the catalog.");
    }
}
