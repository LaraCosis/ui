<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ModalCosis extends Component
{
    // No usar $options nunca
   

    public function __construct(

    ) {

    }


    public function render()
    {
        return view('laracosis::modal-cosis');
    }
}
