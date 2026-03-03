@extends('layouts.admin')
@section('title', 'Editar FAQ | Admin')
@section('page_title', 'Editar FAQ')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.faqs.form', ['faq' => $faq, 'causes' => $causes])
    </form>
    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-ghost text-[var(--danger)]" onclick="return confirm('¿Eliminar FAQ?')">Eliminar FAQ</button>
    </form>
@endsection
