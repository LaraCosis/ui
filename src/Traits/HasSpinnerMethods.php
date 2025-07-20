<?php

namespace LaraCosis\Ui\Traits;

use LaraCosis\Ui\Helpers\SpinnerRegistry;

trait HasSpinnerMethods
{
    public function mountHasSpinnerMethods()
    {
        // Si el componente define $spinnerMethods, úsalo. Si no, escucha todos los métodos.
        if (property_exists($this, 'spinnerMethods')) {
            SpinnerRegistry::setMethods($this->spinnerMethods ?? ['*']);
        } else {
            SpinnerRegistry::setMethods(['*']);
        }
    }
}
