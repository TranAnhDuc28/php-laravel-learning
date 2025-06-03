<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public mixed $type = null,
        public mixed $size = '', // modal-sm, modal-lg, modal-xl
        public ?string $classNameModal,
        public mixed $messages,
        public mixed $id,
        public mixed $title,
        public bool $maskClosable = true,
        public bool $closable = true,
        public mixed $cancelText = 'Cancel',
        public string $cancelType = 'primary',
        public mixed $cancelAttributes = '',
        public mixed $okText = 'OK',
        public string $okType = 'primary',
        public mixed $okAttributes = '',
        public ?bool $footer = true,
        public ?bool $isConfirmation = true,
        public ?string $idForm,
        public mixed $method = 'POST',
        public ?string $action = '',
    )
    {
        $this->messages = e($messages);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
