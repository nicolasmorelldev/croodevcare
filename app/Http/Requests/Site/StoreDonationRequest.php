<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cause_id' => ['required', 'exists:causes,id'],
            'donation_method_id' => ['required', 'exists:donation_methods,id'],
            'amount' => ['required', 'integer', 'min:1000'],
            'donor_name' => ['required', 'string', 'max:255'],
            'donor_email' => ['required', 'email', 'max:255'],
            'donor_phone' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ];
    }
}
