<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index(): View|RedirectResponse
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your shopping cart is empty.');
        }

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $items = collect($cart)->map(function ($item, $id) use ($products) {
            $p = $products->get($id);
            if (! $p) return null;

            $qty = (int) ($item['quantity'] ?? 1);
            return (object) [
                'id' => $p->id,
                'name' => $p->name,
                'price' => (float) $p->price,
                'unit' => $p->unit,
                'quantity' => $qty,
                'line_total' => (float) $p->price * $qty,
                'image' => $p->image,
            ];
        })->filter();

        $subtotal = $items->sum('line_total');

        return view('checkout.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Process checkout and persist the customer order.
     */
    public function store(Request $request): RedirectResponse
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items before checking out.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'country' => ['required', 'string', 'max:100'],
            'company' => ['nullable', 'string', 'max:255'],
            'payment_method' => ['required', 'in:escrow,wire,letter_of_credit,card'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $paymentLabels = [
            'escrow' => 'Escrow Verified Settlement',
            'wire' => 'International Bank Wire Transfer',
            'letter_of_credit' => 'Irrevocable Letter of Credit (LC)',
            'card' => 'Corporate Credit / Debit Card',
        ];

        DB::beginTransaction();

        try {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

            if ($products->count() !== count($productIds)) {
                throw new \Exception('One or more selected products are no longer available in the catalog.');
            }

            $total = 0;
            $orderItemsData = [];

            foreach ($cart as $id => $item) {
                $product = $products->get($id);
                $qty = (int) ($item['quantity'] ?? 1);

                if ($product->stock < $qty) {
                    throw new \Exception("Insufficient stock for '{$product->name}'. Available: {$product->stock} {$product->unit}(s).");
                }

                $lineTotal = (float) $product->price * $qty;
                $total += $lineTotal;

                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $qty,
                    'subtotal' => $lineTotal,
                ];

                // Decrement stock
                $product->decrement('stock', $qty);
            }

            $orderNumber = 'MAT-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            $destination = $validated['shipping_address'] . ', ' . $validated['country'];
            if (! empty($validated['company'])) {
                $destination = "Company: {$validated['company']} | " . $destination;
            }

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => Auth::id(),
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $destination,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $paymentLabels[$validated['payment_method']] ?? 'Escrow Settlement',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($orderItemsData as $itemData) {
                $order->items()->create($itemData);
            }

            DB::commit();

            // Clear session cart
            Session::forget('cart');

            return redirect()->route('orders.confirmation', $order)->with('order_success', true);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->withErrors(['checkout' => $e->getMessage()]);
        }
    }

    /**
     * Display the order receipt and confirmation view.
     */
    public function confirmation(Order $order): View
    {
        $order->load(['items.product', 'user']);

        return view('orders.confirmation', compact('order'));
    }
}
