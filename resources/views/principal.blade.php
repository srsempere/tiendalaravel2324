<x-app-layout>
    <div class="flex">
        {{-- Buscar por categoría --}}
        <form action="{{ route('buscar_articulos') }}" method="get">
            <div>
                <x-input-label for="categoria" :value="__('Categoría')" class="ms-1"/>
                <x-text-input id="categoria" class="block mt-1 w-full ms-1" type="text" name="categoria" :value="old('categoria')"/>
                <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
            </div>
            <x-primary-button class="ms-1 mt-2">
                {{ __('Buscar') }}
            </x-primary-button>
        </form>
        <div class="p-2 flex-1 grid grid-cols-3 gap-4 justify-center justify-items-center">
            @foreach ($articulos as $articulo)
                <a href="#"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $articulo->denominacion }}</h1>
                    <p>Precio: {{ dinero($articulo->precio) }}</p>
                    <p>Categoria: {{ $articulo->categoria->nombre }}</p>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium aspernatur rem fuga similique et porro amet voluptatem asperiores, molestiae veritatis voluptatum ipsum, ipsam, magni possimus repellendus in quam quod suscipit.</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
