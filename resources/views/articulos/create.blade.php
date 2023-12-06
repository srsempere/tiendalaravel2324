    <x-app-layout>
        <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
            <form method="POST" action="{{ route('articulos.store') }}">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="denominacion" :value="'Nombre del artículo'" />
                    <x-text-input id="denominacion" class="block mt-1 w-full" type="text" name="denominacion"
                        :value="old('denominacion')" required autofocus autocomplete="denominacion" />
                    <x-input-error :messages="$errors->get('denominacion')" class="mt-2" />
                </div>

                <!-- Descripción -->
                <div>
                    <x-input-label for="descripcion" :value="'Descripción del artículo'" />
                    <x-text-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion"
                        :value="old('descripcion')" required autofocus autocomplete="descripcion" />
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>

                <!-- Precio -->
                <div>
                    <x-input-label for="precio" :value="'Precio del artículo'" />
                    <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio"
                        :value="old('precio')" required autofocus autocomplete="precio" />
                    <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                </div>

                <!-- IVa -->
                <div>
                    <select id="iva_id" name="iva_id" required
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                        @foreach ($ivas as $iva)
                            <option value="{{ $iva->id }}" {{ old('iva_id') == $iva->id ? 'selected' : '' }}>
                                {{ $iva->por . '% - ' . $iva->tipo }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Categoria -->
                <div>
                    <select id="categoria_id" name="categoria_id" required
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-end mt-">
                    <a href="{{ route('articulos.index') }}">
                        <x-secondary-button class="m-4">
                            Volver
                        </x-secondary-button>
                    </a>
                    <x-primary-button class="ms-4 bg-green-700">
                        Crear artículo
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-app-layout>
