<?php

namespace App\Generico;

use App\Models\Articulo;

class Linea
{
    private Articulo $articulo;
    private int $cantidad;

    public function __construct(Articulo $articulo, int $cantidad = 1)
    {
        $this->articulo = $articulo;
        $this->cantidad = $cantidad;
    }

    public function getArticulo(): Articulo
    {
        return $this->articulo;
    }

    public function getDenominacionArticulo()
    {
        return $this->getArticulo()->denominacion;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function getPrecio()
    {
        return $this->articulo->precio;
    }

    public function incrCantidad()
    {
        $this->cantidad++;
    }

    public function decrCantidad()
    {
        $this->cantidad--;
    }

    public function getTotalArticulo()
    {
        return $this->getPrecio() * $this->getCantidad();
    }
}
