<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Cause;
use App\Models\DonationMethod;
use App\Models\Faq;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $cause = Cause::query()
            ->active()
            ->with([
                'latestUpdate',
                'updates',
                'images',
                'donationAmountPresets',
                'needItems',
                'faqs',
                'testimonials',
            ])
            ->orderByDesc('featured')
            ->orderByDesc('published_at')
            ->firstOrFail();

        return view('public.home', [
            'cause' => $cause,
            'faqs' => Faq::query()
                ->where('is_active', true)
                ->where(fn ($query) => $query->whereNull('cause_id')->orWhere('cause_id', $cause->id))
                ->orderBy('sort_order')
                ->get(),
            'donationMethods' => DonationMethod::query()
                ->enabled()
                ->orderByDesc('is_primary')
                ->orderBy('sort_order')
                ->get(),
        ]);
    }
}
