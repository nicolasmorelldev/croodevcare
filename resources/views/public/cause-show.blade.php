@extends('layouts.app')

@section('title', $cause->title.' | '.($siteSettings['product_name'] ?? config('croodev.site.product_name')))
@section('meta_description', $cause->beneficiary_summary)

@section('content')
    <section class="border-b border-[var(--line)] bg-[var(--ivory)]/75 py-8">
        <div class="site-container">
            <a href="{{ route('home') }}" class="text-sm font-medium text-[var(--muted)] hover:text-[var(--forest)]">
                Inicio / {{ $cause->title }}
            </a>
        </div>
    </section>

    @include('public.partials.cause-page', ['cause' => $cause, 'donationMethods' => $donationMethods])
@endsection
