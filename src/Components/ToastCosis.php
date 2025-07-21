<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ToastCosis extends Component
{
    // No usar $options nunca

    public $position;
    public function __construct($position = 'top-right')
    {
        $this->position = $position;
    }


    public function render()
    {
        return <<<'blade'
            <livewire:toast-cosis position="{{ $position }}" />
        blade;
    }
}
