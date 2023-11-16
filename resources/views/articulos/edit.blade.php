<x-guest-layout>
    <form method="POST" action="{{ route('articulos.update', ['articulo' =>  $articulo]) }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <x-input-label for="denominacion" :value="'Nombre del artículo'" />
            <x-text-input id="denominacion" class="block mt-1 w-full" type="text" name="denominacion" :value="old('denominacion', $articulo->denominacion)" required autofocus autocomplete="denominacion" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-">
            <a href="{{ route('articulos.index') }}">
                <x-secondary-button class="m-4">
                    Volver
                </x-secondary-button>
            </a>
            <x-primary-button class="ms-4">
                Editar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
