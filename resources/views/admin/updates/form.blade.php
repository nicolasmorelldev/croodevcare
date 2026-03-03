@php($editing = $update->exists)

<div class="admin-card p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="field-label">Causa</label>
            <select name="cause_id" class="select-field">
                @foreach ($causes as $causeOption)
                    <option value="{{ $causeOption->id }}" @selected(old('cause_id', $update->cause_id) == $causeOption->id)>{{ $causeOption->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="field-label">Tipo</label>
            <select name="type" class="select-field">
                @foreach (\App\Enums\CauseUpdateType::cases() as $type)
                    <option value="{{ $type->value }}" @selected(old('type', $update->type?->value) === $type->value)>{{ ucfirst($type->value) }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="field-label">Título</label>
            <input name="title" class="input-field" value="{{ old('title', $update->title) }}">
        </div>
        <div class="md:col-span-2">
            <label class="field-label">Extracto</label>
            <textarea name="excerpt" class="textarea-field">{{ old('excerpt', $update->excerpt) }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="field-label">Contenido</label>
            <textarea name="content" class="textarea-field min-h-[220px]">{{ old('content', $update->content) }}</textarea>
        </div>
        <div>
            <label class="field-label">Imagen</label>
            <input name="image_path" class="input-field" value="{{ old('image_path', $update->image_path) }}">
        </div>
        <div>
            <label class="field-label">Publicado en</label>
            <input name="published_at" type="datetime-local" class="input-field" value="{{ old('published_at', optional($update->published_at)->format('Y-m-d\TH:i')) }}">
        </div>
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar actualización' : 'Crear actualización' }}</button>
    <a href="{{ route('admin.updates.index') }}" class="btn-secondary">Volver</a>
</div>
