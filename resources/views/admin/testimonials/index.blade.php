@extends('layouts.admin')
@section('title', 'Testimonios | Admin')
@section('page_title', 'Testimonios')
@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Administrá mensajes que refuercen humanidad, confianza y contexto profesional.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">Nuevo testimonio</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if ($testimonials->isEmpty())
            <div class="empty-state">No hay testimonios cargados.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Autor</th><th>Causa</th><th>Destacado</th><th></th></tr></thead>
                <tbody>
                    @foreach ($testimonials as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->author }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ \Illuminate\Support\Str::limit($item->message, 90) }}</p>
                            </td>
                            <td>{{ $item->cause?->title ?? 'Global' }}</td>
                            <td>{{ $item->is_featured ? 'Sí' : 'No' }}</td>
                            <td class="text-right"><a href="{{ route('admin.testimonials.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $testimonials->links() }}
@endsection
