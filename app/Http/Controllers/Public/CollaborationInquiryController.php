<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Enums\InquiryStatus;
use App\Http\Requests\Site\StoreCollaborationInquiryRequest;
use App\Models\CollaborationInquiry;
use Illuminate\Http\RedirectResponse;

class CollaborationInquiryController extends Controller
{
    public function store(StoreCollaborationInquiryRequest $request): RedirectResponse
    {
        CollaborationInquiry::query()->create([
            ...$request->validated(),
            'status' => InquiryStatus::New,
        ]);

        return redirect()
            ->to(url()->previous().'#help')
            ->with('status', 'Tu mensaje fue registrado. En producción esto quedaría disponible para seguimiento en el panel.');
    }
}
