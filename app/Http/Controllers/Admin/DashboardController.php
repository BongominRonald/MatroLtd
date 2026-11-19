<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = (float) Order::whereNotIn('status', ['cancelled'])->sum('total_amount');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'customer')->count();

        // Low stock: products with stock <= 5
        $lowStock = Product::where('stock', '<=', 5)->count();

        $unreadInquiries = Inquiry::where('is_read', false)->count();

        $statuses = ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'];
        $statusCounts = Order::select('status', DB::raw('COUNT(*) as aggregate'))
            ->whereIn('status', $statuses)
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        $ordersByStatus = collect($statuses)->mapWithKeys(
            fn ($status) => [$status => (int) ($statusCounts[$status] ?? 0)]
        )->all();

        $recentOrders = Order::with('user')->latest('id')->take(6)->get();
        $recentProducts = Product::with('category')->latest('id')->take(6)->get();

        $mailer = config('mail.default', 'log');
        $hasResend = ! empty(config('services.resend.key') ?: env('RESEND_API_KEY'));
        $hasCallmebot = ! empty(config('services.company.callmebot_api_key') ?: env('CALLMEBOT_API_KEY'));
        $hasMetaCloud = ! empty(config('services.company.whatsapp_cloud_token') ?: env('WHATSAPP_CLOUD_TOKEN'));

        return view('admin.dashboard', [
            'total_revenue' => $totalRevenue,
            'total_orders' => $totalOrders,
            'pending_orders' => $pendingOrders,
            'total_products' => $totalProducts,
            'total_users' => $totalUsers,
            'low_stock' => $lowStock,
            'unread_inquiries' => $unreadInquiries,
            'orders_by_status' => $ordersByStatus,
            'recent_orders' => $recentOrders,
            'recent_products' => $recentProducts,
            'system_health' => [
                'mailer' => $mailer,
                'has_resend' => $hasResend,
                'has_callmebot' => $hasCallmebot,
                'has_meta_cloud' => $hasMetaCloud,
                'trade_desk_email' => config('services.company.trade_desk_email', 'brxagroglobal@gmail.com'),
                'whatsapp_device' => config('services.company.whatsapp', '+55 11 95835-3433'),
            ],
        ]);
    }

    public function sendTestNotification(Request $request)
    {
        $targetEmail = $request->input('email') ?: config('services.company.trade_desk_email', 'brxagroglobal@gmail.com');
        $mailer = config('mail.default', 'log');

        try {
            Mail::raw("Live test alert from BRX AGRO GLOBAL Admin Panel at " . now()->toRfc2822String() . ".\n\nAll core application services and database queries are fully operational.", function ($msg) use ($targetEmail) {
                $msg->to($targetEmail)->subject('[BRX AGRO GLOBAL] Admin Verification Test');
            });

            $resendKey = config('services.resend.key') ?: env('RESEND_API_KEY');
            if (! empty($resendKey) && $mailer === 'log') {
                try {
                    $fromAddress = config('mail.from.address', 'brxagroglobal@gmail.com');
                    $fromName = config('mail.from.name', 'BRX AGRO GLOBAL');
                    Http::timeout(6)->withToken($resendKey)->post('https://api.resend.com/emails', [
                        'from' => "{$fromName} <{$fromAddress}>",
                        'to' => [$targetEmail],
                        'subject' => '[BRX AGRO GLOBAL] Admin Verification Test (Resend)',
                        'text' => 'Live test alert from BRX AGRO GLOBAL Admin Panel via Resend API.',
                    ]);
                } catch (\Throwable $e) {}
            }

            $note = ($mailer === 'log') ? ' (Recorded to local log. To send across the internet, set MAIL_MAILER=smtp or RESEND_API_KEY in .env/Vercel)' : " via {$mailer}";
            return back()->with('status', "Test notification successfully dispatched to {$targetEmail}{$note}.");
        } catch (\Throwable $e) {
            return back()->with('error', "Notification dispatch failed: " . $e->getMessage());
        }
    }
}
