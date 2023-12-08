<x-app-layout>
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold">Factura nº {{ $factura->id }}</h1>
        <h2 class="text-xl mb-4">Fecha: {{ $factura->created_at }}</h2>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Cantidad</th>
                    <th class="px-4 py-2">Artículo</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Tipo %</th>
                    <th class="px-4 py-2">Total Artículo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factura->articulos as $articulo)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $articulo->pivot->cantidad }}</td>
                        <td class="px-4 py-2">{{ $articulo->denominacion }}</td>
                        <td class="px-4 py-2">{{ dinero($articulo->precio) }}</td>
                        <td class="px-4 py-2">{{ $articulo->iva->por }}</td>
                        <td class="px-4 py-2">{{ dinero($articulo->pivot->cantidad * $articulo->precio) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            Base Imponible 4%: {{ dinero($base4) }} Cuota: {{ dinero($cuota4 = $base4 * 0.04) }}
            <br>
            Base Imponible 10%: {{ dinero($base10) }} Cuota: {{ dinero($cuota10 = $base10 * 0.1) }}
            <br>
            Base Imponible 21%: {{ dinero($base21) }} Cuota: {{ dinero($cuota21 = $base21 * 0.21) }}
            <br>
        </div>
        <div class="mt-4 font-bold text-xl">
            <strong>TOTAL FACTURA: {{ dinero($total + $cuota4 + $cuota10 + $cuota21) }}</strong>
        </div>
    </div>
</x-app-layout>
