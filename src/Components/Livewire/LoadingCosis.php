<?php

namespace LaraCosis\Ui\Components\Livewire;

use Livewire\Component;
use LaraCosis\Ui\Helpers\SpinnerRegistry;

class LoadingCosis extends Component
{
    public $spinnerMethods = [];

    public function mount()
    {
        $this->spinnerMethods = SpinnerRegistry::getMethods();
    }

    public function render()
    {
        return view('laracosis-ui::livewire.loading-cosis', [
            'spinnerMethods' => $this->spinnerMethods,
        ]);
    }
}
