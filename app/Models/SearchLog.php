<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'query',
        'user_id',
        'ip_address',
        'user_agent',
        'city',
        'country',
        'results_count',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'results_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
