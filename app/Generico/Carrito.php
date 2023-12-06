<?php

namespace App\Generico;

use App\Models\Articulo;
use ValueError;

class Carrito
{
    private array $lineas;
    private float $total_carrito;

    public function __construct()
    {
        $this->lineas = [];
        $this->total_carrito = 0;
    }

    public function insertar($id)
    {
        if (!($articulo = Articulo::find($id))) {
            throw new ValueError('El artículo no existe.');
        }

        if (isset($this->lineas[$id])) {
            $this->lineas[$id]->incrCantidad();
            $this->recalcularTotal();
        } else {
            $this->lineas[$id] = new Linea($articulo);
            $this->recalcularTotal();
        }
    }

    public function eliminar($id)
    {
        if (!isset($this->lineas[$id])) {
            throw new ValueError('Artículo inexistente en el carrito');
        }

        $this->lineas[$id]->decrCantidad();
        $this->recalcularTotal();
        if ($this->lineas[$id]->getCantidad() == 0) {
            unset($this->lineas[$id]);
        }
    }

    public function vacio()
    {
        return empty($this->lineas);
    }

    public function getLineas()
    {
        return $this->lineas;
    }


    public static function carrito()
    {
        if (session()->missing('carrito')) {
            session()->put('carrito', new static());
        }

        return session('carrito');
    }

    public function recalcularTotal()
    {
        $this->total_carrito = 0;
        foreach ($this->lineas as $linea) {
            $this->total_carrito += $linea->getTotalArticulo();
        }
    }

    public function getTotalCarrito()
    {
        return $this->total_carrito;
    }
}
