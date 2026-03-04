@extends('layouts.app')

@section('title', ($siteSettings['product_name'] ?? config('croodev.site.product_name')).' | Campaña solidaria')
@section('meta_description', $cause->beneficiary_summary)

@section('content')
    @include('public.partials.cause-page', ['cause' => $cause, 'donationMethods' => $donationMethods])
@endsection
