<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCauseUpdateRequest;
use App\Http\Requests\Admin\UpdateCauseUpdateRequest;
use App\Models\Cause;
use App\Models\CauseUpdate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CauseUpdateController extends Controller
{
    public function index(): View
    {
        return view('admin.updates.index', [
            'updates' => CauseUpdate::query()->with('cause')->latest('published_at')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.updates.create', [
            'update' => new CauseUpdate(),
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function store(StoreCauseUpdateRequest $request): RedirectResponse
    {
        $update = CauseUpdate::query()->create($request->validated());
        $this->syncCauseTimestamp($update->cause);

        return redirect()->route('admin.updates.index')
            ->with('status', 'La actualización fue creada.');
    }

    public function show(CauseUpdate $update): RedirectResponse
    {
        return redirect()->route('admin.updates.edit', $update);
    }

    public function edit(CauseUpdate $update): View
    {
        return view('admin.updates.edit', [
            'update' => $update,
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function update(UpdateCauseUpdateRequest $request, CauseUpdate $update): RedirectResponse
    {
        $update->update($request->validated());
        $this->syncCauseTimestamp($update->cause);

        return redirect()->route('admin.updates.edit', $update)
            ->with('status', 'La actualización fue actualizada.');
    }

    public function destroy(CauseUpdate $update): RedirectResponse
    {
        $cause = $update->cause;
        $update->delete();
        $this->syncCauseTimestamp($cause);

        return redirect()->route('admin.updates.index')
            ->with('status', 'La actualización fue eliminada.');
    }

    protected function syncCauseTimestamp(?Cause $cause): void
    {
        if (! $cause) {
            return;
        }

        $cause->update([
            'last_update_at' => $cause->updates()->max('published_at'),
        ]);
    }
}
