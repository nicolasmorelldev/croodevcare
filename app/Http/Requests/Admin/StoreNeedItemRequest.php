<?php

namespace App\Http\Requests\Admin;

use App\Enums\NeedCategory;
use App\Enums\NeedStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNeedItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cause_id' => ['required', 'exists:causes,id'],
            'category' => ['required', Rule::enum(NeedCategory::class)],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'estimated_amount' => ['required', 'integer', 'min:0'],
            'covered_amount' => ['required', 'integer', 'min:0'],
            'status' => ['required', Rule::enum(NeedStatus::class)],
            'urgent' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
