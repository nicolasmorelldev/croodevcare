<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="{{ $siteSettings['product_tagline'] ?? config('croodev.site.product_tagline') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 text-stone-900">
    <header class="border-b border-stone-200 bg-white/90 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-lg font-semibold">
                <img src="{{ asset('branding/croodev-logo.svg') }}" alt="Croodev" class="h-8 w-auto">
                <span>{{ $siteSettings['product_name'] ?? config('app.name') }}</span>
            </a>
            <nav class="hidden items-center gap-6 text-sm text-stone-600 md:flex">
                <a href="{{ route('home') }}#story" class="hover:text-stone-900">Historia</a>
                <a href="{{ route('home') }}#donate" class="hover:text-stone-900">Aportar</a>
                <a href="{{ route('home') }}#help" class="hover:text-stone-900">Cómo ayudar</a>
                <a href="{{ route('home') }}#transparency" class="hover:text-stone-900">Transparencia</a>
            </nav>
        </div>
    </header>

    <main>
        @if (session('status'))
            <div class="mx-auto max-w-6xl px-4 pt-6 sm:px-6 lg:px-8">
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-stone-200 bg-white">
        <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-10 text-sm text-stone-600 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <div>
                <p>{{ $contentBlocks['footer_blurb'] ?? ($siteSettings['footer_blurb'] ?? 'Demo solidaria administrable con identidad Croodev.') }}</p>
                <p class="mt-2">{{ $siteSettings['transparency_notice'] ?? ($contentBlocks['transparency_intro'] ?? '') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span>{{ $siteSettings['concept_by_label'] ?? 'Concept by Croodev' }}</span>
                <img src="{{ asset('branding/croodev-logo.svg') }}" alt="Croodev" class="h-6 w-auto">
            </div>
        </div>
    </footer>
</body>
</html>
