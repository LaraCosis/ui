<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ToggleCosis extends Component
{

    public ?string $label;
    public ?string $color;
    public bool $disabled;

    /**
     * Create a new component instance.
     *
     * @param  string|null  $label
     * @param  bool  $disabled
     * @return void
     */
    public function __construct(?string $label = null, ?string $color = null, bool $disabled = false)
    {
        $this->label = $label;
        $this->color = $color;
        $this->disabled = $disabled;
    }


    public function render()
    {
        return view('laracosis::toggle-cosis');
    }
}
