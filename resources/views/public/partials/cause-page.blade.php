@php
    $storyParagraphs = preg_split("/\n\s*\n/", trim((string) $cause->full_story)) ?: [];
    $storyImages = $cause->images->take(3);
    $galleryImages = $cause->images->slice(3);
@endphp

<section class="hero-stage">
    <div class="site-container public-grid items-center gap-y-10">
        <div class="lg:col-span-7">
            <div class="hero-copy-panel">
                <span class="eyebrow">{{ $cause->hero_badge ?? 'Causa activa' }}</span>
                <h1 class="hero-title mt-6">{{ $cause->hero_heading ?: $cause->title }}</h1>
                <p class="hero-copy mt-6">{{ $cause->hero_excerpt ?: $cause->beneficiary_summary }}</p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <span class="stat-chip">{{ $cause->beneficiary_name }}</span>
                    <span class="stat-chip">{{ $cause->location }}</span>
                    <span class="stat-chip">
                        Última actualización
                        {{ optional($cause->last_update_at ?? optional($cause->latestUpdate)->published_at)->format('d M Y') }}
                    </span>
                </div>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#donate" class="btn-primary">{{ $cause->primary_cta_label ?: 'Ayudar ahora' }}</a>
                    <a href="{{ request()->routeIs('home') ? route('causes.show', $cause) : '#story' }}" class="btn-secondary">
                        {{ $cause->secondary_cta_label ?: 'Conocer la historia' }}
                    </a>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="hero-media-shell">
                <img src="{{ asset($cause->hero_image_path) }}" alt="{{ $cause->hero_image_alt }}" class="h-[460px] w-full rounded-[28px] object-cover lg:h-[520px]">

                <div class="hero-progress-card">
                    <div class="flex items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Meta económica</p>
                            <p class="mt-2 text-3xl font-semibold text-[var(--ink)]">{{ \App\Support\Money::ars($cause->goal_amount) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Recaudado</p>
                            <p class="mt-2 text-3xl font-semibold text-[var(--forest)]">{{ \App\Support\Money::ars($cause->raised_amount) }}</p>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="mb-2 flex items-center justify-between text-sm text-[var(--muted)]">
                            <span>{{ $cause->progress_percentage }}% cubierto</span>
                            <span>Faltan {{ \App\Support\Money::ars($cause->remaining_amount) }}</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-bar" style="width: {{ $cause->progress_percentage }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="story" class="section-block section-shell section-shell-story">
    <div class="site-container grid gap-12 lg:grid-cols-[0.9fr_1.1fr]">
        <div class="space-y-5">
            <span class="section-label">Historia y contexto</span>
            <h2 class="section-title">{{ $cause->title }}</h2>
            <p class="section-copy">{{ $cause->short_story }}</p>
            <div class="card-panel-soft p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[var(--muted)]">Impacto esperado</p>
                <p class="mt-3 text-lg leading-8 text-[var(--graphite)]">{{ $cause->impact_statement }}</p>
            </div>
        </div>

        <div class="grid gap-6">
            <div class="card-panel p-8">
                <div class="story-prose">
                    @foreach ($storyParagraphs as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($storyImages as $image)
                    <figure class="card-panel overflow-hidden">
                        <img src="{{ asset($image->path) }}" alt="{{ $image->alt }}" class="h-48 w-full object-cover">
                        <figcaption class="px-5 py-4 text-sm leading-6 text-[var(--muted)]">{{ $image->caption }}</figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section id="help" class="section-block section-shell section-shell-help">
    <div class="site-container">
        <span class="section-label">Cómo ayudar</span>
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="section-title">Una ayuda clara, visible y accionable</h2>
                <p class="section-copy mt-4">
                    {{ $contentBlocks['how_to_help_intro'] ?? 'Hay distintas maneras de acompañar. Algunas resuelven urgencias inmediatas y otras sostienen el proceso completo.' }}
                </p>
            </div>
            <a href="#trust" class="btn-secondary">Ver criterios de transparencia</a>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-4">
            @foreach ([
                ['title' => 'Aportes monetarios', 'copy' => 'Contribuciones simples con montos sugeridos o aporte libre.', 'tone' => 'surface-badge-success', 'panel' => 'help-card help-card-blue'],
                ['title' => 'Difusión estratégica', 'copy' => 'Amplificar la causa en comunidades, empresas y redes afines.', 'tone' => 'surface-badge-info', 'panel' => 'help-card help-card-slate'],
                ['title' => 'Alianzas y sponsors', 'copy' => 'Empresas o equipos que quieran cubrir una necesidad concreta.', 'tone' => 'surface-badge-warning', 'panel' => 'help-card help-card-gold'],
                ['title' => 'Ayuda directa', 'copy' => 'Soporte logístico, movilidad o contacto especializado.', 'tone' => 'surface-badge-danger', 'panel' => 'help-card help-card-red'],
            ] as $card)
                <article class="card-panel help-card {{ $card['panel'] }} p-6">
                    <span class="surface-badge {{ $card['tone'] }}">{{ $card['title'] }}</span>
                    <p class="mt-5 text-base leading-7 text-[var(--muted)]">{{ $card['copy'] }}</p>
                </article>
            @endforeach
        </div>

        <div id="donate" class="mt-12 grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-8">
                <div class="card-panel p-8">
                    <span class="section-label">Necesidades concretas</span>
                    <div class="mt-6 space-y-4">
                        @foreach ($cause->needItems as $need)
                            @php
                                $statusClasses = match ($need->status) {
                                    \App\Enums\NeedStatus::Completed => 'surface-badge surface-badge-success',
                                    \App\Enums\NeedStatus::PartiallyCovered => 'surface-badge surface-badge-warning',
                                    default => 'surface-badge surface-badge-danger',
                                };
                            @endphp
                            <article class="rounded-[24px] border border-[var(--line)] bg-[var(--paper)] p-5">
                                <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <h3 class="text-xl">{{ $need->title }}</h3>
                                            @if ($need->urgent)
                                                <span class="surface-badge surface-badge-danger">Urgente</span>
                                            @endif
                                        </div>
                                        <p class="mt-2 text-sm leading-7 text-[var(--muted)]">{{ $need->description }}</p>
                                    </div>
                                    <span class="{{ $statusClasses }}">{{ $need->status->label() }}</span>
                                </div>
                                <div class="mt-4">
                                    <div class="mb-2 flex items-center justify-between text-sm text-[var(--muted)]">
                                        <span>{{ \App\Support\Money::ars($need->covered_amount) }} cubiertos</span>
                                        <span>{{ \App\Support\Money::ars($need->estimated_amount) }} objetivo</span>
                                    </div>
                                    <div class="progress-track">
                                        <div class="progress-bar" style="width: {{ $need->progress_percentage }}%"></div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="card-panel p-8">
                    <span class="section-label">Colaborar de otra forma</span>
                    <form action="{{ route('collaboration-inquiries.store') }}" method="POST" class="mt-6 grid gap-4 md:grid-cols-2">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <div>
                            <label class="field-label">Nombre</label>
                            <input name="name" class="input-field" value="{{ old('name') }}">
                        </div>
                        <div>
                            <label class="field-label">Email</label>
                            <input name="email" type="email" class="input-field" value="{{ old('email') }}">
                        </div>
                        <div>
                            <label class="field-label">Teléfono</label>
                            <input name="phone" class="input-field" value="{{ old('phone') }}">
                        </div>
                        <div>
                            <label class="field-label">Tipo de ayuda</label>
                            <select name="collaboration_type" class="select-field">
                                @foreach (\App\Enums\CollaborationType::cases() as $type)
                                    <option value="{{ $type->value }}" @selected(old('collaboration_type') === $type->value)>{{ $type->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="field-label">Mensaje</label>
                            <textarea name="message" class="textarea-field">{{ old('message') }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="btn-secondary">Registrar colaboración</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:sticky lg:top-28 lg:self-start">
                @include('public.partials.donation-form', ['cause' => $cause, 'donationMethods' => $donationMethods])
            </div>
        </div>
    </div>
</section>

<section id="updates" class="section-block section-shell section-shell-updates">
    <div class="site-container">
        <span class="section-label">Evidencia y actualizaciones</span>
        <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
            <div>
                <h2 class="section-title">La causa evoluciona con seguimiento visible</h2>
                <p class="section-copy mt-4">Cada novedad se registra para que la campaña tenga trazabilidad real y un relato claro para quien evalúa colaborar.</p>

                <div class="mt-8 space-y-5">
                    @foreach ($cause->updates as $update)
                        <article class="card-panel p-6">
                            @if ($update->image_path)
                                <img src="{{ asset($update->image_path) }}" alt="{{ $update->title }}" class="mb-5 h-52 w-full rounded-[24px] object-cover">
                            @endif
                            <div class="flex items-center justify-between gap-4">
                                <span class="surface-badge surface-badge-info">{{ ucfirst(str_replace('_', ' ', $update->type->value)) }}</span>
                                <span class="text-xs uppercase tracking-[0.2em] text-[var(--muted)]">{{ optional($update->published_at)->format('d M Y') }}</span>
                            </div>
                            <h3 class="mt-4 text-2xl">{{ $update->title }}</h3>
                            <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $update->excerpt }}</p>
                            <p class="mt-4 text-sm leading-7 text-[var(--graphite)]">{{ $update->content }}</p>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($galleryImages as $image)
                    <figure class="card-panel overflow-hidden">
                        <img src="{{ asset($image->path) }}" alt="{{ $image->alt }}" class="h-64 w-full object-cover">
                        <figcaption class="px-5 py-4 text-sm leading-6 text-[var(--muted)]">{{ $image->caption }}</figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section id="trust" class="section-block section-shell section-shell-trust">
    <div class="site-container">
        <span class="section-label">Transparencia y confianza</span>
        <div class="grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
            <div class="space-y-6">
                <div class="card-panel p-8">
                    <h2 class="section-title">Quién administra y cómo se rinde</h2>
                    <p class="section-copy mt-4">
                        {{ $contentBlocks['transparency_intro'] ?? 'Toda campaña necesita claridad operativa. Acá se muestra qué se necesita, cuánto se cubrió y cómo evoluciona la causa.' }}
                    </p>
                    <div class="mt-8 grid gap-4">
                        <div class="rounded-[22px] border border-[var(--line)] bg-[var(--paper)] p-5">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[var(--muted)]">Administración</p>
                            <p class="mt-2 text-lg text-[var(--graphite)]">{{ $cause->manager_name }}</p>
                            <p class="mt-1 text-sm text-[var(--muted)]">{{ $cause->manager_role }}</p>
                        </div>
                        <div class="rounded-[22px] border border-[var(--line)] bg-[var(--paper)] p-5">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[var(--muted)]">Contacto</p>
                            <p class="mt-2 text-sm text-[var(--graphite)]">{{ $cause->manager_contact_email }}</p>
                            <p class="mt-1 text-sm text-[var(--graphite)]">{{ $cause->manager_contact_phone }}</p>
                        </div>
                        <div class="rounded-[22px] border border-[var(--line)] bg-[var(--paper)] p-5">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[var(--muted)]">Aviso de transparencia</p>
                            <p class="mt-2 text-sm leading-7 text-[var(--muted)]">
                                {{ $siteSettings['transparency_notice'] ?? 'La campaña es administrada por un equipo verificado. Cada aporte se asigna a necesidades visibles y el avance se actualiza desde el panel.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    @foreach ($cause->testimonials as $testimonial)
                        <article class="card-panel-soft p-6">
                            <p class="text-base leading-8 text-[var(--graphite)]">“{{ $testimonial->message }}”</p>
                            <p class="mt-5 text-sm font-semibold text-[var(--ink)]">{{ $testimonial->author }}</p>
                            <p class="text-sm text-[var(--muted)]">{{ $testimonial->role }}</p>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="space-y-6">
                <div class="card-panel p-8">
                    <h3 class="text-3xl" style="font-family: var(--font-display);">Medios disponibles</h3>
                    <div class="mt-6 space-y-4">
                        @foreach ($donationMethods as $method)
                            <div class="rounded-[22px] border border-[var(--line)] bg-[var(--paper)] p-5">
                                <div class="flex items-center justify-between gap-4">
                                    <p class="text-base font-semibold text-[var(--graphite)]">{{ $method->title }}</p>
                                    @if ($method->is_primary)
                                        <span class="surface-badge surface-badge-success">Principal</span>
                                    @endif
                                </div>
                                <p class="mt-2 text-sm leading-7 text-[var(--muted)]">{{ $method->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-panel p-8">
                    <h3 class="text-3xl" style="font-family: var(--font-display);">Preguntas frecuentes</h3>
                    <div class="mt-6 space-y-4">
                        @foreach ($cause->faqs as $faq)
                            <details class="rounded-[22px] border border-[var(--line)] bg-[var(--paper)] p-5">
                                <summary class="cursor-pointer text-base font-semibold text-[var(--graphite)]">{{ $faq->question }}</summary>
                                <p class="mt-3 text-sm leading-7 text-[var(--muted)]">{{ $faq->answer }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
