@php($editing = $image->exists)

<div class="admin-card p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="field-label">Causa</label>
            <select name="cause_id" class="select-field">
                @foreach ($causes as $causeOption)
                    <option value="{{ $causeOption->id }}" @selected(old('cause_id', $image->cause_id) == $causeOption->id)>{{ $causeOption->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="field-label">Orden</label>
            <input name="sort_order" type="number" class="input-field" value="{{ old('sort_order', $image->sort_order ?? 0) }}">
        </div>
        <div class="md:col-span-2">
            <label class="field-label">Path de imagen</label>
            <input name="path" class="input-field" value="{{ old('path', $image->path) }}">
        </div>
        <div>
            <label class="field-label">Alt</label>
            <input name="alt" class="input-field" value="{{ old('alt', $image->alt) }}">
        </div>
        <div>
            <label class="field-label">Caption</label>
            <input name="caption" class="input-field" value="{{ old('caption', $image->caption) }}">
        </div>
        <div class="md:col-span-2">
            <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                <input type="checkbox" name="featured" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('featured', $image->featured))>
                Marcar como imagen destacada
            </label>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar imagen' : 'Crear imagen' }}</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn-secondary">Volver</a>
</div>
