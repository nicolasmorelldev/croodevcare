<section id="help" class="rounded-[2rem] border border-stone-200 bg-white p-6">
    <p class="text-sm uppercase tracking-[0.18em] text-stone-500">Colaborar</p>
    <h2 class="mt-2 text-2xl font-semibold">Otras formas de ayudar</h2>
    <p class="mt-2 text-sm text-stone-500">Difusión, alianzas, ayuda logística o acompañamiento directo.</p>

    <form action="{{ route('collaboration-inquiries.store') }}" method="POST" class="mt-6 grid gap-4 md:grid-cols-2">
        @csrf
        <input type="hidden" name="cause_id" value="{{ $cause->id }}">

        <div>
            <label class="mb-2 block text-sm font-medium text-stone-700">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm">
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-stone-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm">
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-stone-700">Teléfono</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm">
        </div>
        <div>
            <label class="mb-2 block text-sm font-medium text-stone-700">Tipo de ayuda</label>
            <select name="collaboration_type" class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm">
                <option value="sponsor">Alianza</option>
                <option value="volunteer">Voluntariado</option>
                <option value="logistics">Ayuda logística</option>
                <option value="media">Difusión</option>
                <option value="direct_assistance">Ayuda directa</option>
                <option value="other">Otra</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="mb-2 block text-sm font-medium text-stone-700">Mensaje</label>
            <textarea name="message" rows="4" required class="w-full rounded-2xl border border-stone-300 bg-white px-4 py-3 text-sm">{{ old('message') }}</textarea>
        </div>

        <div class="md:col-span-2">
            <button type="submit" class="rounded-full border border-stone-300 px-6 py-3 text-sm font-semibold text-stone-900 hover:bg-stone-100">
                Enviar propuesta
            </button>
        </div>
    </form>
</section>
