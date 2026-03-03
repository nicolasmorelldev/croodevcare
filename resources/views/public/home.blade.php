@extends('layouts.app')

@section('title', 'Croodev Care | '.$cause->title)
@section('meta_description', $cause->beneficiary_summary)

@section('content')
    @include('public.partials.cause-page', ['cause' => $cause, 'donationMethods' => $donationMethods])
@endsection
