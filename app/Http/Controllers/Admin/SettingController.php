<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingsRequest;
use App\Models\ContentBlock;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => SiteSetting::grouped(),
            'contentBlocks' => ContentBlock::query()->orderBy('sort_order')->get(),
        ]);
    }

    public function update(UpdateSiteSettingsRequest $request): RedirectResponse
    {
        foreach ($request->input('settings', []) as $key => $value) {
            $setting = SiteSetting::query()->where('key', $key)->first();

            if ($setting) {
                $setting->update(['value' => $value]);
            }
        }

        foreach ($request->input('content_blocks', []) as $id => $payload) {
            $block = ContentBlock::query()->find($id);

            if ($block) {
                $block->update([
                    'title' => $payload['title'] ?? null,
                    'summary' => $payload['summary'] ?? null,
                    'content' => $payload['content'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.settings.edit')
            ->with('status', 'La configuración fue actualizada.');
    }
}
