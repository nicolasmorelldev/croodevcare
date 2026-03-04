@php
    $productName = $productName ?? ($siteSettings['product_name'] ?? config('croodev.site.product_name'));
    $tagline = $tagline ?? ($siteSettings['product_tagline'] ?? config('croodev.site.product_tagline'));
    $wrapperClass = $wrapperClass ?? 'campaign-lockup';
    $iconClass = $iconClass ?? 'campaign-mark';
    $nameClass = $nameClass ?? 'campaign-wordmark';
    $taglineClass = $taglineClass ?? 'campaign-tagline';
    $showTagline = $showTagline ?? true;
@endphp

<div class="{{ $wrapperClass }}">
    <img src="{{ asset('branding/sleider-calderon-symbol.svg') }}" alt="{{ $productName }}" class="{{ $iconClass }}">
    <div class="min-w-0">
        <p class="{{ $nameClass }}">{{ $productName }}</p>
        @if ($showTagline)
            <p class="{{ $taglineClass }}">{{ $tagline }}</p>
        @endif
    </div>
</div>
