@php($editing = $testimonial->exists)
<div class="admin-card p-6">
    <div class="grid gap-5">
        <div>
            <label class="field-label">Causa</label>
            <select name="cause_id" class="select-field">
                <option value="">Global</option>
                @foreach ($causes as $causeOption)
                    <option value="{{ $causeOption->id }}" @selected(old('cause_id', $testimonial->cause_id) == $causeOption->id)>{{ $causeOption->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="field-label">Autor</label>
                <input name="author" class="input-field" value="{{ old('author', $testimonial->author) }}">
            </div>
            <div>
                <label class="field-label">Rol</label>
                <input name="role" class="input-field" value="{{ old('role', $testimonial->role) }}">
            </div>
        </div>
        <div>
            <label class="field-label">Mensaje</label>
            <textarea name="message" class="textarea-field">{{ old('message', $testimonial->message) }}</textarea>
        </div>
        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="field-label">Orden</label>
                <input name="sort_order" type="number" class="input-field" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                    <input type="checkbox" name="is_featured" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('is_featured', $testimonial->is_featured ?? true))>
                    Destacado
                </label>
            </div>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar testimonio' : 'Crear testimonio' }}</button>
    <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary">Volver</a>
</div>
