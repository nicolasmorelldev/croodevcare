<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Models\Cause;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('admin.faqs.index', [
            'faqs' => Faq::query()->with('cause')->orderBy('sort_order')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create', [
            'faq' => new Faq(),
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        Faq::query()->create($validated);

        return redirect()->route('admin.faqs.index')
            ->with('status', 'La FAQ fue creada.');
    }

    public function show(Faq $faq): RedirectResponse
    {
        return redirect()->route('admin.faqs.edit', $faq);
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', [
            'faq' => $faq,
            'causes' => Cause::query()->orderBy('title')->get(),
        ]);
    }

    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        $faq->update($validated);

        return redirect()->route('admin.faqs.edit', $faq)
            ->with('status', 'La FAQ fue actualizada.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('status', 'La FAQ fue eliminada.');
    }
}
