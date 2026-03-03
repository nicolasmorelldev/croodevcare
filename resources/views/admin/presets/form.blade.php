@php($editing = $preset->exists)
<div class="admin-card p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="field-label">Causa</label>
            <select name="cause_id" class="select-field">
                @foreach ($causes as $causeOption)
                    <option value="{{ $causeOption->id }}" @selected(old('cause_id', $preset->cause_id) == $causeOption->id)>{{ $causeOption->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="field-label">Orden</label>
            <input name="sort_order" type="number" class="input-field" value="{{ old('sort_order', $preset->sort_order ?? 0) }}">
        </div>
        <div>
            <label class="field-label">Monto</label>
            <input name="amount" type="number" class="input-field" value="{{ old('amount', $preset->amount) }}">
        </div>
        <div>
            <label class="field-label">Label visual</label>
            <input name="label" class="input-field" value="{{ old('label', $preset->label) }}">
        </div>
        <div class="md:col-span-2">
            <label class="field-label">Copy de impacto</label>
            <textarea name="impact_copy" class="textarea-field">{{ old('impact_copy', $preset->impact_copy) }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('is_active', $preset->is_active ?? true))>
                Preset activo
            </label>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar monto' : 'Crear monto' }}</button>
    <a href="{{ route('admin.presets.index') }}" class="btn-secondary">Volver</a>
</div>
