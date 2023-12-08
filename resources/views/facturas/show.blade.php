<x-app-layout>
    <div>
        <h1>Factura nº {{ $factura->id }}</h1>
        <h2>Fecha: {{ $factura->created_at }}</h2>
        <table>
            <thead>
                <th>Cantidad</th>
                <th>Artículo</th>
                <th>Precio</th>
                <th>Total Artículo</th>
            </thead>
            <tbody>
                @foreach ($factura->articulos as $articulo)
                <tr>
                    <td>{{ $articulo->pivot->cantidad }}</td>
                    <td>{{ $articulo->denominacion }}</td>
                    <td>{{ dinero($articulo->precio) }}</td>
                    <td>{{ dinero($articulo->pivot->cantidad * $articulo->precio) }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>

        Total Factura: {{ dinero($total) }}
    </div>
</x-app-layout>
