@extends('layouts.admin')

@section('title', 'Nueva causa | Admin')
@section('page_title', 'Nueva causa')

@section('content')
    @include('admin.partials.errors')

    <form action="{{ route('admin.causes.store') }}" method="POST">
        @csrf
        @include('admin.causes.form', ['cause' => $cause])
    </form>
@endsection
