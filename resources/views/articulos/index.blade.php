<x-app-layout>
    <div class="relative overflow-x-auto w-full h-full">
        <table class="w-full h-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-7 py-3">
                        Nombre Artículo
                    </th>
                    <th scope="col" class="px-7 py-3">
                        Precio
                    </th>
                    <th scope="col" class="px-7 py-3">
                        Iva
                    </th>
                    <th scope="col" class="px-7 py-3">
                        Precio I.I.
                    </th>
                    <th scope="col" class="px-7 py-3]">
                        Categoría
                    </th>
                    <th scope="col" class="px-7 py-3" colspan="2">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">
                            {{ truncar($articulo->denominacion) }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">
                            {{ dinero($articulo->precio) }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500" title="{{ $articulo->iva->tipo }}">
                            {{ " {$articulo->iva->por}%" }}
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">
                            {{ $articulo->precio_ii . ' €'}}
                        </td>
                        <td class
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">
                                {{ $articulo->categoria->nombre }}
                                                    </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">
                            <a href="{{ route('articulos.edit', ['articulo' => $articulo]) }}">
                                <x-primary-button class="bg-blue-500">
                                    Editar
                                </x-primary-button>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">
                            <form method="post" action="{{ route('articulos.destroy', ['articulo' => $articulo]) }}">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="bg-red-700">
                                    Borrar
                                </x-primary-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <form action="{{ route('articulos.create') }}" method="get">
            <x-primary-button class="bg-green-700 m-4">Crear nuevo artículo</x-primary-button>
        </form>
    </div>
    {{ $articulos->links() }}
</x-app-layout>
