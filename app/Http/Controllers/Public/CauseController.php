<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Cause;
use App\Models\DonationMethod;
use App\Models\Faq;
use Illuminate\Contracts\View\View;

class CauseController extends Controller
{
    public function show(Cause $cause): View
    {
        $cause->load([
            'latestUpdate',
            'updates',
            'images',
            'donationAmountPresets',
            'needItems',
            'faqs',
            'testimonials',
        ]);

        return view('public.cause-show', [
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
