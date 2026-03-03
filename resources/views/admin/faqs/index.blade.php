@extends('layouts.admin')
@section('title', 'FAQs | Admin')
@section('page_title', 'FAQs')
@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Consolidá respuestas frecuentes para reforzar claridad operativa y confianza.</p>
        <a href="{{ route('admin.faqs.create') }}" class="btn-primary">Nueva FAQ</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if ($faqs->isEmpty())
            <div class="empty-state">No hay FAQs cargadas.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Pregunta</th><th>Causa</th><th>Activa</th><th></th></tr></thead>
                <tbody>
                    @foreach ($faqs as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->question }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ \Illuminate\Support\Str::limit($item->answer, 90) }}</p>
                            </td>
                            <td>{{ $item->cause?->title ?? 'Global' }}</td>
                            <td>{{ $item->is_active ? 'Sí' : 'No' }}</td>
                            <td class="text-right"><a href="{{ route('admin.faqs.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $faqs->links() }}
@endsection
