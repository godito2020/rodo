<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{
    public function index(Request $request)
    {
        $query = ChatConversation::with(['user', 'product', 'latestMessage']);

        if ($status = $request->input('estado')) {
            $query->where('status', $status);
        }

        $conversations = $query->orderBy('last_message_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.chats.index', compact('conversations'));
    }

    public function show(int $id)
    {
        $conversation = ChatConversation::with(['user', 'product.images', 'messages.sender'])->findOrFail($id);

        // Mark customer messages as read
        ChatMessage::where('conversation_id', $conversation->id)
            ->where('sender_type', 'customer')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('admin.chats.show', compact('conversation'));
    }

    public function reply(Request $request, int $id)
    {
        $request->validate(['message' => 'required|string|max:2000']);
        $conversation = ChatConversation::findOrFail($id);

        ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'admin',
            'sender_id' => Auth::id(),
            'message' => $request->input('message'),
        ]);

        $conversation->update([
            'last_message_at' => now(),
            'status' => 'in_progress',
        ]);

        return back()->with('success', 'Mensaje enviado al cliente.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate(['status' => 'required|in:open,in_progress,resolved,closed']);
        $conversation = ChatConversation::findOrFail($id);
        $conversation->update(['status' => $request->status]);

        return back()->with('success', 'Estado de la consulta actualizado.');
    }
}
