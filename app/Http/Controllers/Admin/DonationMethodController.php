<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDonationMethodRequest;
use App\Http\Requests\Admin\UpdateDonationMethodRequest;
use App\Models\DonationMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DonationMethodController extends Controller
{
    public function index(): View
    {
        return view('admin.methods.index', [
            'methods' => DonationMethod::query()->orderByDesc('is_primary')->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.methods.create', [
            'method' => new DonationMethod(),
        ]);
    }

    public function store(StoreDonationMethodRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['enabled'] = $request->boolean('enabled');
        $validated['is_primary'] = $request->boolean('is_primary');

        $method = DonationMethod::query()->create($validated);
        $this->syncPrimaryMethod($method);

        return redirect()->route('admin.methods.index')
            ->with('status', 'El medio de aporte fue creado.');
    }

    public function show(DonationMethod $method): RedirectResponse
    {
        return redirect()->route('admin.methods.edit', $method);
    }

    public function edit(DonationMethod $method): View
    {
        return view('admin.methods.edit', [
            'method' => $method,
        ]);
    }

    public function update(UpdateDonationMethodRequest $request, DonationMethod $method): RedirectResponse
    {
        $validated = $request->validated();
        $validated['enabled'] = $request->boolean('enabled');
        $validated['is_primary'] = $request->boolean('is_primary');

        $method->update($validated);
        $this->syncPrimaryMethod($method);

        return redirect()->route('admin.methods.edit', $method)
            ->with('status', 'El medio de aporte fue actualizado.');
    }

    public function destroy(DonationMethod $method): RedirectResponse
    {
        $method->delete();

        return redirect()->route('admin.methods.index')
            ->with('status', 'El medio de aporte fue eliminado.');
    }

    protected function syncPrimaryMethod(DonationMethod $method): void
    {
        if (! $method->is_primary) {
            return;
        }

        DonationMethod::query()
            ->whereKeyNot($method->id)
            ->update(['is_primary' => false]);
    }
}
