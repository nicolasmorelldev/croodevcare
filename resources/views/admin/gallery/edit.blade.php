@extends('layouts.admin')
@section('title', 'Editar imagen | Admin')
@section('page_title', 'Editar imagen')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.gallery.update', $image) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.gallery.form', ['image' => $image, 'causes' => $causes])
    </form>
    <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar imagen?')">Eliminar imagen</button>
    </form>
@endsection
