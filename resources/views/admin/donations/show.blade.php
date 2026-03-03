@extends('layouts.admin')
@section('title', 'Detalle de donación | Admin')
@section('page_title', 'Detalle de donación')
@section('content')
    <div class="grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">
        <section class="admin-card p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Resumen</p>
            <div class="mt-5 space-y-4 text-sm">
                <div>
                    <p class="text-[var(--muted)]">Donante</p>
                    <p class="font-semibold">{{ $donation->donor_name }}</p>
                </div>
                <div>
                    <p class="text-[var(--muted)]">Email</p>
                    <p class="font-semibold">{{ $donation->donor_email }}</p>
                </div>
                <div>
                    <p class="text-[var(--muted)]">Causa</p>
                    <p class="font-semibold">{{ $donation->cause?->title }}</p>
                </div>
                <div>
                    <p class="text-[var(--muted)]">Monto</p>
                    <p class="font-semibold">{{ \App\Support\Money::ars($donation->amount) }}</p>
                </div>
                <div>
                    <p class="text-[var(--muted)]">Estado</p>
                    <p class="font-semibold">{{ ucfirst($donation->status->value) }}</p>
                </div>
                <div>
                    <p class="text-[var(--muted)]">Referencia</p>
                    <p class="font-semibold">{{ $donation->transaction_reference }}</p>
                </div>
            </div>
        </section>

        <section class="admin-card p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Payload</p>
            <pre class="mt-5 overflow-x-auto rounded-[24px] bg-[var(--ivory)] p-5 text-xs leading-6 text-[var(--graphite)]">{{ json_encode($donation->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
            @if ($donation->message)
                <div class="mt-6 rounded-[24px] border border-[var(--line)] bg-[var(--paper)] p-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Mensaje</p>
                    <p class="mt-3 text-sm leading-7 text-[var(--graphite)]">{{ $donation->message }}</p>
                </div>
            @endif
        </section>
    </div>
@endsection
