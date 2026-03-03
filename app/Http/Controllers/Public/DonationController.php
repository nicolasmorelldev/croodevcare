<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\StoreDonationRequest;
use App\Models\Cause;
use App\Models\DonationMethod;
use App\Services\Donations\DonationService;
use Illuminate\Http\RedirectResponse;

class DonationController extends Controller
{
    public function store(StoreDonationRequest $request, DonationService $donationService): RedirectResponse
    {
        $cause = Cause::query()->findOrFail($request->integer('cause_id'));
        $method = DonationMethod::query()->findOrFail($request->integer('donation_method_id'));

        $donation = $donationService->createAndProcess($cause, [
            ...$request->validated(),
            'gateway' => $method->type->value,
        ]);

        return redirect()
            ->to(url()->previous().'#donate')
            ->with('status', $donation->status->value === 'approved'
                ? 'Aporte demo registrado correctamente.'
                : 'El aporte quedó registrado y pendiente de aprobación demo.');
    }
}
