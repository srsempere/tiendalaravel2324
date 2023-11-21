<x-guest-layout>
    <form method="POST" action="{{ route('articulos.update', ['articulo' =>  $articulo]) }}">
        @csrf
        @method('PUT')
        <!-- Denominación -->
        <div>
            <x-input-label for="denominacion" :value="'Nombre del artículo'" />
            <x-text-input id="denominacion" class="block mt-1 w-full" type="text" name="denominacion" :value="old('denominacion', $articulo->denominacion)" required autofocus autocomplete="denominacion" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Precio -->
        <div>
            <x-input-label for="precio" :value="'Precio del artículo'" class="mt-2"/>
            <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" :value="old('precio', $articulo->precio)" required autofocus autocomplete="denominacion" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Categoria -->
        <div>
            <x-input-label for="categoria" :value="'Categoría del artículo'" />
            <div>
               <select id="categoria_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="categoria_id" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ $categoria->id == $articulo->categoria_id ? 'selected' : '' }}
                        >{{ $categoria->nombre }}</option>
                @endforeach
               </select>
               <x-input-error :messages="$errors->get('categoria_id')" class="mt-2" />
            </div>
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
