<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class LoadingCosis extends Component
{
    // No usar $options nunca
    public $customView;

    public function __construct($customView = null)
    {
        $this->customView = $customView;
    }

    public function render()
    {
        return <<<'blade'
            <livewire:loading-cosis :customView="$customView" />
        blade;
    }

}
