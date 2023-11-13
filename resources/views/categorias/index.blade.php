<x-guest-layout>

    <div cclass="overflow-x-auto">
        <table class="w-auto mx-auto text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre Categoría
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $categoria->nombre }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-guest-layout>
