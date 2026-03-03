<?php

namespace App\Http\Requests\Site;

use App\Enums\CollaborationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCollaborationInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cause_id' => ['nullable', 'exists:causes,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'collaboration_type' => ['required', Rule::enum(CollaborationType::class)],
            'message' => ['required', 'string'],
        ];
    }
}
