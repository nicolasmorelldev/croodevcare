<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin').' | '.config('app.name')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-100 text-stone-900">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 shrink-0 border-r border-stone-200 bg-white px-6 py-8 lg:block">
            <a href="{{ route('admin.dashboard') }}" class="block text-lg font-semibold text-stone-900">
                {{ config('app.name') }}
            </a>
            <p class="mt-1 text-sm text-stone-500">Panel de administración</p>

            <nav class="mt-8 space-y-1 text-sm">
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.causes.index') }}">Causas</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.updates.index') }}">Actualizaciones</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.presets.index') }}">Montos sugeridos</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.needs.index') }}">Necesidades</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.methods.index') }}">Medios de aporte</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.gallery.index') }}">Galería</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.faqs.index') }}">FAQs</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.testimonials.index') }}">Testimonios</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.donations.index') }}">Aportes</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.users.index') }}">Admins</a>
                <a class="block rounded-xl px-3 py-2 hover:bg-stone-100" href="{{ route('admin.settings.edit') }}">Configuración</a>
            </nav>
        </aside>

        <div class="flex-1">
            <header class="border-b border-stone-200 bg-white/90 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div>
                        <h1 class="text-lg font-semibold text-stone-900">@yield('page_title', 'Dashboard')</h1>
                        <p class="text-sm text-stone-500">Gestión editorial, operativa y de demo.</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" class="text-sm text-stone-600 hover:text-stone-900">Ver sitio</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-full border border-stone-300 px-4 py-2 text-sm font-medium text-stone-700 hover:bg-stone-100">
                                Salir
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @include('admin.partials.flash')
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
