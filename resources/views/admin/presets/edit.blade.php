@extends('layouts.admin')
@section('title', 'Editar monto | Admin')
@section('page_title', 'Editar monto sugerido')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.presets.update', $preset) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.presets.form', ['preset' => $preset, 'causes' => $causes])
    </form>
    <form action="{{ route('admin.presets.destroy', $preset) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar monto sugerido?')">Eliminar monto</button>
    </form>
@endsection
