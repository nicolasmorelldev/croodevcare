@extends('layouts.admin')
@section('title', 'Nueva necesidad | Admin')
@section('page_title', 'Nueva necesidad')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.needs.store') }}" method="POST">
        @csrf
        @include('admin.needs.form', ['need' => $need, 'causes' => $causes])
    </form>
@endsection
