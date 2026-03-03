@extends('layouts.admin')

@section('title', 'Editar causa | Admin')
@section('page_title', 'Editar causa')

@section('content')
    @include('admin.partials.errors')

    <form action="{{ route('admin.causes.update', $cause) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.causes.form', ['cause' => $cause])
    </form>

    <form action="{{ route('admin.causes.destroy', $cause) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar causa?')">Eliminar causa</button>
    </form>
@endsection
