<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class Claim extends Model
{
    protected $fillable = [
        'claim_number',
        'full_name',
        'doc_type',
        'doc_number',
        'phone',
        'email',
        'address',
        'department',
        'province',
        'district',
        'is_minor',
        'guardian_name',
        'guardian_doc',
        'contracted_type',
        'claimed_amount',
        'currency',
        'product_description',
        'claim_type',
        'details',
        'consumer_request',
        'status',
        'response_text',
        'responded_at',
        'admin_notes',
        'ip_address',
    ];

    protected $casts = [
        'is_minor' => 'boolean',
        'claimed_amount' => 'decimal:2',
        'responded_at' => 'datetime',
    ];

    public static function generateClaimNumber(): string
    {
        $year = date('Y');
        $prefix = "LRV-{$year}-";

        if (!Schema::hasTable('claims')) {
            return $prefix . '00001';
        }

        try {
            $lastClaim = static::where('claim_number', 'LIKE', "{$prefix}%")
                ->orderBy('id', 'desc')
                ->first();

            if ($lastClaim && preg_match('/LRV-\d{4}-(\d+)/', $lastClaim->claim_number, $matches)) {
                $nextSequence = intval($matches[1]) + 1;
            } else {
                $nextSequence = 1;
            }

            return $prefix . str_pad((string) $nextSequence, 5, '0', STR_PAD_LEFT);
        } catch (\Throwable $e) {
            return $prefix . '00001';
        }
    }

    /**
     * INDECOPI establishes a 15 business days deadline to respond.
     */
    public function getDeadlineAttribute(): Carbon
    {
        $createdAt = $this->created_at ? Carbon::parse($this->created_at) : Carbon::now();
        $date = $createdAt->copy();
        $businessDaysAdded = 0;

        while ($businessDaysAdded < 15) {
            $date->addDay();
            if ($date->isWeekday()) {
                $businessDaysAdded++;
            }
        }

        return $date;
    }

    public function getDaysRemainingAttribute(): int
    {
        if ($this->status === 'atendido') {
            return 0;
        }

        $now = Carbon::now();
        $deadline = $this->deadline;

        if ($now->greaterThan($deadline)) {
            return -1 * (int) $now->diffInDays($deadline);
        }

        return (int) $now->diffInDays($deadline);
    }
}
