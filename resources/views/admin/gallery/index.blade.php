@extends('layouts.admin')
@section('title', 'Galería | Admin')
@section('page_title', 'Galería')
@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Cargá evidencia visual, fotos de contexto y assets para la historia pública.</p>
        <a href="{{ route('admin.gallery.create') }}" class="btn-primary">Nueva imagen</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if ($images->isEmpty())
            <div class="empty-state">No hay imágenes cargadas.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Imagen</th><th>Causa</th><th>Orden</th><th>Destacada</th><th></th></tr></thead>
                <tbody>
                    @foreach ($images as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->caption ?: $item->alt ?: $item->path }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $item->path }}</p>
                            </td>
                            <td>{{ $item->cause?->title }}</td>
                            <td>{{ $item->sort_order }}</td>
                            <td>{{ $item->featured ? 'Sí' : 'No' }}</td>
                            <td class="text-right"><a href="{{ route('admin.gallery.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $images->links() }}
@endsection
