@php($editing = $cause->exists)

<div class="grid gap-6 xl:grid-cols-[1.1fr_0.9fr]">
    <section class="admin-card p-6">
        <h2 class="text-2xl" style="font-family: var(--font-display);">Narrativa principal</h2>
        <div class="mt-6 grid gap-5 md:grid-cols-2">
            <div>
                <label class="field-label">Título</label>
                <input name="title" class="input-field" value="{{ old('title', $cause->title) }}">
            </div>
            <div>
                <label class="field-label">Slug</label>
                <input name="slug" class="input-field" value="{{ old('slug', $cause->slug) }}">
            </div>
            <div>
                <label class="field-label">Beneficiario</label>
                <input name="beneficiary_name" class="input-field" value="{{ old('beneficiary_name', $cause->beneficiary_name) }}">
            </div>
            <div>
                <label class="field-label">Ubicación</label>
                <input name="location" class="input-field" value="{{ old('location', $cause->location) }}">
            </div>
            <div class="md:col-span-2">
                <label class="field-label">Resumen breve</label>
                <textarea name="beneficiary_summary" class="textarea-field">{{ old('beneficiary_summary', $cause->beneficiary_summary) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="field-label">Historia corta</label>
                <textarea name="short_story" class="textarea-field">{{ old('short_story', $cause->short_story) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="field-label">Historia completa</label>
                <textarea name="full_story" class="textarea-field min-h-[240px]">{{ old('full_story', $cause->full_story) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="field-label">Impacto esperado</label>
                <textarea name="impact_statement" class="textarea-field">{{ old('impact_statement', $cause->impact_statement) }}</textarea>
            </div>
        </div>
    </section>

    <div class="space-y-6">
        <section class="admin-card p-6">
            <h2 class="text-2xl" style="font-family: var(--font-display);">Hero y recaudación</h2>
            <div class="mt-6 grid gap-5">
                <div>
                    <label class="field-label">Estado</label>
                    <select name="status" class="select-field">
                        @foreach (\App\Enums\CauseStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected(old('status', $cause->status?->value) === $status->value)>{{ ucfirst($status->value) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="field-label">Meta</label>
                        <input name="goal_amount" type="number" class="input-field" value="{{ old('goal_amount', $cause->goal_amount) }}">
                    </div>
                    <div>
                        <label class="field-label">Recaudado</label>
                        <input name="raised_amount" type="number" class="input-field" value="{{ old('raised_amount', $cause->raised_amount) }}">
                    </div>
                </div>
                <div>
                    <label class="field-label">Badge hero</label>
                    <input name="hero_badge" class="input-field" value="{{ old('hero_badge', $cause->hero_badge) }}">
                </div>
                <div>
                    <label class="field-label">Título hero</label>
                    <input name="hero_heading" class="input-field" value="{{ old('hero_heading', $cause->hero_heading) }}">
                </div>
                <div>
                    <label class="field-label">Texto hero</label>
                    <textarea name="hero_excerpt" class="textarea-field">{{ old('hero_excerpt', $cause->hero_excerpt) }}</textarea>
                </div>
                <div>
                    <label class="field-label">Imagen hero</label>
                    <input name="hero_image_path" class="input-field" value="{{ old('hero_image_path', $cause->hero_image_path) }}">
                </div>
                <div>
                    <label class="field-label">Alt imagen</label>
                    <input name="hero_image_alt" class="input-field" value="{{ old('hero_image_alt', $cause->hero_image_alt) }}">
                </div>
                <div>
                    <label class="field-label">Publicado en</label>
                    <input name="published_at" type="datetime-local" class="input-field" value="{{ old('published_at', optional($cause->published_at)->format('Y-m-d\TH:i')) }}">
                </div>
                <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                    <input type="checkbox" name="featured" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('featured', $cause->featured))>
                    Marcar como causa principal
                </label>
            </div>
        </section>

        <section class="admin-card p-6">
            <h2 class="text-2xl" style="font-family: var(--font-display);">CTAs y transparencia</h2>
            <div class="mt-6 grid gap-5">
                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="field-label">CTA principal</label>
                        <input name="primary_cta_label" class="input-field" value="{{ old('primary_cta_label', $cause->primary_cta_label) }}">
                    </div>
                    <div>
                        <label class="field-label">CTA secundario</label>
                        <input name="secondary_cta_label" class="input-field" value="{{ old('secondary_cta_label', $cause->secondary_cta_label) }}">
                    </div>
                </div>
                <div>
                    <label class="field-label">Responsable</label>
                    <input name="manager_name" class="input-field" value="{{ old('manager_name', $cause->manager_name) }}">
                </div>
                <div>
                    <label class="field-label">Rol</label>
                    <input name="manager_role" class="input-field" value="{{ old('manager_role', $cause->manager_role) }}">
                </div>
                <div>
                    <label class="field-label">Email de contacto</label>
                    <input name="manager_contact_email" class="input-field" value="{{ old('manager_contact_email', $cause->manager_contact_email) }}">
                </div>
                <div>
                    <label class="field-label">Teléfono de contacto</label>
                    <input name="manager_contact_phone" class="input-field" value="{{ old('manager_contact_phone', $cause->manager_contact_phone) }}">
                </div>
                <div>
                    <label class="field-label">Disclaimer de pago</label>
                    <textarea name="donation_disclaimer" class="textarea-field">{{ old('donation_disclaimer', $cause->donation_disclaimer) }}</textarea>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="mt-6 flex flex-wrap items-center gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar cambios' : 'Crear causa' }}</button>
    <a href="{{ route('admin.causes.index') }}" class="btn-secondary">Volver</a>
    @if ($editing)
        <a href="{{ route('causes.show', $cause) }}" class="btn-ghost" target="_blank">Ver pública</a>
    @endif
</div>
