<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCauseRequest;
use App\Http\Requests\Admin\UpdateCauseRequest;
use App\Models\Cause;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CauseController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Cause::class);

        return view('admin.causes.index', [
            'causes' => Cause::query()->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Cause::class);

        return view('admin.causes.create', [
            'cause' => new Cause(),
        ]);
    }

    public function store(StoreCauseRequest $request): RedirectResponse
    {
        $this->authorize('create', Cause::class);

        $validated = $request->validated();
        $validated['featured'] = $request->boolean('featured');

        if ($validated['featured']) {
            Cause::query()->update(['featured' => false]);
        }

        Cause::query()->create($validated);

        return redirect()->route('admin.causes.index')
            ->with('status', 'La causa fue creada.');
    }

    public function show(Cause $cause): RedirectResponse
    {
        return redirect()->route('admin.causes.edit', $cause);
    }

    public function edit(Cause $cause): View
    {
        $this->authorize('update', $cause);

        return view('admin.causes.edit', [
            'cause' => $cause,
        ]);
    }

    public function update(UpdateCauseRequest $request, Cause $cause): RedirectResponse
    {
        $this->authorize('update', $cause);

        $validated = $request->validated();
        $validated['featured'] = $request->boolean('featured');

        if ($validated['featured']) {
            Cause::query()->whereKeyNot($cause->id)->update(['featured' => false]);
        }

        $cause->update($validated);

        return redirect()->route('admin.causes.edit', $cause)
            ->with('status', 'La causa fue actualizada.');
    }

    public function destroy(Cause $cause): RedirectResponse
    {
        $this->authorize('delete', $cause);

        $cause->delete();

        return redirect()->route('admin.causes.index')
            ->with('status', 'La causa fue eliminada.');
    }
}
