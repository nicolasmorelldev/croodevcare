@extends('layouts.admin')
@section('title', 'Nuevo usuario | Admin')
@section('page_title', 'Nuevo usuario')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        @include('admin.users.form', ['user' => $user])
    </form>
@endsection
