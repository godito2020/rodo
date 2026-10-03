<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('info', 'Su carrito de compras está vacío.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $taxRate = (float)Setting::get('tax_rate', 18);
        $tax = round($subtotal * ($taxRate / 100), 2);
        $total = $subtotal + $tax;

        $user = Auth::user();

        return view('frontend.checkout.index', compact('cart', 'subtotal', 'tax', 'total', 'user'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Su carrito está vacío.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_email' => 'required|email|max:150',
            'customer_phone' => 'required|string|max:30',
            'customer_dni_ruc' => 'nullable|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:transfer,yape_plin,gateway,quote',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $taxRate = (float)Setting::get('tax_rate', 18);
        $tax = round($subtotal * ($taxRate / 100), 2);
        $total = $subtotal + $tax;

        $orderNumber = 'ORD-' . strtoupper(date('ymd')) . '-' . strtoupper(Str::random(4));

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_dni_ruc' => $validated['customer_dni_ruc'] ?? null,
            'shipping_address' => $validated['shipping_address'],
            'shipping_city' => $validated['shipping_city'],
            'notes' => $validated['notes'] ?? null,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'payment_status' => ($validated['payment_method'] === 'gateway') ? 'paid' : 'pending',
            'order_status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);

            // Decrement stock if available
            $prod = Product::find($item['id']);
            if ($prod && $prod->stock >= $item['quantity']) {
                $prod->decrement('stock', $item['quantity']);
            }
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', $order->order_number)
            ->with('success', '¡Su pedido ha sido registrado con éxito!');
    }

    public function success(string $orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();
        return view('frontend.checkout.success', compact('order'));
    }

    public function uploadVoucher(Request $request, string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        $request->validate([
            'voucher' => 'required|image|mimes:jpeg,png,jpg,webp,pdf|max:5120',
        ]);

        if ($request->hasFile('voucher')) {
            $file = $request->file('voucher');
            $fileName = 'voucher_' . $order->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/vouchers'), $fileName);
            $order->update(['voucher_path' => 'uploads/vouchers/' . $fileName]);
        }

        return back()->with('success', 'Voucher subido correctamente. Nuestro equipo contable validará el abono.');
    }
}
