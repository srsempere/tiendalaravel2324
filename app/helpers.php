<?php

if (!function_exists('fecha')) {
    function dinero($s)
    {
        return number_format($s, 2, ',', ' ') . ' €';
    }
}

if (!function_exists('truncar')) {
    function truncar($s, $long = 20)
    {
        return mb_substr($s, 0, $long);
    }
}

function flechas($order, $direccion)
{
    return $order == false ? '' : ($direccion == 'desc' ? '↑' : '↓');
}

function order_direccion($order, $direccion)
{
    return $order == false ? 'asc' : ($direccion == 'asc' ? 'desc' : 'asc');
}
