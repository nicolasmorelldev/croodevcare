@extends('layouts.admin')
@section('title', 'Nueva actualización | Admin')
@section('page_title', 'Nueva actualización')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.updates.store') }}" method="POST">
        @csrf
        @include('admin.updates.form', ['update' => $update, 'causes' => $causes])
    </form>
@endsection
