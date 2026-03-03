@extends('layouts.admin')
@section('title', 'Nuevo monto | Admin')
@section('page_title', 'Nuevo monto sugerido')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.presets.store') }}" method="POST">
        @csrf
        @include('admin.presets.form', ['preset' => $preset, 'causes' => $causes])
    </form>
@endsection
