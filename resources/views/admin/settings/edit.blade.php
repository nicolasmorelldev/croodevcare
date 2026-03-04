@extends('layouts.admin')
@section('title', 'Configuración | Admin')
@section('page_title', 'Configuración general')
@section('content')
    @include('admin.partials.errors')

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @foreach ($settings as $group => $items)
            <section class="admin-card p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">{{ $group }}</p>
                <div class="mt-5 grid gap-5 md:grid-cols-2">
                    @foreach ($items as $setting)
                        @php($value = old("settings.{$setting->key}", $setting->resolved_value))
                        <div class="{{ in_array($setting->type->value, ['textarea', 'rich_text']) ? 'md:col-span-2' : '' }}">
                            <label class="field-label">{{ $setting->label }}</label>
                            @if (in_array($setting->type->value, ['textarea', 'rich_text']))
                                <textarea name="settings[{{ $setting->key }}]" class="textarea-field">{{ $value }}</textarea>
                            @else
                                <input
                                    name="settings[{{ $setting->key }}]"
                                    type="{{ in_array($setting->type->value, ['email', 'url']) ? $setting->type->value : 'text' }}"
                                    value="{{ $value }}"
                                    class="input-field"
                                >
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        <section class="admin-card p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Content blocks</p>
            <div class="mt-5 space-y-5">
                @foreach ($editableContentBlocks as $block)
                    <div class="rounded-[24px] border border-[var(--line)] bg-[var(--paper)] p-5">
                        <p class="text-sm font-semibold text-[var(--graphite)]">{{ $block->key }}</p>
                        <div class="mt-4 grid gap-4">
                            <input name="content_blocks[{{ $block->id }}][title]" class="input-field" value="{{ old("content_blocks.{$block->id}.title", $block->title) }}" placeholder="Título">
                            <textarea name="content_blocks[{{ $block->id }}][summary]" class="textarea-field">{{ old("content_blocks.{$block->id}.summary", $block->summary) }}</textarea>
                            <textarea name="content_blocks[{{ $block->id }}][content]" class="textarea-field min-h-[160px]">{{ old("content_blocks.{$block->id}.content", $block->content) }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <button type="submit" class="btn-primary">Guardar configuración</button>
    </form>
@endsection
