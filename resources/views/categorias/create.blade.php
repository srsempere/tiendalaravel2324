    <x-app-layout>
        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="nombre" :value="'Nombre de la categoria'" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-">
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
