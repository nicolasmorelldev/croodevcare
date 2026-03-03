@extends('layouts.admin')
@section('title', 'Nueva imagen | Admin')
@section('page_title', 'Nueva imagen')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.gallery.store') }}" method="POST">
        @csrf
        @include('admin.gallery.form', ['image' => $image, 'causes' => $causes])
    </form>
@endsection
