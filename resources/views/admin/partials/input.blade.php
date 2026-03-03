@php
    $inputId = $id ?? preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
    $resolvedValue = old($name, $value ?? null);
@endphp

<div>
    <label for="{{ $inputId }}" class="mb-2 block text-sm font-medium text-stone-700">
        {{ $label }}
    </label>

    @if (($type ?? 'text') === 'textarea')
        <textarea
            id="{{ $inputId }}"
            name="{{ $name }}"
            rows="{{ $rows ?? 4 }}"
            @if (!empty($required)) required @endif
            class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 shadow-sm outline-none ring-0 transition focus:border-stone-500"
        >{{ $resolvedValue }}</textarea>
    @elseif (($type ?? 'text') === 'select')
        <select
            id="{{ $inputId }}"
            name="{{ $name }}"
            @if (!empty($required)) required @endif
            class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 shadow-sm outline-none ring-0 transition focus:border-stone-500"
        >
            <option value="">Seleccionar</option>
            @foreach (($options ?? []) as $option)
                <option value="{{ $option['value'] }}" @selected((string) $resolvedValue === (string) $option['value'])>
                    {{ $option['label'] }}
                </option>
            @endforeach
        </select>
    @elseif (($type ?? 'text') === 'checkbox')
        <label class="flex items-center gap-3 rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 shadow-sm">
            <input
                id="{{ $inputId }}"
                type="checkbox"
                name="{{ $name }}"
                value="1"
                @checked((bool) $resolvedValue)
                class="size-4 rounded border-stone-300 text-stone-900 focus:ring-stone-500"
            >
            <span>{{ $checkboxLabel ?? $label }}</span>
        </label>
    @else
        <input
            id="{{ $inputId }}"
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            value="{{ $resolvedValue }}"
            @if (!empty($required)) required @endif
            @if (!empty($step)) step="{{ $step }}" @endif
            class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm text-stone-900 shadow-sm outline-none ring-0 transition focus:border-stone-500"
        >
    @endif

    @if (!empty($help))
        <p class="mt-2 text-xs text-stone-500">{{ $help }}</p>
    @endif
</div>
