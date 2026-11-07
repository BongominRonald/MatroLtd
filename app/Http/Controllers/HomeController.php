<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the storefront index / homepage.
     */
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();

        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->latest('id')
            ->take(8)
            ->get();

        // If no featured products, fallback to latest products
        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')->latest('id')->take(8)->get();
        }

        $allProducts = Product::with('category')->latest('id')->take(12)->get();

        $saleProducts = Product::with('category')
            ->whereNotNull('original_price')
            ->whereColumn('original_price', '>', 'price')
            ->latest('id')
            ->take(4)
            ->get();

        $totalStock = Product::sum('stock');
        $productsCount = Product::count();

        return view('index', compact(
            'categories',
            'featuredProducts',
            'allProducts',
            'saleProducts',
            'totalStock',
            'productsCount'
        ));
    }
}
