@extends('layouts.admin')
@section('title', 'Nuevo testimonio | Admin')
@section('page_title', 'Nuevo testimonio')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.testimonials.store') }}" method="POST">
        @csrf
        @include('admin.testimonials.form', ['testimonial' => $testimonial, 'causes' => $causes])
    </form>
@endsection
