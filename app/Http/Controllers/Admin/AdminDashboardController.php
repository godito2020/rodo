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
        $totalSales = Order::where('payment_status', 'paid')->sum('total');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $activeChats = ChatConversation::whereIn('status', ['open', 'in_progress'])->count();
        $unreadInquiries = ContactInquiry::where('is_read', false)->count();

        $recentOrders = Order::with('items')->latest()->take(6)->get();
        
        $topSearches = SearchLog::select('query', DB::raw('count(*) as count'))
            ->groupBy('query')
            ->orderBy('count', 'desc')
            ->take(6)
            ->get();

        $recentChats = ChatConversation::with(['user', 'product', 'latestMessage'])
            ->latest('last_message_at')
            ->take(5)
            ->get();

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
