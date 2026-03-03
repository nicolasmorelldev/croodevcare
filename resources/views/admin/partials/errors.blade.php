@if ($errors->any())
    <div class="admin-card border-[var(--danger)]/20 px-5 py-4 text-sm text-[var(--danger)]">
        <p class="font-semibold">Hay validaciones pendientes.</p>
        <ul class="mt-2 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
