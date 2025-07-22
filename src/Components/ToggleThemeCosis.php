<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class ToggleThemeCosis extends Component
{
    // No usar $options nunca


    public function __construct(
        public string $size = 'md',
        public string $mode = 'icon', // icon | button | square-button
        public string $class = '',
        public bool $inheritColor = false,
        public ?string $iconColorLight = null,
        public ?string $iconColorDark = null,
        public ?string $borderColorLight = null,
        public ?string $borderColorDark = null,
    ) {

    }


    public function render()
    {
        return <<<'blade'
            <livewire:toggle-theme-cosis
                size="{{ $size }}"
                mode="{{ $mode }}"
                class="{{ $class }}"
                inherit-color="{{ $inheritColor ? 'true' : 'false' }}"
                icon-color-light="{{ $iconColorLight }}"
                icon-color-dark="{{ $iconColorDark }}"
                border-color-light="{{ $borderColorLight }}"
                border-color-dark="{{ $borderColorDark }}"
            />
        blade;
    }
}
