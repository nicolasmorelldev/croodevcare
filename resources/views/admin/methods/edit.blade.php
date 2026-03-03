@extends('layouts.admin')
@section('title', 'Editar medio | Admin')
@section('page_title', 'Editar medio')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.methods.update', $method) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.methods.form', ['method' => $method])
    </form>
    <form action="{{ route('admin.methods.destroy', $method) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar medio?')">Eliminar medio</button>
    </form>
@endsection
