<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login | Croodev Care</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|cormorant-garamond:500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen items-center justify-center bg-[var(--ivory)] px-4 py-10">
        <div class="grid w-full max-w-[1080px] gap-8 lg:grid-cols-[0.95fr_1.05fr]">
            <section class="card-panel overflow-hidden">
                <div class="h-full bg-[linear-gradient(135deg,rgba(40,84,70,0.96),rgba(23,56,47,0.92))] p-8 text-white lg:p-12">
                    <img src="{{ asset('branding/croodev-logo.svg') }}" alt="Croodev" class="h-12 w-auto brightness-0 invert">
                    <p class="mt-8 text-xs font-semibold uppercase tracking-[0.24em] text-white/70">Croodev Care</p>
                    <h1 class="mt-4 text-5xl leading-none" style="font-family: var(--font-display);">Panel de administración</h1>
                    <p class="mt-6 max-w-md text-base leading-8 text-white/78">
                        Gestioná causas, necesidades, actualizaciones, montos sugeridos y toda la capa de confianza desde un panel coherente con el producto.
                    </p>
                    <div class="mt-10 rounded-[28px] border border-white/14 bg-white/10 p-6">
                        <p class="text-sm font-semibold">Credenciales demo</p>
                        <p class="mt-3 text-sm text-white/75">admin@croodevcare.test</p>
                        <p class="text-sm text-white/75">CroodevDemo!2026</p>
                    </div>
                </div>
            </section>

            <section class="card-panel p-8 lg:p-12">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--muted)]">Acceso seguro</p>
                <h2 class="mt-4 text-4xl" style="font-family: var(--font-display);">Ingresar al admin</h2>
                <p class="mt-4 text-sm leading-7 text-[var(--muted)]">
                    Este acceso está preparado para una demo comercial local y un panel custom extensible a producción.
                </p>

                @if ($errors->any())
                    <div class="mt-6 rounded-[22px] border border-[var(--danger)]/20 bg-[var(--danger)]/6 px-5 py-4 text-sm text-[var(--danger)]">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.login.store') }}" method="POST" class="mt-8 space-y-5">
                    @csrf
                    <div>
                        <label class="field-label" for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="input-field">
                    </div>
                    <div>
                        <label class="field-label" for="password">Password</label>
                        <input id="password" name="password" type="password" class="input-field">
                    </div>
                    <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-[var(--line)]">
                        Mantener sesión iniciada
                    </label>
                    <button type="submit" class="btn-primary w-full">Entrar al dashboard</button>
                </form>
            </section>
        </div>
    </body>
</html>
