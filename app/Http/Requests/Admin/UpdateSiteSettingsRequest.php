<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'settings' => ['nullable', 'array'],
            'settings.*' => ['nullable'],
            'content_blocks' => ['nullable', 'array'],
            'content_blocks.*.title' => ['nullable', 'string', 'max:255'],
            'content_blocks.*.summary' => ['nullable', 'string'],
            'content_blocks.*.content' => ['nullable', 'string'],
        ];
    }
}
