<?php

namespace App\Generico;

use App\Models\Articulo;
use ValueError;

class Carrito
{
    private array $lineas;

    public function __construct()
    {
        $this->lineas = [];
    }

    public function insertar($id)
    {
        if (!($articulo = Articulo::find($id))) {
            throw new ValueError('El artículo no existe.');
        }

        if (isset($this->lineas[$id])) {
            $this->lineas[$id]->incrCantidad();
        } else {
            $this->lineas[$id] = new Linea($articulo);
        }
    }

    public function eliminar()
    {
        //
    }

    public function vacio()
    {
        //
    }

    public function getLineas()
    {
        //
    }
}
