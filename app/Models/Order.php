<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_dni_ruc',
        'shipping_address',
        'shipping_city',
        'notes',
        'subtotal',
        'tax',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
        'voucher_path',
        'payment_gateway_ref',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->order_status) {
            'pending' => '<span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Pendiente</span>',
            'processing' => '<span class="badge bg-info text-white"><i class="fas fa-cog fa-spin me-1"></i> En Preparación</span>',
            'shipped' => '<span class="badge bg-primary text-white"><i class="fas fa-truck me-1"></i> Despachado</span>',
            'delivered' => '<span class="badge bg-success text-white"><i class="fas fa-check-circle me-1"></i> Entregado</span>',
            'cancelled' => '<span class="badge bg-danger text-white"><i class="fas fa-times-circle me-1"></i> Cancelado</span>',
            default => '<span class="badge bg-secondary">' . e($this->order_status) . '</span>',
        };
    }

    public function getPaymentBadgeAttribute(): string
    {
        return match ($this->payment_status) {
            'pending' => '<span class="badge bg-secondary"><i class="fas fa-hourglass-half me-1"></i> Pendiente</span>',
            'paid' => '<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Pagado</span>',
            'failed' => '<span class="badge bg-danger"><i class="fas fa-exclamation-triangle me-1"></i> Fallido</span>',
            'refunded' => '<span class="badge bg-dark"><i class="fas fa-undo me-1"></i> Reembolsado</span>',
            default => '<span class="badge bg-secondary">' . e($this->payment_status) . '</span>',
        };
    }
}
