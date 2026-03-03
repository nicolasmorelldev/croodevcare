<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CauseStatus;
use App\Http\Controllers\Controller;
use App\Models\Cause;
use App\Models\CollaborationInquiry;
use App\Models\Donation;
use App\Models\NeedItem;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'totalRaised' => Cause::query()->sum('raised_amount'),
            'totalDonations' => Donation::query()->count(),
            'activeCauses' => Cause::query()->where('status', CauseStatus::Active->value)->count(),
            'urgentNeeds' => NeedItem::query()->where('urgent', true)->count(),
            'openInquiries' => CollaborationInquiry::query()->count(),
            'causes' => Cause::query()
                ->withCount(['updates', 'donations'])
                ->orderByDesc('featured')
                ->orderBy('title')
                ->get(),
            'recentDonations' => Donation::query()->with(['cause', 'donationMethod'])->latest()->limit(6)->get(),
            'recentUpdates' => \App\Models\CauseUpdate::query()->with('cause')->latest('published_at')->limit(5)->get(),
        ]);
    }
}
