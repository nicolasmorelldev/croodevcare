@extends('layouts.admin')

@section('title', 'Dashboard | Croodev Care')
@section('page_title', 'Dashboard')

@section('content')
    <div class="grid gap-5 xl:grid-cols-5">
        <div class="admin-stat xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Recaudado demo</p>
            <p class="mt-4 text-3xl font-semibold text-[var(--forest)]">{{ \App\Support\Money::ars($totalRaised) }}</p>
        </div>
        <div class="admin-stat xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Aportes</p>
            <p class="mt-4 text-3xl font-semibold">{{ $totalDonations }}</p>
        </div>
        <div class="admin-stat xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Causas activas</p>
            <p class="mt-4 text-3xl font-semibold">{{ $activeCauses }}</p>
        </div>
        <div class="admin-stat xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Necesidades urgentes</p>
            <p class="mt-4 text-3xl font-semibold">{{ $urgentNeeds }}</p>
        </div>
        <div class="admin-stat xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Inquiries</p>
            <p class="mt-4 text-3xl font-semibold">{{ $openInquiries }}</p>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
        <section class="admin-card p-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Progreso por causa</p>
                    <h2 class="mt-2 text-2xl" style="font-family: var(--font-display);">Resumen ejecutivo</h2>
                </div>
                <a href="{{ route('admin.causes.index') }}" class="btn-secondary">Ver causas</a>
            </div>

            <div class="mt-6 space-y-5">
                @foreach ($causes as $cause)
                    <article class="rounded-[24px] border border-[var(--line)] bg-[var(--ivory)]/55 p-5">
                        <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-xl">{{ $cause->title }}</h3>
                                    @if ($cause->featured)
                                        <span class="surface-badge surface-badge-success">Principal</span>
                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-[var(--muted)]">{{ $cause->beneficiary_name }} · {{ $cause->location }}</p>
                            </div>
                            <div class="text-right text-sm text-[var(--muted)]">
                                <p>{{ $cause->donations_count }} aportes</p>
                                <p>{{ $cause->updates_count }} updates</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="mb-2 flex items-center justify-between text-sm text-[var(--muted)]">
                                <span>{{ \App\Support\Money::ars($cause->raised_amount) }}</span>
                                <span>{{ \App\Support\Money::ars($cause->goal_amount) }}</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar" style="width: {{ $cause->progress_percentage }}%"></div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <div class="space-y-6">
            <section class="admin-card p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Actividad reciente</p>
                <div class="mt-5 space-y-4">
                    @foreach ($recentDonations as $donation)
                        <div class="rounded-[20px] border border-[var(--line)] bg-[var(--paper)] p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-[var(--graphite)]">{{ $donation->donor_name }}</p>
                                    <p class="text-sm text-[var(--muted)]">{{ $donation->cause?->title }}</p>
                                </div>
                                <span class="surface-badge surface-badge-success">{{ \App\Support\Money::ars($donation->amount) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="admin-card p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Últimas actualizaciones</p>
                <div class="mt-5 space-y-4">
                    @foreach ($recentUpdates as $update)
                        <div class="rounded-[20px] border border-[var(--line)] bg-[var(--paper)] p-4">
                            <p class="font-semibold text-[var(--graphite)]">{{ $update->title }}</p>
                            <p class="mt-1 text-sm text-[var(--muted)]">{{ $update->cause?->title }} · {{ optional($update->published_at)->format('d M Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
