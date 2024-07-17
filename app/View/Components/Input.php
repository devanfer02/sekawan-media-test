<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $id;
    public $required;
    public $value;
    public $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $type = "text",
        string $name,
        string $id,
        bool $required = false,
        string $value = "",
        string $placeholder = "",
    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->required= $required;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
