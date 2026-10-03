<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatConversation extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'subject',
        'status',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id')->orderBy('created_at', 'asc');
    }

    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class, 'conversation_id')->latestOfMany();
    }

    public function unreadCountForAdmin(): int
    {
        return $this->messages()->where('sender_type', 'customer')->where('is_read', false)->count();
    }

    public function unreadCountForCustomer(): int
    {
        return $this->messages()->whereIn('sender_type', ['admin', 'bot'])->where('is_read', false)->count();
    }
}
