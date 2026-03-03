<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function index(): View
    {
        return view('admin.donations.index', [
            'donations' => Donation::query()
                ->with(['cause', 'donationMethod'])
                ->latest()
                ->paginate(15),
        ]);
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.donations.index');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('admin.donations.index');
    }

    public function show(Donation $donation): View
    {
        $donation->load(['cause', 'donationMethod']);

        return view('admin.donations.show', [
            'donation' => $donation,
        ]);
    }

    public function edit(Donation $donation): RedirectResponse
    {
        return redirect()->route('admin.donations.show', $donation);
    }

    public function update(Request $request, Donation $donation): RedirectResponse
    {
        return redirect()->route('admin.donations.show', $donation);
    }

    public function destroy(Donation $donation): RedirectResponse
    {
        return redirect()->route('admin.donations.index');
    }
}
