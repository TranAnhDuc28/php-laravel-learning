<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public mixed $messages;
    public mixed $type;
    public string $className;

    /**
     * Create a new component instance.
     */
    public function __construct($messages = [], $type = 'info', $className = '')
    {
        $this->messages = $messages;
        $this->type = $type;
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
