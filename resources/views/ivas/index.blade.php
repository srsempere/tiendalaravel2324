<x-app-layout>
    <br>
    <div class="overflow-x-auto">
        <table class="w-auto mx-auto text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Porcentaje
                    </th>
                    <th scope="col" class="px-6 py-3" colspan="2">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ivas as $iva)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $iva->tipo }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $iva->por }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('ivas.edit', ['iva' => $iva]) }}">
                                <x-primary-button>
                                    Editar
                                </x-primary-button>
                            </a>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <form method="post" action="{{ route('ivas.destroy', ['iva' => $iva]) }}">
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
        <form action="{{ route('ivas.create') }}" method="get">
            <x-primary-button class="bg-green-700 m-4">Crear IVA</x-primary-button>
        </form>
    </div>
</x-app-layout>
