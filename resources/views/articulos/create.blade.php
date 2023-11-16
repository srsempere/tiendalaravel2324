    <x-guest-layout>
        <form method="POST" action="{{ route('articulos.store') }}">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="denominacion" :value="'Nombre del artículo'" />
                <x-text-input id="denominacion" class="block mt-1 w-full" type="text" name="denominacion"
                    :value="old('denominacion')" required autofocus autocomplete="denominacion" />
                <x-input-error :messages="$errors->get('denominacion')" class="mt-2" />
            </div>

            <!-- Precio -->
            <div>
                <x-input-label for="precio" :value="'Precio del artículo'" />
                <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" :value="old('precio')"
                    required autofocus autocomplete="precio" />
                <x-input-error :messages="$errors->get('precio')" class="mt-2" />
            </div>

            <!-- Categoria -->
            <div>
                <x-select-category :categorias="$categorias" name="categoria_id" :value="old('categoria_id')"/>
            </div>
            <div class="flex items-center justify-end mt-">
                <a href="{{ route('categorias.index') }}">
                    <x-secondary-button class="m-4">
                        Volver
                    </x-secondary-button>
                </a>
                <x-primary-button class="ms-4 bg-green-700">
                   Crear artículo
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>
