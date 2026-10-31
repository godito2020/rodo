<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\SearchLog;
use App\Models\ChatConversation;
use App\Models\ContactInquiry;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        try {
            $totalSales = (float) Order::where('payment_status', 'paid')->sum('total');
            $totalOrders = Order::count();
            $pendingOrders = Order::where('order_status', 'pending')->count();
        } catch (\Throwable $e) {
            $totalSales = 0.0;
            $totalOrders = 0;
            $pendingOrders = 0;
        }

        try {
            $totalProducts = Product::count();
        } catch (\Throwable $e) {
            $totalProducts = 0;
        }

        try {
            $totalCustomers = User::where('role', 'customer')->count();
        } catch (\Throwable $e) {
            $totalCustomers = 0;
        }

        try {
            $activeChats = ChatConversation::whereIn('status', ['open', 'in_progress'])->count();
        } catch (\Throwable $e) {
            $activeChats = 0;
        }

        try {
            $unreadInquiries = ContactInquiry::where('is_read', false)->count();
        } catch (\Throwable $e) {
            $unreadInquiries = 0;
        }

        try {
            $recentOrders = Order::with('items')->latest()->take(6)->get();
        } catch (\Throwable $e) {
            $recentOrders = collect();
        }

        try {
            $topSearches = SearchLog::select('query', DB::raw('count(*) as count'))
                ->groupBy('query')
                ->orderBy('count', 'desc')
                ->take(6)
                ->get();
        } catch (\Throwable $e) {
            $topSearches = collect();
        }

        try {
            $recentChats = ChatConversation::with(['user', 'product', 'latestMessage'])
                ->latest('last_message_at')
                ->take(5)
                ->get();
        } catch (\Throwable $e) {
            $recentChats = collect();
        }

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'pendingOrders',
            'totalProducts',
            'totalCustomers',
            'activeChats',
            'unreadInquiries',
            'recentOrders',
            'topSearches',
            'recentChats'
        ));
    }
}
