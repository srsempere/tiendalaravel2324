<x-app-layout>
    <h1 class="text-3xl font-semibold text-center text-gray-800 dark:text-white mt-6 mb-4">Lista de deseos</h1>
    <div>
        <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th scope="col" class="py-3 px-6">Nombre</th>
                <th scope="col" class="py-3 px-6">Acción</th>
            </thead>
            <tbody>
                @foreach ($listaDeseos as $articulo)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-4 px-6">
                            {{ $articulo->denominacion }}
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{ route('carrito.insertar', $articulo) }}"
                                class="inline-block text-xs px-4 py-2 border rounded text-white bg-blue-700 hover:bg-blue-800">
                                Añadir al carrito
                            </a>
                            <form action="{{ route('wishlist.remove', ['articulo' => $articulo->id]) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="inline-block text-xs px-4 py-2 border rounded text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-500 dark:hover:bg-purple-600 dark:focus:ring-purple-800">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
