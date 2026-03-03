@php($editing = $need->exists)
<div class="admin-card p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="field-label">Causa</label>
            <select name="cause_id" class="select-field">
                @foreach ($causes as $causeOption)
                    <option value="{{ $causeOption->id }}" @selected(old('cause_id', $need->cause_id) == $causeOption->id)>{{ $causeOption->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="field-label">Categoría</label>
            <select name="category" class="select-field">
                @foreach (\App\Enums\NeedCategory::cases() as $category)
                    <option value="{{ $category->value }}" @selected(old('category', $need->category?->value) === $category->value)>{{ $category->label() }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="field-label">Título</label>
            <input name="title" class="input-field" value="{{ old('title', $need->title) }}">
        </div>
        <div class="md:col-span-2">
            <label class="field-label">Descripción</label>
            <textarea name="description" class="textarea-field">{{ old('description', $need->description) }}</textarea>
        </div>
        <div>
            <label class="field-label">Estimado</label>
            <input name="estimated_amount" type="number" class="input-field" value="{{ old('estimated_amount', $need->estimated_amount) }}">
        </div>
        <div>
            <label class="field-label">Cubierto</label>
            <input name="covered_amount" type="number" class="input-field" value="{{ old('covered_amount', $need->covered_amount) }}">
        </div>
        <div>
            <label class="field-label">Estado</label>
            <select name="status" class="select-field">
                @foreach (\App\Enums\NeedStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected(old('status', $need->status?->value) === $status->value)>{{ $status->label() }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="field-label">Orden</label>
            <input name="sort_order" type="number" class="input-field" value="{{ old('sort_order', $need->sort_order ?? 0) }}">
        </div>
        <div class="md:col-span-2">
            <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                <input type="checkbox" name="urgent" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('urgent', $need->urgent))>
                Marcar como urgente
            </label>
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar necesidad' : 'Crear necesidad' }}</button>
    <a href="{{ route('admin.needs.index') }}" class="btn-secondary">Volver</a>
</div>
