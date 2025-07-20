<?php

namespace Laracosis\Ui\Components\Livewire;

use Livewire\Component;
use Laracosis\Ui\Helpers\SpinnerRegistry;

class LoadingCosis extends Component
{
    public $spinnerMethods = [];
    public $customView = null; // por defecto null

    public function mount($customView = null)
    {
        $this->spinnerMethods = SpinnerRegistry::getMethods();
        if ($customView) {
            $this->customView = $customView;
        }
    }

    public function render()
    {
        return view('laracosis::livewire.loading-cosis', [
            'spinnerMethods' => $this->spinnerMethods,
            'customView' => $this->customView,
        ]);
    }
}
