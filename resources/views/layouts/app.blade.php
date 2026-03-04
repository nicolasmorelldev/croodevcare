<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', $siteSettings['product_name'] ?? config('croodev.site.product_name'))</title>
        <meta name="description" content="@yield('meta_description', $siteSettings['product_tagline'] ?? config('croodev.site.product_tagline'))">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|cormorant-garamond:500,600,700|great-vibes:400" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @php
            $productName = $siteSettings['product_name'] ?? config('croodev.site.product_name');
            $currentPath = request()->routeIs('causes.show') ? route('causes.show', request()->route('cause')) : route('home');
            $navLinks = [
                ['label' => 'Historia', 'href' => $currentPath.'#story'],
                ['label' => 'Ayuda', 'href' => $currentPath.'#help'],
                ['label' => 'Actualizaciones', 'href' => $currentPath.'#updates'],
                ['label' => 'Transparencia', 'href' => $currentPath.'#trust'],
            ];
        @endphp

        <header class="sticky top-0 z-50 border-b border-[var(--line)] bg-[color:rgba(255,253,252,0.88)] backdrop-blur-xl">
            <div class="site-container">
                <div class="flex items-center justify-between gap-4 py-4">
                    <a href="{{ route('home') }}" class="min-w-0">
                        @include('partials.campaign-lockup', [
                            'productName' => $productName,
                            'logoClass' => 'campaign-logo-image h-12 sm:h-14',
                        ])
                    </a>

                    <nav class="hidden items-center gap-6 lg:flex">
                        @foreach ($navLinks as $link)
                            <a href="{{ $link['href'] }}" class="text-sm font-medium text-[var(--muted)] hover:text-[var(--forest)]">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                        <a href="{{ $currentPath }}#donate" class="btn-primary">Ayudar ahora</a>
                    </nav>

                    <button type="button" class="btn-ghost lg:hidden" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu">
                        Menú
                    </button>
                </div>
            </div>

            <div id="mobile-menu" hidden data-menu-panel class="border-t border-[var(--line)] bg-[var(--paper)] lg:hidden">
                <div class="site-container flex flex-col gap-4 py-5">
                    @foreach ($navLinks as $link)
                        <a href="{{ $link['href'] }}" class="text-sm font-medium text-[var(--muted)]">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <a href="{{ $currentPath }}#donate" class="btn-primary">Ayudar ahora</a>
                </div>
            </div>
        </header>

        @if (session('status'))
            <div class="site-container pt-5">
                <div class="card-panel-soft px-5 py-4 text-sm text-[var(--forest)]">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <main>
            @yield('content')
        </main>

        <footer class="border-t border-[var(--line)] bg-[var(--ivory)]">
            <div class="site-container py-12">
                <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr_0.8fr_0.9fr]">
                    <div class="space-y-4">
                        @include('partials.campaign-lockup', [
                            'productName' => $productName,
                            'logoClass' => 'campaign-logo-image h-14',
                        ])
                        <p class="max-w-md text-sm leading-7 text-[var(--muted)]">
                            {{ $contentBlocks['footer_blurb'] ?? 'Campaña digital pensada para centralizar avances, necesidades concretas y aportes de forma clara, humana y confiable.' }}
                        </p>
                    </div>

                    <div>
                        <p class="mb-3 text-xs font-semibold uppercase tracking-[0.24em] text-[var(--muted)]">Navegación</p>
                        <div class="space-y-3 text-sm text-[var(--muted)]">
                            @foreach ($navLinks as $link)
                                <a href="{{ $link['href'] }}" class="block hover:text-[var(--forest)]">{{ $link['label'] }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 text-xs font-semibold uppercase tracking-[0.24em] text-[var(--muted)]">Contacto</p>
                        <div class="space-y-3 text-sm text-[var(--muted)]">
                            <p>{{ $siteSettings['support_email'] ?? config('croodev.site.support_email') }}</p>
                            <p>{{ $siteSettings['support_phone'] ?? config('croodev.site.support_phone') }}</p>
                            <p>{{ $siteSettings['whatsapp'] ?? config('croodev.site.whatsapp') }}</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--muted)]">Transparencia</p>
                        <p class="text-sm leading-7 text-[var(--muted)]">
                            {{ $siteSettings['legal_notice'] ?? 'Demo funcional con fines comerciales y de validación de producto.' }}
                        </p>
                    </div>
                </div>

                <div class="concept-credit-wrap">
                    <div class="concept-credit-row">
                        <div class="concept-credit">
                            <span class="concept-credit-label">{{ $siteSettings['concept_by_label'] ?? config('croodev.site.concept_label') }}</span>
                            <img src="{{ asset('branding/croodev-logo.svg') }}" alt="Croodev" class="concept-credit-logo">
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
