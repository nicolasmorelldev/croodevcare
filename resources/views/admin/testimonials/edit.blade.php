@extends('layouts.admin')
@section('title', 'Editar testimonio | Admin')
@section('page_title', 'Editar testimonio')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.testimonials.form', ['testimonial' => $testimonial, 'causes' => $causes])
    </form>
    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar testimonio?')">Eliminar testimonio</button>
    </form>
@endsection
