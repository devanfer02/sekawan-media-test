<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navlink extends Component
{
    public $route;
    public $name;
    public $href;
    /**
     * Create a new component instance.
     */
    public function __construct(string $route, string $name, string $href)
    {
        $this->route = $route;
        $this->name = $name;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navlink');
    }
}
