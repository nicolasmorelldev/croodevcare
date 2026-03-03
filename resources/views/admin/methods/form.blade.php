@php($editing = $method->exists)
<div class="admin-card p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="field-label">Tipo</label>
            <select name="type" class="select-field">
                @foreach (\App\Enums\DonationMethodType::cases() as $type)
                    <option value="{{ $type->value }}" @selected(old('type', $method->type?->value) === $type->value)>{{ ucfirst(str_replace('_', ' ', $type->value)) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="field-label">Orden</label>
            <input name="sort_order" type="number" class="input-field" value="{{ old('sort_order', $method->sort_order ?? 0) }}">
        </div>
        <div>
            <label class="field-label">Título</label>
            <input name="title" class="input-field" value="{{ old('title', $method->title) }}">
        </div>
        <div>
            <label class="field-label">Descripción</label>
            <input name="description" class="input-field" value="{{ old('description', $method->description) }}">
        </div>
        <div class="md:col-span-2 flex flex-wrap gap-6">
            <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                <input type="checkbox" name="enabled" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('enabled', $method->enabled ?? true))>
                Activo
            </label>
            <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                <input type="checkbox" name="is_primary" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('is_primary', $method->is_primary))>
                Marcar como principal
            </label>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar medio' : 'Crear medio' }}</button>
    <a href="{{ route('admin.methods.index') }}" class="btn-secondary">Volver</a>
</div>
