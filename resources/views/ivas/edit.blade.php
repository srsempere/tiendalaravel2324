<x-app-layout>
    <form method="POST" action="{{ route('ivas.update', ['iva' => $iva]) }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <x-input-label for="tipo" :value="'Nombre tipo de iva'" />
            <x-text-input id="tipo" class="block mt-1 w-full" type="text" name="tipo" :value="old('tipo', $iva->tipo)" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="por" :value="'Porcentaje de iva'" />
            <x-text-input id="por" class="block mt-1 w-full" type="text" name="por" :value="old('por', $iva->por)"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-">
            <a href="{{ route('categorias.index') }}">
                <x-secondary-button class="m-4">
                    Volver
                </x-secondary-button>
            </a>
            <x-primary-button class="ms-4">
                Editar
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
