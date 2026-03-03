@extends('layouts.admin')
@section('title', 'Editar necesidad | Admin')
@section('page_title', 'Editar necesidad')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.needs.update', $need) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.needs.form', ['need' => $need, 'causes' => $causes])
    </form>
    <form action="{{ route('admin.needs.destroy', $need) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar necesidad?')">Eliminar necesidad</button>
    </form>
@endsection
