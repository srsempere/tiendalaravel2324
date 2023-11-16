<x-guest-layout>

    <br>
    <div class="overflow-x-auto">
        <table class="w-auto mx-auto text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre Categoría
                    </th>
                    <th scope="col" class="px-6 py-3" colspan="2">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $categoria->nombre }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('categorias.edit', ['categoria' => $categoria]) }}">
                                <x-primary-button>
                                    Editar
                                </x-primary-button>
                            </a>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <form method="post" action="{{ route('categorias.destroy', ['categoria' => $categoria]) }}">
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
    <div class="flex justify-center">
        <form action="{{ route('categorias.create') }}" method="get">
            <x-primary-button class="bg-green-700 m-4">Crear caregoría</x-primary-button>
        </form>
    </div>

</x-guest-layout>
