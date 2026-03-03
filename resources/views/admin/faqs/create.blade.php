@extends('layouts.admin')
@section('title', 'Nueva FAQ | Admin')
@section('page_title', 'Nueva FAQ')
@section('content')
    @include('admin.partials.errors')
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        @include('admin.faqs.form', ['faq' => $faq, 'causes' => $causes])
    </form>
@endsection
