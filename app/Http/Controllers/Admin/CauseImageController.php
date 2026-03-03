<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCauseImageRequest;
use App\Http\Requests\Admin\UpdateCauseImageRequest;
use App\Models\Cause;
use App\Models\CauseImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CauseImageController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'images' => CauseImage::query()->with('cause')->orderBy('sort_order')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery.create', [
            'image' => new CauseImage(),
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function store(StoreCauseImageRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['featured'] = $request->boolean('featured');

        if ($validated['featured']) {
            CauseImage::query()
                ->where('cause_id', $validated['cause_id'])
                ->update(['featured' => false]);
        }

        CauseImage::query()->create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('status', 'La imagen fue agregada.');
    }

    public function show(CauseImage $gallery): RedirectResponse
    {
        return redirect()->route('admin.gallery.edit', $gallery);
    }

    public function edit(CauseImage $gallery): View
    {
        return view('admin.gallery.edit', [
            'image' => $gallery,
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function update(UpdateCauseImageRequest $request, CauseImage $gallery): RedirectResponse
    {
        $validated = $request->validated();
        $validated['featured'] = $request->boolean('featured');

        if ($validated['featured']) {
            CauseImage::query()
                ->where('cause_id', $validated['cause_id'])
                ->whereKeyNot($gallery->id)
                ->update(['featured' => false]);
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.edit', $gallery)
            ->with('status', 'La imagen fue actualizada.');
    }

    public function destroy(CauseImage $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('status', 'La imagen fue eliminada.');
    }
}
