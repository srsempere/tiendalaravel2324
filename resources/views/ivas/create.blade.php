<x-app-layout>
    <form method="POST" action="{{ route('ivas.store') }}">
        @csrf
        <!-- Name -->
        <div class="m-4">
            <x-input-label for="tipo" :value="'Tipo imporsitivo'" />
            <x-text-input id="tipo" class="block mt-1 w-full" type="text" name="tipo" :value="old('tipo')"
                required autofocus autocomplete="tipo" />
            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
        </div>

        <div class="m-4">
            <x-input-label for="por" :value="'Porcentaje de IVA'" />
            <x-text-input id="por" class="block mt-1 w-full" type="text" name="por" :value="old('por')"
                required autofocus autocomplete="por" />
            <x-input-error :messages="$errors->get('por')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end m-4">
            <a href="{{ route('categorias.index') }}">
                <x-secondary-button class="m-4">
                    Volver
                </x-secondary-button>
            </a>
            <x-primary-button class="ms-4">
                Insertar
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
