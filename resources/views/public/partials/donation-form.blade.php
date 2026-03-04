@php
    $primaryMethod = $donationMethods->firstWhere('is_primary', true) ?? $donationMethods->first();
@endphp

<div class="card-panel overflow-hidden" data-donation-widget>
    <div class="donation-widget-head border-b border-[var(--line)] px-6 py-5">
        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Aporte rápido</p>
        <h3 class="mt-2 text-3xl" style="font-family: var(--font-display);">Aportar ahora</h3>
        <p class="mt-2 text-sm leading-7 text-[var(--muted)]">
            Elegí un monto sugerido o ingresá otro valor. En esta demo el cobro es simulado, pero el flujo operativo ya está resuelto.
        </p>
    </div>

    <form action="{{ route('donations.store') }}" method="POST" class="space-y-6 px-6 py-6">
        @csrf
        <input type="hidden" name="cause_id" value="{{ $cause->id }}">

        <div class="grid gap-3 sm:grid-cols-2">
            @foreach ($cause->donationAmountPresets as $preset)
                <button
                    type="button"
                    class="preset-chip"
                    data-amount-trigger="{{ $preset->amount }}"
                >
                    <span class="block text-lg font-semibold text-[var(--ink)]">{{ $preset->label }}</span>
                    <span class="mt-1 block text-sm leading-6 text-[var(--muted)]">{{ $preset->impact_copy }}</span>
                </button>
            @endforeach
        </div>

        <div>
            <label class="field-label" for="amount">Otro monto</label>
            <input id="amount" name="amount" type="number" min="1000" step="1000" value="{{ old('amount', optional($cause->donationAmountPresets->first())->amount) }}" class="input-field" data-amount-input>
            @error('amount')
                <p class="field-help text-[var(--danger)]">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="field-label" for="donor_name">Nombre</label>
                <input id="donor_name" name="donor_name" value="{{ old('donor_name') }}" class="input-field">
                @error('donor_name')
                    <p class="field-help text-[var(--danger)]">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="field-label" for="donor_email">Email</label>
                <input id="donor_email" name="donor_email" type="email" value="{{ old('donor_email') }}" class="input-field">
                @error('donor_email')
                    <p class="field-help text-[var(--danger)]">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="field-label" for="donor_phone">Teléfono</label>
            <input id="donor_phone" name="donor_phone" value="{{ old('donor_phone') }}" class="input-field">
        </div>

        <div class="space-y-3">
            <span class="field-label">Medio disponible</span>
            @foreach ($donationMethods as $method)
                <label class="donation-method-card block">
                    <input
                        type="radio"
                        name="donation_method_id"
                        value="{{ $method->id }}"
                        class="sr-only"
                        @checked(old('donation_method_id', $primaryMethod?->id) == $method->id)
                    >
                    <span class="block text-sm font-semibold text-[var(--ink)]">{{ $method->title }}</span>
                    <span class="mt-1 block text-sm leading-6 text-[var(--muted)]">{{ $method->description }}</span>
                </label>
            @endforeach
            @error('donation_method_id')
                <p class="field-help text-[var(--danger)]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="field-label" for="message">Mensaje opcional</label>
            <textarea id="message" name="message" class="textarea-field">{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn-primary w-full">Registrar aporte</button>

        <p class="text-xs leading-6 text-[var(--muted)]">
            {{ $cause->donation_disclaimer }}
        </p>
    </form>
</div>
