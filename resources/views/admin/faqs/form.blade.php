@php($editing = $faq->exists)
<div class="admin-card p-6">
    <div class="grid gap-5">
        <div>
            <label class="field-label">Causa</label>
            <select name="cause_id" class="select-field">
                <option value="">Global</option>
                @foreach ($causes as $causeOption)
                    <option value="{{ $causeOption->id }}" @selected(old('cause_id', $faq->cause_id) == $causeOption->id)>{{ $causeOption->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="field-label">Pregunta</label>
            <input name="question" class="input-field" value="{{ old('question', $faq->question) }}">
        </div>
        <div>
            <label class="field-label">Respuesta</label>
            <textarea name="answer" class="textarea-field">{{ old('answer', $faq->answer) }}</textarea>
        </div>
        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="field-label">Orden</label>
                <input name="sort_order" type="number" class="input-field" value="{{ old('sort_order', $faq->sort_order ?? 0) }}">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                    <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('is_active', $faq->is_active ?? true))>
                    FAQ activa
                </label>
            </div>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar FAQ' : 'Crear FAQ' }}</button>
    <a href="{{ route('admin.faqs.index') }}" class="btn-secondary">Volver</a>
</div>
