<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDonationAmountPresetRequest;
use App\Http\Requests\Admin\UpdateDonationAmountPresetRequest;
use App\Models\Cause;
use App\Models\DonationAmountPreset;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DonationAmountPresetController extends Controller
{
    public function index(): View
    {
        return view('admin.presets.index', [
            'presets' => DonationAmountPreset::query()->with('cause')->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.presets.create', [
            'preset' => new DonationAmountPreset(),
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function store(StoreDonationAmountPresetRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        DonationAmountPreset::query()->create($validated);

        return redirect()->route('admin.presets.index')
            ->with('status', 'El monto sugerido fue creado.');
    }

    public function show(DonationAmountPreset $preset): RedirectResponse
    {
        return redirect()->route('admin.presets.edit', $preset);
    }

    public function edit(DonationAmountPreset $preset): View
    {
        return view('admin.presets.edit', [
            'preset' => $preset,
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function update(UpdateDonationAmountPresetRequest $request, DonationAmountPreset $preset): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        $preset->update($validated);

        return redirect()->route('admin.presets.edit', $preset)
            ->with('status', 'El monto sugerido fue actualizado.');
    }

    public function destroy(DonationAmountPreset $preset): RedirectResponse
    {
        $preset->delete();

        return redirect()->route('admin.presets.index')
            ->with('status', 'El monto sugerido fue eliminado.');
    }
}
