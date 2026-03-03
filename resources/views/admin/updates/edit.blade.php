@extends('layouts.admin')
@section('title', 'Editar actualización | Admin')
@section('page_title', 'Editar actualización')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.updates.update', $update) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.updates.form', ['update' => $update, 'causes' => $causes])
    </form>
    <form action="{{ route('admin.updates.destroy', $update) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar actualización?')">Eliminar actualización</button>
    </form>
@endsection
