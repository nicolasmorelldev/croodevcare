<?php

namespace App\Models;

use App\Enums\CollaborationType;
use App\Enums\InquiryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CollaborationInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'cause_id',
        'name',
        'email',
        'phone',
        'collaboration_type',
        'message',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'collaboration_type' => CollaborationType::class,
            'status' => InquiryStatus::class,
        ];
    }

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class);
    }
}
