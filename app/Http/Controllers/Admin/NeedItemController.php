<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNeedItemRequest;
use App\Http\Requests\Admin\UpdateNeedItemRequest;
use App\Models\Cause;
use App\Models\NeedItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NeedItemController extends Controller
{
    public function index(): View
    {
        return view('admin.needs.index', [
            'needs' => NeedItem::query()->with('cause')->orderBy('sort_order')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.needs.create', [
            'need' => new NeedItem(),
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function store(StoreNeedItemRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['urgent'] = $request->boolean('urgent');

        NeedItem::query()->create($validated);

        return redirect()->route('admin.needs.index')
            ->with('status', 'La necesidad fue creada.');
    }

    public function show(NeedItem $need): RedirectResponse
    {
        return redirect()->route('admin.needs.edit', $need);
    }

    public function edit(NeedItem $need): View
    {
        return view('admin.needs.edit', [
            'need' => $need,
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function update(UpdateNeedItemRequest $request, NeedItem $need): RedirectResponse
    {
        $validated = $request->validated();
        $validated['urgent'] = $request->boolean('urgent');

        $need->update($validated);

        return redirect()->route('admin.needs.edit', $need)
            ->with('status', 'La necesidad fue actualizada.');
    }

    public function destroy(NeedItem $need): RedirectResponse
    {
        $need->delete();

        return redirect()->route('admin.needs.index')
            ->with('status', 'La necesidad fue eliminada.');
    }
}
