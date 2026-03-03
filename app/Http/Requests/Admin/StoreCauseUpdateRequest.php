<?php

namespace App\Http\Requests\Admin;

use App\Enums\CauseUpdateType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCauseUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cause_id' => ['required', 'exists:causes,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::enum(CauseUpdateType::class)],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
