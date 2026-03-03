@extends('layouts.admin')
@section('title', 'Usuarios | Admin')
@section('page_title', 'Usuarios admins')
@section('content')
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm leading-7 text-[var(--muted)]">Administrá accesos internos al panel y permisos base.</p>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">Nuevo usuario</a>
    </div>
    <div class="admin-card overflow-hidden">
        @if ($users->isEmpty())
            <div class="empty-state">No hay usuarios admin cargados.</div>
        @else
            <table class="admin-table">
                <thead><tr><th>Usuario</th><th>Rol</th><th>Activo</th><th>Último acceso</th><th></th></tr></thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>
                                <p class="font-semibold">{{ $item->name }}</p>
                                <p class="mt-1 text-xs text-[var(--muted)]">{{ $item->email }}</p>
                            </td>
                            <td>{{ $item->role?->label() }}</td>
                            <td>{{ $item->is_active ? 'Sí' : 'No' }}</td>
                            <td>{{ optional($item->last_login_at)->format('d/m/Y H:i') ?: 'Sin ingresos' }}</td>
                            <td class="text-right"><a href="{{ route('admin.users.edit', $item) }}" class="btn-ghost">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{ $users->links() }}
@endsection
