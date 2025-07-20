<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class LoadingCosis extends Component
{
    // No usar $options nunca
   
    public function render()
    {
        // Renderiza el componente Livewire
        return <<<'blade'
            <livewire:loading-cosis />
        blade;
    }
}
