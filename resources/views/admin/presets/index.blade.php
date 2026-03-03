@extends('layouts.admin')
@section('title', 'Montos sugeridos | Admin')
@section('page_title', 'Montos sugeridos')
@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Definí montos rápidos con microcopy de impacto para acelerar la conversión.</p>
        <a href="{{ route('admin.presets.create') }}" class="btn-primary">Nuevo monto</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if ($presets->isEmpty())
            <div class="empty-state">No hay montos sugeridos.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Label</th><th>Monto</th><th>Causa</th><th>Activo</th><th></th></tr></thead>
                <tbody>
                    @foreach ($presets as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->label }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $item->impact_copy }}</p>
                            </td>
                            <td>{{ \App\Support\Money::ars($item->amount) }}</td>
                            <td>{{ $item->cause?->title }}</td>
                            <td>{{ $item->is_active ? 'Sí' : 'No' }}</td>
                            <td class="text-right"><a href="{{ route('admin.presets.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $presets->links() }}
@endsection
