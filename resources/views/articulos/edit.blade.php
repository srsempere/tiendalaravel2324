<x-app-layout>
    <form method="POST" action="{{ route('articulos.update', ['articulo' =>  $articulo]) }}">
        @csrf
        @method('PUT')
        <!-- Denominación -->
        <div>
            <x-input-label for="denominacion" :value="'Nombre del artículo'" />
            <x-text-input id="denominacion" class="block mt-1 w-full" type="text" name="denominacion" :value="old('denominacion', $articulo->denominacion)" required autofocus autocomplete="denominacion" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
          <!-- Descripción -->
          <div>
            <x-input-label for="descripcion" :value="'Descripción del artículo'" />
            <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion', $articulo->descripcion)" required autofocus autocomplete="descripcion" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Precio -->
        <div>
            <x-input-label for="precio" :value="'Precio del artículo'" class="mt-2"/>
            <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" :value="old('precio', $articulo->precio)" required autofocus autocomplete="precio" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
         <!-- IVA -->
         <div>
            <x-input-label for="iva_id" :value="'Iva del artículo'" />
            <div>
               <select id="iva_id" name="iva_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                @foreach ($ivas as $iva)
                    <option value="{{ $iva->id }}"
                        {{ old('iva_id', $articulo->iva_id) == $iva->id ? 'selected' : '' }}
                        >{{ $iva->tipo }}</option>
                @endforeach
               </select>
               <x-input-error :messages="$errors->get('iva_id')" class="mt-2" />
            </div>
        </div>
        <!-- Categoria -->
        <div>
            <x-input-label for="categoria_id" :value="'Categoría del artículo'" />
            <div>
               <select id="categoria_id" name="categoria_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria_id', $articulo->categoria_id) == $categoria->id ? 'selected' : '' }}
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
</x-app-layout>
