<x-app-layout>
    <div class="flex">
        <div class="flex flex-col items-center w-1/4" aria-label="Sidebar">
            {{-- Buscar por categoría --}}
            <form action="{{ route('buscar_articulos') }}" method="get">
                <div>
                    <x-input-label for="categoria" :value="__('Categoría')" class="ms-1 mt-3" />
                    <x-text-input id="categoria" class="block mt-1 w-full ms-1" type="text" name="categoria"
                        :value="request('categoria')" />
                    <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
                </div>
                <x-primary-button class="ms-1 mt-2">
                    {{ __('Buscar') }}
                </x-primary-button>
            </form>
        </div>
        <div class="p-2 flex-1 grid grid-cols-3 gap-4 justify-center justify-items-center mt-1">
            @foreach ($articulos as $articulo)
                <div
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h1
                        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        {{ $articulo->denominacion }}</h1>
                    <p>Precio: {{ dinero($articulo->precio) }}</p>
                    <p>Categoria: {{ $articulo->categoria->nombre }}</p>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur,
                        adipisicing elit. Accusantium aspernatur rem fuga similique et porro amet voluptatem asperiores,
                        molestiae veritatis voluptatum ipsum, ipsam, magni possimus repellendus in quam quod suscipit.
                    </p>
                    <a href="{{ route('carrito.insertar', $articulo) }}"
                        class="inline-block text-xs px-4 py-2 border rounded text-white bg-blue-700 hover:bg-blue-800">
                        Añadir al carrito

                    </a>
                </div>
            @endforeach
        </div>

        @if (!$carrito->vacio())
            <aside class="flex flex-col items-center w-1/4 mt-3 m-4" aria-label="Sidebar">
                <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                    <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th scope="col" class="py-3 px-6">Descripción</th>
                            <th scope="col" class="py-3 px-6">Cantidad</th>
                            <th scope="col" class="py-3 px-6">Total Artículo</th>
                        </thead>
                        <tbody>
                            @foreach ($carrito->getLineas() as $id => $linea)
                                @php
                                    $articulo = $linea->getArticulo();
                                    $cantidad = $linea->getCantidad();
                                    $total_articulo = $linea->getArticulo()->precio * $cantidad;

                                @endphp
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">
                                        {{ $linea->getDenominacionArticulo() }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        {{ $linea->getCantidad() }}
                                        <a href="{{ route('carrito.eliminar', $articulo) }}"
                                            class="inline-flex items-center py-1 px-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            -
                                        </a>
                                    </td>
                                    <td class="py-4 px-4">
                                        {{ dinero($linea->getTotalArticulo()) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                    <p class="m-2">Total: {{ dinero($carrito->getTotalCarrito()) }}</p>
                    <a href="{{ route('carrito.vaciar') }}"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Vaciar
                        carrito</a>
                    <a href="{{ route('comprar') }}""
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Comprar</a>
                </div>
            </aside>
        @endif
    </div>
</x-app-layout>
