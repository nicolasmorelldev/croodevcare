@extends('layouts.admin')

@section('title', 'Causas | Admin')
@section('page_title', 'Causas')

@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="max-w-2xl text-sm leading-7 text-[var(--muted)]">Administrá la causa principal, su narrativa, el hero, la meta económica y los puntos de contacto de confianza.</p>
        <a href="{{ route('admin.causes.create') }}" class="btn-primary">Nueva causa</a>
    </div>

    <div class="admin-card overflow-hidden">
        @if ($causes->isEmpty())
            <div class="empty-state">Todavía no hay causas cargadas.</div>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Causa</th>
                        <th>Estado</th>
                        <th>Progreso</th>
                        <th>Publicada</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($causes as $cause)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $cause->title }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $cause->beneficiary_name }} · {{ $cause->location }}</p>
                            </td>
                            <td>{{ ucfirst($cause->status->value) }}</td>
                            <td>
                                <p class="font-semibold">{{ $cause->progress_percentage }}%</p>
                                <p class="text-xs text-[var(--muted)]">{{ \App\Support\Money::ars($cause->raised_amount) }}</p>
                            </td>
                            <td>{{ optional($cause->published_at)->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.causes.edit', $cause) }}" class="btn-ghost">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{ $causes->links() }}
@endsection
