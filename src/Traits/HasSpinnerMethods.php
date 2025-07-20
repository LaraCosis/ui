<?php

namespace Laracosis\Ui\Traits;

use Laracosis\Ui\Helpers\SpinnerRegistry;

trait HasSpinnerMethods
{
    public function mountHasSpinnerMethods()
    {
        // Si el componente define $spinnerMethods Y no está vacío, úsalo (puede ser ['*']).
        if (
            property_exists($this, 'spinnerMethods') &&
            !empty($this->spinnerMethods)
        ) {
            SpinnerRegistry::setMethods($this->spinnerMethods);
        } else {
            // Si NO define la propiedad, o está vacía, no triggerear NINGÚN método automáticamente
            SpinnerRegistry::setMethods([]);
        }
    }


    public function showSpinner($message = 'Cargando...')
    {
        $this->dispatch('show-global-spinner', message: $message);
    }

    public function closeSpinner()
    {
        $this->dispatch('hide-global-spinner');
    }
}
