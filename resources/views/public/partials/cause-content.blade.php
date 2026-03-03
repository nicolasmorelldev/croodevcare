@php use App\Support\Money; @endphp

<section class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="space-y-8">
            <section class="rounded-[2rem] border border-stone-200 bg-white p-6">
                <p class="text-sm uppercase tracking-[0.18em] text-stone-500">{{ $cause->hero_badge ?: 'Causa activa' }}</p>
                <h1 class="mt-3 text-4xl font-semibold leading-tight">{{ $cause->hero_heading ?: $cause->title }}</h1>
                <p class="mt-4 text-lg text-stone-600">{{ $cause->hero_excerpt ?: $cause->beneficiary_summary }}</p>

                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl bg-stone-100 p-4">
                        <p class="text-xs uppercase tracking-[0.18em] text-stone-500">Meta</p>
                        <p class="mt-2 text-xl font-semibold">{{ Money::ars($cause->goal_amount) }}</p>
                    </div>
                    <div class="rounded-2xl bg-stone-100 p-4">
                        <p class="text-xs uppercase tracking-[0.18em] text-stone-500">Recaudado</p>
                        <p class="mt-2 text-xl font-semibold">{{ Money::ars($cause->raised_amount) }}</p>
                    </div>
                    <div class="rounded-2xl bg-stone-100 p-4">
                        <p class="text-xs uppercase tracking-[0.18em] text-stone-500">Falta</p>
                        <p class="mt-2 text-xl font-semibold">{{ Money::ars($cause->remaining_amount) }}</p>
                    </div>
                </div>

                <div class="mt-6 h-3 rounded-full bg-stone-200">
                    <div class="h-3 rounded-full bg-stone-900" style="width: {{ $cause->progress_percentage }}%"></div>
                </div>
                <p class="mt-2 text-sm text-stone-500">{{ $cause->progress_percentage }}% de la meta alcanzada.</p>
            </section>

            <section id="story" class="rounded-[2rem] border border-stone-200 bg-white p-6">
                <h2 class="text-2xl font-semibold">Historia</h2>
                <div class="mt-4 space-y-4 text-stone-700">
                    <p>{{ $cause->short_story }}</p>
                    <p>{!! nl2br(e($cause->full_story)) !!}</p>
                    @if ($cause->impact_statement)
                        <div class="rounded-2xl bg-stone-100 p-4 text-sm font-medium text-stone-800">
                            {{ $cause->impact_statement }}
                        </div>
                    @endif
                </div>
            </section>

            <section class="rounded-[2rem] border border-stone-200 bg-white p-6">
                <h2 class="text-2xl font-semibold">Necesidades concretas</h2>
                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    @foreach ($cause->needItems as $need)
                        <article class="rounded-2xl border border-stone-200 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h3 class="font-medium">{{ $need->title }}</h3>
                                    <p class="mt-1 text-sm text-stone-500">{{ $need->category->label() }}</p>
                                </div>
                                <span class="rounded-full bg-stone-100 px-3 py-1 text-xs text-stone-600">{{ $need->status->label() }}</span>
                            </div>
                            <p class="mt-3 text-sm text-stone-600">{{ $need->description }}</p>
                            <p class="mt-3 text-sm text-stone-600">
                                {{ Money::ars($need->covered_amount) }} / {{ Money::ars($need->estimated_amount) }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </section>

            @if ($cause->images->isNotEmpty())
                <section class="rounded-[2rem] border border-stone-200 bg-white p-6">
                    <h2 class="text-2xl font-semibold">Galería y evidencia</h2>
                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        @foreach ($cause->images as $image)
                            <article class="rounded-2xl border border-stone-200 p-4">
                                <p class="text-xs uppercase tracking-[0.18em] text-stone-500">{{ $image->featured ? 'Destacada' : 'Registro' }}</p>
                                <h3 class="mt-2 font-medium">{{ $image->alt ?: 'Imagen de la causa' }}</h3>
                                <p class="mt-2 text-sm text-stone-600">{{ $image->caption }}</p>
                                <p class="mt-3 text-xs text-stone-400">{{ $image->path }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="rounded-[2rem] border border-stone-200 bg-white p-6">
                <h2 class="text-2xl font-semibold">Actualizaciones</h2>
                <div class="mt-6 space-y-4">
                    @foreach ($cause->updates as $update)
                        <article class="rounded-2xl border border-stone-200 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="font-medium">{{ $update->title }}</h3>
                                <span class="text-sm text-stone-500">{{ $update->published_at?->format('d/m/Y') }}</span>
                            </div>
                            <p class="mt-2 text-sm text-stone-500">{{ $update->excerpt }}</p>
                            <p class="mt-3 text-sm text-stone-700">{{ $update->content }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            @if ($faqs->isNotEmpty())
                <section id="transparency" class="rounded-[2rem] border border-stone-200 bg-white p-6">
                    <h2 class="text-2xl font-semibold">Transparencia y preguntas frecuentes</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($faqs as $faq)
                            <article class="rounded-2xl border border-stone-200 p-4">
                                <h3 class="font-medium">{{ $faq->question }}</h3>
                                <p class="mt-2 text-sm text-stone-600">{{ $faq->answer }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($cause->testimonials->isNotEmpty())
                <section class="rounded-[2rem] border border-stone-200 bg-white p-6">
                    <h2 class="text-2xl font-semibold">Mensajes y testimonios</h2>
                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        @foreach ($cause->testimonials as $testimonial)
                            <article class="rounded-2xl border border-stone-200 p-4">
                                <p class="text-sm text-stone-700">“{{ $testimonial->message }}”</p>
                                <p class="mt-4 text-sm font-medium">{{ $testimonial->author }}</p>
                                <p class="text-sm text-stone-500">{{ $testimonial->role }}</p>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <div class="space-y-8">
            @include('public.partials.donation-form', ['cause' => $cause, 'donationMethods' => $donationMethods])
            @include('public.partials.collaboration-form', ['cause' => $cause])

            <section id="transparency" class="rounded-[2rem] border border-stone-200 bg-white p-6">
                <p class="text-sm uppercase tracking-[0.18em] text-stone-500">Transparencia</p>
                <h2 class="mt-2 text-2xl font-semibold">Quién administra la ayuda</h2>
                <div class="mt-4 space-y-3 text-sm text-stone-600">
                    <p><strong>{{ $cause->manager_name }}</strong> · {{ $cause->manager_role }}</p>
                    <p>{{ $cause->manager_contact_email }}</p>
                    <p>{{ $cause->manager_contact_phone }}</p>
                    <p>{{ $siteSettings['legal_notice'] ?? '' }}</p>
                </div>
            </section>
        </div>
    </div>
</section>
