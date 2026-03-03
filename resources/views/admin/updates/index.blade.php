@extends('layouts.admin')

@section('title', 'Actualizaciones | Admin')
@section('page_title', 'Actualizaciones')

@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Gestioná el timeline público y mantené actualizada la narrativa de la causa.</p>
        <a href="{{ route('admin.updates.create') }}" class="btn-primary">Nueva actualización</a>
    </div>

    <div class="admin-card overflow-hidden">
        @if ($updates->isEmpty())
            <div class="empty-state">No hay actualizaciones registradas.</div>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Causa</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($updates as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->title }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $item->excerpt }}</p>
                            </td>
                            <td>{{ $item->cause?->title }}</td>
                            <td>{{ ucfirst($item->type->value) }}</td>
                            <td>{{ optional($item->published_at)->format('d/m/Y H:i') }}</td>
                            <td class="text-right"><a href="{{ route('admin.updates.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $updates->links() }}
@endsection
