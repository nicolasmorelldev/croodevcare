<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Admin | '.($siteSettings['product_name'] ?? config('croodev.site.product_name')))</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|cormorant-garamond:500,600,700|great-vibes:400" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="admin-shell">
        @php
            $nav = [
                'Dashboard' => 'admin.dashboard',
                'Causas' => 'admin.causes.index',
                'Actualizaciones' => 'admin.updates.index',
                'Galería' => 'admin.gallery.index',
                'Montos sugeridos' => 'admin.presets.index',
                'Necesidades' => 'admin.needs.index',
                'Medios de aporte' => 'admin.methods.index',
                'FAQs' => 'admin.faqs.index',
                'Testimonios' => 'admin.testimonials.index',
                'Usuarios' => 'admin.users.index',
                'Donaciones' => 'admin.donations.index',
                'Configuración' => 'admin.settings.edit',
            ];
        @endphp

        <div class="mx-auto grid min-h-screen max-w-[1560px] gap-6 px-4 py-4 lg:grid-cols-[280px_minmax(0,1fr)] lg:px-6">
            <aside class="rounded-[32px] border border-[var(--line)] bg-[var(--panel)]/85 p-6">
                <a href="{{ route('home') }}" class="mb-8 block">
                    @include('partials.campaign-lockup', [
                        'logoClass' => 'campaign-logo-image h-12',
                    ])
                </a>

                <nav class="space-y-2">
                    @foreach ($nav as $label => $route)
                        <a href="{{ route($route) }}" @class([
                            'admin-sidebar-link',
                            'admin-sidebar-link-active' => request()->routeIs(str_replace('.index', '.*', $route)) || request()->routeIs($route),
                        ])>
                            <span>{{ $label }}</span>
                        </a>
                    @endforeach
                </nav>
            </aside>

            <div class="space-y-6">
                <header class="admin-card flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[var(--muted)]">Panel operativo</p>
                        <h1 class="admin-title">@yield('page_title', $siteSettings['product_name'] ?? config('croodev.site.product_name'))</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right text-sm text-[var(--muted)]">
                            <p>{{ auth()->user()?->name }}</p>
                            <p>{{ auth()->user()?->role?->label() }}</p>
                        </div>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-secondary">Salir</button>
                        </form>
                    </div>
                </header>

                @if (session('status'))
                    <div class="admin-card px-5 py-4 text-sm text-[var(--forest)]">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </body>
</html>
