<?php

namespace App\View\Components;

use Illuminate\View\Component;

class nav-link extends Component
{
    public $route;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $label)
    {
        $this->route = $route;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-link');
    }
}
