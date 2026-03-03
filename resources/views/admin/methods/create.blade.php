@extends('layouts.admin')
@section('title', 'Nuevo medio | Admin')
@section('page_title', 'Nuevo medio')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.methods.store') }}" method="POST">
        @csrf
        @include('admin.methods.form', ['method' => $method])
    </form>
@endsection
