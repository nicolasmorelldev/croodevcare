@extends('layouts.admin')
@section('title', 'Medios de aporte | Admin')
@section('page_title', 'Medios de aporte')
@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Gestioná los medios visibles en campaña y el orden de prioridad para la conversión.</p>
        <a href="{{ route('admin.methods.create') }}" class="btn-primary">Nuevo medio</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if ($methods->isEmpty())
            <div class="empty-state">No hay medios configurados.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Medio</th><th>Tipo</th><th>Estado</th><th>Principal</th><th></th></tr></thead>
                <tbody>
                    @foreach ($methods as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->title }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $item->description }}</p>
                            </td>
                            <td>{{ ucfirst(str_replace('_', ' ', $item->type->value)) }}</td>
                            <td>{{ $item->enabled ? 'Activo' : 'Inactivo' }}</td>
                            <td>{{ $item->is_primary ? 'Sí' : 'No' }}</td>
                            <td class="text-right"><a href="{{ route('admin.methods.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $methods->links() }}
@endsection
