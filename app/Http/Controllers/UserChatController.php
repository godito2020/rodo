<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserChatController extends Controller
{
    public function customerIndex()
    {
        $user = Auth::user();
        $conversations = ChatConversation::where('user_id', $user->id)
            ->with(['product', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->get();

        return view('frontend.customer.chats.index', compact('conversations'));
    }

    public function customerShow(int $id)
    {
        $user = Auth::user();
        $conversation = ChatConversation::where('user_id', $user->id)
            ->with(['product', 'messages.sender'])
            ->findOrFail($id);

        // Mark admin/bot messages as read
        ChatMessage::where('conversation_id', $conversation->id)
            ->whereIn('sender_type', ['admin', 'bot'])
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('frontend.customer.chats.show', compact('conversation'));
    }

    public function startChat(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Por favor inicie sesión o regístrese para chatear con un asesor de ventas.');
        }

        $user = Auth::user();
        $productId = $request->input('product_id');
        $product = $productId ? Product::find($productId) : null;

        $subject = $product ? 'Consulta sobre: ' . $product->name : 'Consulta General de Vehículos / Implementos';

        // Check if an existing open conversation for this product already exists
        $conversation = ChatConversation::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->where('status', 'open')
            ->first();

        if (!$conversation) {
            $conversation = ChatConversation::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'subject' => $subject,
                'status' => 'open',
                'last_message_at' => now(),
            ]);

            // Initial Bot welcome message
            ChatMessage::create([
                'conversation_id' => $conversation->id,
                'sender_type' => 'bot',
                'message' => '¡Hola ' . $user->name . '! Gracias por contactar al equipo comercial de RODOPERU. Un asesor técnico responderá tu consulta a la brevedad. Por favor déjanos tus dudas o requerimientos específicos.',
            ]);
        }

        // If initial message provided
        if ($msg = $request->input('initial_message')) {
            ChatMessage::create([
                'conversation_id' => $conversation->id,
                'sender_type' => 'customer',
                'sender_id' => $user->id,
                'message' => $msg,
            ]);
            $conversation->update(['last_message_at' => now()]);
        }

        return redirect()->route('customer.chat_show', $conversation->id);
    }

    public function sendMessage(Request $request, int $id)
    {
        $request->validate(['message' => 'required|string|max:2000']);
        $user = Auth::user();

        $conversation = ChatConversation::where('user_id', $user->id)->findOrFail($id);

        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'customer',
            'sender_id' => $user->id,
            'message' => $request->input('message'),
        ]);

        $conversation->update([
            'last_message_at' => now(),
            'status' => 'in_progress',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return back();
    }

    public function fetchMessages(int $id)
    {
        $user = Auth::user();
        $conversation = ChatConversation::where('user_id', $user->id)->findOrFail($id);

        $messages = $conversation->messages()->with('sender')->get();

        // Mark as read
        ChatMessage::where('conversation_id', $conversation->id)
            ->whereIn('sender_type', ['admin', 'bot'])
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }
}
