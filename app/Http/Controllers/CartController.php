<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the full shopping cart page.
     */
    public function index(): View
    {
        $cart = Session::get('cart', []);
        $items = $this->buildCartItems($cart);
        $subtotal = $items->sum('line_total');

        return view('cart.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'count' => $items->sum('quantity'),
        ]);
    }

    /**
     * Add a product to the shopping cart.
     */
    public function add(Request $request, Product $product): JsonResponse|RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($product->stock < $quantity) {
            $msg = "Only {$product->stock} {$product->unit}(s) available in stock.";
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        $cart = Session::get('cart', []);
        $currentQty = (int) ($cart[$product->id]['quantity'] ?? 0);
        $newQty = $currentQty + $quantity;

        if ($newQty > $product->stock) {
            $newQty = $product->stock;
        }

        $cart[$product->id] = [
            'id' => $product->id,
            'quantity' => $newQty,
        ];

        Session::put('cart', $cart);

        $items = $this->buildCartItems($cart);
        $count = $items->sum('quantity');
        $subtotal = $items->sum('line_total');

        $message = "{$product->name} added to cart ({$newQty} {$product->unit}).";

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'cart_count' => $count,
                'cart_subtotal' => $subtotal,
                'cart_subtotal_formatted' => '$' . number_format($subtotal, 2),
                'items' => $items->values(),
            ]);
        }

        return back()->with('cart_toast', [
            'message' => $message,
            'count' => $count,
        ]);
    }

    /**
     * Update quantity of a product in the cart.
     */
    public function update(Request $request, Product $product): JsonResponse|RedirectResponse
    {
        $quantity = (int) $request->input('quantity', 1);
        $cart = Session::get('cart', []);

        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } else {
            $quantity = min($quantity, $product->stock);
            $cart[$product->id] = [
                'id' => $product->id,
                'quantity' => $quantity,
            ];
        }

        Session::put('cart', $cart);

        $items = $this->buildCartItems($cart);
        $count = $items->sum('quantity');
        $subtotal = $items->sum('line_total');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Cart updated.',
                'cart_count' => $count,
                'cart_subtotal' => $subtotal,
                'cart_subtotal_formatted' => '$' . number_format($subtotal, 2),
                'items' => $items->values(),
            ]);
        }

        return redirect()->route('cart.index')->with('status', 'Cart updated successfully.');
    }

    /**
     * Remove a product from the shopping cart.
     */
    public function remove(Request $request, Product $product): JsonResponse|RedirectResponse
    {
        $cart = Session::get('cart', []);
        unset($cart[$product->id]);
        Session::put('cart', $cart);

        $items = $this->buildCartItems($cart);
        $count = $items->sum('quantity');
        $subtotal = $items->sum('line_total');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => "{$product->name} removed from cart.",
                'cart_count' => $count,
                'cart_subtotal' => $subtotal,
                'cart_subtotal_formatted' => '$' . number_format($subtotal, 2),
                'items' => $items->values(),
            ]);
        }

        return redirect()->route('cart.index')->with('status', 'Item removed from cart.');
    }

    /**
     * Get cart contents as JSON for the slide-out Cart Drawer.
     */
    public function drawer(): JsonResponse
    {
        $cart = Session::get('cart', []);
        $items = $this->buildCartItems($cart);
        $subtotal = $items->sum('line_total');

        return response()->json([
            'status' => 'success',
            'cart_count' => $items->sum('quantity'),
            'cart_subtotal' => $subtotal,
            'cart_subtotal_formatted' => '$' . number_format($subtotal, 2),
            'items' => $items->values(),
        ]);
    }

    /**
     * Clear all items from the cart.
     */
    public function clear(): RedirectResponse
    {
        Session::forget('cart');

        return redirect()->route('cart.index')->with('status', 'Shopping cart cleared.');
    }

    /**
     * Helper to build fully populated cart item collections.
     */
    private function buildCartItems(array $cart)
    {
        if (empty($cart)) {
            return collect();
        }

        $productIds = array_keys($cart);
        $products = Product::with('category')->whereIn('id', $productIds)->get()->keyBy('id');

        return collect($cart)->map(function ($item, $productId) use ($products) {
            $product = $products->get($productId);
            if (! $product) {
                return null;
            }

            $qty = (int) ($item['quantity'] ?? 1);
            $price = (float) $product->price;

            return (object) [
                'id' => $product->id,
                'product' => $product,
                'name' => $product->name,
                'slug' => $product->slug,
                'category_name' => $product->category?->name ?? 'Agro Commodity',
                'price' => $price,
                'price_formatted' => '$' . number_format($price, 2),
                'unit' => $product->unit,
                'image' => $product->image,
                'quantity' => $qty,
                'line_total' => $price * $qty,
                'line_total_formatted' => '$' . number_format($price * $qty, 2),
                'stock' => $product->stock,
            ];
        })->filter();
    }
}
