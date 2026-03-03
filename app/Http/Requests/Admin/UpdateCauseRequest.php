<?php

namespace App\Http\Requests\Admin;

use App\Enums\CauseStatus;
use App\Models\Cause;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCauseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Cause $cause */
        $cause = $this->route('cause');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('causes', 'slug')->ignore($cause)],
            'beneficiary_name' => ['required', 'string', 'max:255'],
            'beneficiary_summary' => ['required', 'string'],
            'status' => ['required', Rule::enum(CauseStatus::class)],
            'location' => ['nullable', 'string', 'max:255'],
            'goal_amount' => ['required', 'integer', 'min:0'],
            'raised_amount' => ['required', 'integer', 'min:0'],
            'featured' => ['nullable', 'boolean'],
            'hero_badge' => ['nullable', 'string', 'max:255'],
            'hero_heading' => ['nullable', 'string', 'max:255'],
            'hero_excerpt' => ['nullable', 'string'],
            'short_story' => ['nullable', 'string'],
            'full_story' => ['nullable', 'string'],
            'impact_statement' => ['nullable', 'string'],
            'primary_cta_label' => ['nullable', 'string', 'max:255'],
            'secondary_cta_label' => ['nullable', 'string', 'max:255'],
            'manager_name' => ['nullable', 'string', 'max:255'],
            'manager_role' => ['nullable', 'string', 'max:255'],
            'manager_contact_email' => ['nullable', 'email', 'max:255'],
            'manager_contact_phone' => ['nullable', 'string', 'max:255'],
            'donation_disclaimer' => ['nullable', 'string'],
            'hero_image_path' => ['nullable', 'string', 'max:255'],
            'hero_image_alt' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'last_update_at' => ['nullable', 'date'],
        ];
    }
}
