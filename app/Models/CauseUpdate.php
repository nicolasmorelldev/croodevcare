<?php

namespace App\Models;

use App\Enums\CauseUpdateType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CauseUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'cause_id',
        'title',
        'type',
        'excerpt',
        'content',
        'image_path',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'type' => CauseUpdateType::class,
        ];
    }

    public function cause(): BelongsTo
    {
        return $this->belongsTo(Cause::class);
    }
}
