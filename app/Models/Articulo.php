<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable =['denominacion', 'precio', 'categoria_id', 'iva_id', 'descripcion', 'stock'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function iva(): BelongsTo
    {
        return $this->belongsTo(Iva::class);
    }

    public function getPrecioIiAttribute()
    {
        return $this->precio * (1 + $this->iva->por / 100);
    }

    public function deseadoPorUsuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function facturas(): BelongsToMany
    {
        return $this->belongsToMany(Factura::class)->withPivot('cantidad');
    }
}
