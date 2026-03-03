<?php

namespace App\Models;

use App\Enums\CauseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cause extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'beneficiary_name',
        'beneficiary_summary',
        'status',
        'location',
        'goal_amount',
        'raised_amount',
        'featured',
        'hero_badge',
        'hero_heading',
        'hero_excerpt',
        'short_story',
        'full_story',
        'impact_statement',
        'primary_cta_label',
        'secondary_cta_label',
        'manager_name',
        'manager_role',
        'manager_contact_email',
        'manager_contact_phone',
        'donation_disclaimer',
        'hero_image_path',
        'hero_image_alt',
        'published_at',
        'last_update_at',
    ];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'goal_amount' => 'integer',
            'raised_amount' => 'integer',
            'published_at' => 'datetime',
            'last_update_at' => 'datetime',
            'status' => CauseStatus::class,
        ];
    }

    public function updates(): HasMany
    {
        return $this->hasMany(CauseUpdate::class)->orderByDesc('published_at');
    }

    public function latestUpdate(): HasOne
    {
        return $this->hasOne(CauseUpdate::class)->latestOfMany('published_at');
    }

    public function images(): HasMany
    {
        return $this->hasMany(CauseImage::class)->orderBy('sort_order');
    }

    public function donationAmountPresets(): HasMany
    {
        return $this->hasMany(DonationAmountPreset::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class)->latest();
    }

    public function needItems(): HasMany
    {
        return $this->hasMany(NeedItem::class)->orderBy('sort_order');
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class)
            ->where('is_featured', true)
            ->orderBy('sort_order');
    }

    public function collaborationInquiries(): HasMany
    {
        return $this->hasMany(CollaborationInquiry::class)->latest();
    }

    public function scopeActive($query)
    {
        return $query->where('status', CauseStatus::Active->value);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getProgressPercentageAttribute(): int
    {
        if ($this->goal_amount <= 0) {
            return 0;
        }

        return (int) min(100, round(($this->raised_amount / $this->goal_amount) * 100));
    }

    public function getRemainingAmountAttribute(): int
    {
        return max(0, $this->goal_amount - $this->raised_amount);
    }
}
