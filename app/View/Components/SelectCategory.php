<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectCategory extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $categorias;
    public $value;
    public function __construct($name, $categorias, $value)
    {
        $this->name = $name;
        $this->categorias = $categorias;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-category');
    }
}
