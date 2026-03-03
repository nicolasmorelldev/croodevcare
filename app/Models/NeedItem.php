<?php

namespace App\Models;

use App\Enums\NeedCategory;
use App\Enums\NeedStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NeedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cause_id',
        'category',
        'title',
        'description',
        'estimated_amount',
        'covered_amount',
        'status',
        'urgent',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'estimated_amount' => 'integer',
            'covered_amount' => 'integer',
            'urgent' => 'boolean',
            'sort_order' => 'integer',
            'category' => NeedCategory::class,
            'status' => NeedStatus::class,
        ];
    }

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class);
    }

    public function getProgressPercentageAttribute(): int
    {
        if ($this->estimated_amount <= 0) {
            return 0;
        }

        return (int) min(100, round(($this->covered_amount / $this->estimated_amount) * 100));
    }
}
