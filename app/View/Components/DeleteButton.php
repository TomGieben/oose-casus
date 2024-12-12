<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton extends Component
{
    private string $route;
    private bool $small;
    /**
     * Create a new component instance.
     */
    public function __construct(string $route, bool $small = false)
    {
        $this->route = $route;
        $this->small = $small;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-button', [
            'route' => $this->route,
            'small' => $this->small
        ]);
    }
}
