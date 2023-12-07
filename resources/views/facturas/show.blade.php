<x-app-layout>
    <div>
        <h1>Factura nº {{ $factura->id }}</h1>
        <h2>Fecha: {{ $factura->created_at }}</h2>
        @foreach ($factura->articulos as $articulo)
            Articulo: {{ $articulo->denominacion }}   |  Precio: {{ dinero($articulo->precio) }}
            <br>
        @endforeach
        Total Factura: {{ dinero($factura->total) }}
    </div>
</x-app-layout>
