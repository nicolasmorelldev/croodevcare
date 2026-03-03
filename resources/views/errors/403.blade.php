<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-stone-100 px-4 text-stone-900">
    <div class="max-w-md rounded-[2rem] border border-stone-200 bg-white p-8 text-center shadow-sm">
        <p class="text-sm uppercase tracking-[0.18em] text-stone-500">403</p>
        <h1 class="mt-2 text-2xl font-semibold">Acceso restringido</h1>
        <p class="mt-3 text-sm text-stone-600">Tu usuario no tiene permisos para acceder a esta sección.</p>
        <a href="{{ route('home') }}" class="mt-6 inline-flex rounded-full bg-stone-900 px-5 py-3 text-sm font-semibold text-white hover:bg-stone-700">
            Volver al sitio
        </a>
    </div>
</body>
</html>
