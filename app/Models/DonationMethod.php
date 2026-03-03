<?php

namespace App\Models;

use App\Enums\DonationMethodType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonationMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'enabled',
        'is_primary',
        'sort_order',
        'configuration',
    ];

    protected function casts(): array
    {
        return [
            'enabled' => 'boolean',
            'is_primary' => 'boolean',
            'sort_order' => 'integer',
            'configuration' => 'array',
            'type' => DonationMethodType::class,
        ];
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function scopeEnabled($query)
    {
        return $query->where('enabled', true);
    }
}
