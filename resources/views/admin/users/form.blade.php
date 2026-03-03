@php($editing = $user->exists)
<div class="admin-card p-6">
    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <label class="field-label">Nombre</label>
            <input name="name" class="input-field" value="{{ old('name', $user->name) }}">
        </div>
        <div>
            <label class="field-label">Email</label>
            <input name="email" type="email" class="input-field" value="{{ old('email', $user->email) }}">
        </div>
        <div>
            <label class="field-label">Rol</label>
            <select name="role" class="select-field">
                @foreach (\App\Enums\UserRole::cases() as $role)
                    <option value="{{ $role->value }}" @selected(old('role', $user->role?->value) === $role->value)>{{ $role->label() }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-3 text-sm text-[var(--muted)]">
                <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-[var(--line)]" @checked(old('is_active', $user->is_active ?? true))>
                Usuario activo
            </label>
        </div>
        <div>
            <label class="field-label">{{ $editing ? 'Nuevo password (opcional)' : 'Password' }}</label>
            <input name="password" type="password" class="input-field">
        </div>
        <div>
            <label class="field-label">Confirmación</label>
            <input name="password_confirmation" type="password" class="input-field">
        </div>
    </div>
</div>
<div class="mt-6 flex flex-wrap gap-3">
    <button type="submit" class="btn-primary">{{ $editing ? 'Guardar usuario' : 'Crear usuario' }}</button>
    <a href="{{ route('admin.users.index') }}" class="btn-secondary">Volver</a>
</div>
