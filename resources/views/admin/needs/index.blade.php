@extends('layouts.admin')
@section('title', 'Necesidades | Admin')
@section('page_title', 'Necesidades')
@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Mantené visible cada bloque concreto de necesidad con estado, urgencia y cobertura acumulada.</p>
        <a href="{{ route('admin.needs.create') }}" class="btn-primary">Nueva necesidad</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if ($needs->isEmpty())
            <div class="empty-state">No hay necesidades cargadas.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Necesidad</th><th>Causa</th><th>Estado</th><th>Cobertura</th><th></th></tr></thead>
                <tbody>
                    @foreach ($needs as $item)
                        <tr>
                            <td>
                                <div class="flex flex-wrap items-center gap-2">
                                    <p class="font-semibold">{{ $item->title }}</p>
                                    @if ($item->urgent)
                                        <span class="surface-badge surface-badge-danger">Urgente</span>
                                    @endif
                                </div>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $item->category->label() }}</p>
                            </td>
                            <td>{{ $item->cause?->title }}</td>
                            <td>{{ $item->status->label() }}</td>
                            <td>{{ \App\Support\Money::ars($item->covered_amount) }} / {{ \App\Support\Money::ars($item->estimated_amount) }}</td>
                            <td class="text-right"><a href="{{ route('admin.needs.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $needs->links() }}
@endsection
