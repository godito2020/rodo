<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminCustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'customer')->withCount('orders');

        if ($search = $request->input('buscar')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('dni_ruc', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        if ($request->has('estado') && $request->input('estado') !== '') {
            $query->where('is_active', (bool)$request->input('estado'));
        }

        $customers = $query->latest()->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(int $id)
    {
        $customer = User::where('role', 'customer')->with(['orders.items', 'chatConversations'])->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    public function toggleBlock(int $id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->update(['is_active' => !$customer->is_active]);

        $status = $customer->is_active ? 'desbloqueado' : 'bloqueado';
        return back()->with('success', "Cliente {$customer->name} ha sido {$status} correctamente.");
    }

    public function resetPassword(Request $request, int $id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        $request->validate([
            'new_password' => 'required|string|min:8',
        ]);

        $customer->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', "La contraseña para el cliente {$customer->name} ha sido restablecida exitosamente.");
    }

    public function destroy(int $id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Cliente eliminado del sistema.');
    }
}
