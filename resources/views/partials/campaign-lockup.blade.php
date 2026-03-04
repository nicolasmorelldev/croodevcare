@php
    $productName = $productName ?? ($siteSettings['product_name'] ?? config('croodev.site.product_name'));
    $wrapperClass = $wrapperClass ?? 'campaign-lockup';
    $logoClass = $logoClass ?? 'campaign-logo-image';
@endphp

<div class="{{ $wrapperClass }}">
    <img src="{{ asset('branding/sleider-calderon-logo.svg') }}" alt="{{ $productName }}" class="{{ $logoClass }}">
</div>
