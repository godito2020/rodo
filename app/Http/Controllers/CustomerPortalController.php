<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ChatConversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerPortalController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('order_status', 'pending')->count();
        $completedOrders = Order::where('user_id', $user->id)->where('order_status', 'delivered')->count();
        $totalChats = ChatConversation::where('user_id', $user->id)->count();

        $recentOrders = Order::where('user_id', $user->id)->latest()->take(5)->get();
        $recentChats = ChatConversation::where('user_id', $user->id)->with('product')->latest('last_message_at')->take(4)->get();

        return view('frontend.customer.dashboard', compact(
            'user',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalChats',
            'recentOrders',
            'recentChats'
        ));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('items')->latest()->paginate(10);

        return view('frontend.customer.orders.index', compact('orders'));
    }

    public function orderDetail(string $orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)
            ->where('order_number', $orderNumber)
            ->with(['items.product'])
            ->firstOrFail();

        return view('frontend.customer.orders.show', compact('order'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.customer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:30',
            'dni_ruc' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:150',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
        ]);

        $user->update($validated);

        return back()->with('success', 'Perfil actualizado exitosamente.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Contraseña actualizada con éxito.');
    }
}
