@extends('layouts.admin')
@section('title', 'Donaciones | Admin')
@section('page_title', 'Donaciones')
@section('content')
    <div class="admin-card overflow-hidden">
        @if ($donations->isEmpty())
            <div class="empty-state">No hay aportes registrados.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Donante</th><th>Causa</th><th>Método</th><th>Monto</th><th>Estado</th><th></th></tr></thead>
                <tbody>
                    @foreach ($donations as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->donor_name }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $item->donor_email }}</p>
                            </td>
                            <td>{{ $item->cause?->title }}</td>
                            <td>{{ $item->donationMethod?->title }}</td>
                            <td>{{ \App\Support\Money::ars($item->amount) }}</td>
                            <td>{{ ucfirst($item->status->value) }}</td>
                            <td class="text-right"><a href="{{ route('admin.donations.show', $item) }}" class="btn-ghost">Ver</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $donations->links() }}
@endsection
