<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', ($siteSettings['product_name'] ?? config('croodev.site.product_name')).' | Croodev')</title>
        <meta name="description" content="@yield('meta_description', $siteSettings['product_tagline'] ?? config('croodev.site.product_tagline'))">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|cormorant-garamond:500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @php
            $productName = $siteSettings['product_name'] ?? config('croodev.site.product_name');
            $subBrand = str($productName)->replace('Croodev', '')->trim()->value() ?: 'Care';
            $isHome = request()->routeIs('home');
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
                    <a href="{{ route('home') }}" class="flex items-center gap-4">
                        <img src="{{ asset('branding/croodev-logo.svg') }}" alt="Croodev" class="h-10 w-auto">
                        <div class="flex items-baseline gap-2">
                            <span class="text-lg font-semibold tracking-[-0.03em] text-[var(--ink)]">Croodev</span>
                            <span class="font-[var(--font-display)] text-2xl tracking-[0.08em] text-[var(--forest)]">{{ $subBrand }}</span>
                        </div>
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
            <div class="site-container grid gap-10 py-12 lg:grid-cols-[1.2fr_0.8fr_0.8fr_0.9fr]">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('branding/croodev-logo.svg') }}" alt="Croodev" class="h-10 w-auto">
                        <div class="flex items-baseline gap-2">
                            <span class="text-lg font-semibold tracking-[-0.03em]">Croodev</span>
                            <span class="font-[var(--font-display)] text-2xl tracking-[0.08em] text-[var(--forest)]">{{ $subBrand }}</span>
                        </div>
                    </div>
                    <p class="max-w-md text-sm leading-7 text-[var(--muted)]">
                        {{ $contentBlocks['footer_blurb'] ?? 'Croodev Care es una demo de producto para causas solidarias con identidad clara, experiencia cuidada y administración real.' }}
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
                    <div class="pt-4">
                        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.2em] text-[var(--muted)]">
                            {{ $siteSettings['concept_label'] ?? config('croodev.site.concept_label') }}
                        </p>
                        <img src="{{ asset('branding/croodev-logo.svg') }}" alt="Croodev" class="h-8 w-auto">
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
