<?php

namespace App\Models;

use App\Enums\DonationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cause_id',
        'donation_method_id',
        'gateway_type',
        'donor_name',
        'donor_email',
        'donor_phone',
        'message',
        'amount',
        'currency',
        'status',
        'provider_reference',
        'transaction_reference',
        'payload',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'payload' => 'array',
            'completed_at' => 'datetime',
            'status' => DonationStatus::class,
        ];
    }

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class);
    }

    public function donationMethod(): BelongsTo
    {
        return $this->belongsTo(DonationMethod::class);
    }
}
