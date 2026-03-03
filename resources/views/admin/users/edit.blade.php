@extends('layouts.admin')
@section('title', 'Editar usuario | Admin')
@section('page_title', 'Editar usuario')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.users.form', ['user' => $user])
    </form>
    @if (auth()->id() !== $user->id)
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar usuario?')">Eliminar usuario</button>
        </form>
    @endif
@endsection
