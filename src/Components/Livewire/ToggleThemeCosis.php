<?php

namespace Laracosis\Ui\Components\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ToggleThemeCosis extends Component
{
    public string $size;
    public string $mode;
    public string $class;
    public $inheritColor;
    public string $defaultIconLight = 'text-yellow-400';
    public string $defaultIconDark  = 'text-blue-400';
    public string $defaultBorderLight = 'border-yellow-300 dark:border-yellow-400';
    public string $defaultBorderDark  = 'border-blue-400 dark:border-blue-500';
    public ?string $iconColorLight = null;
    public ?string $iconColorDark = null;
    public ?string $borderColorLight = null;
    public ?string $borderColorDark = null;

    public $iconSize;
    public $buttonPadding;
    public $squareButtonSize;

    public function mount()
    {
        if ($this->inheritColor === true || $this->inheritColor === 'true' || $this->inheritColor === 'parent' ) {
            $this->iconColorLight = $this->iconColorDark = $this->borderColorLight = $this->borderColorDark = 'parent';
        }
        $this->setSizes();
        $this->setButtonPadding();
        $this->setSquareButtonSize();
    }

    #[On('theme-toggled')]
    public function toggleTheme($dark): void
    {
        $this->dispatch('set-theme', ['dark' => $dark]);
    }

    public function setSizes(): void
    {
        $userSize = $this->size ?? 'md';
        $this->size = $this->iconSize = [
            'xs' => 'w-2 h-2',
            'sm' => 'w-3 h-3',
            'md' => 'w-4 h-4',
            'lg' => 'w-5 h-5',
            'xl' => 'w-6 h-6',
            '2xl' => 'w-8 h-8',
        ][$userSize];

    }

    public function setButtonPadding(): void
    {
        $buttonPaddings = [
            'xs'  => 'p-1',
            'sm'  => 'p-1.5',
            'md'  => 'p-2',
            'lg'  => 'p-3',
            'xl'  => 'p-4',
            '2xl' => 'p-5',
        ];
        $this->buttonPadding = $buttonPaddings[$this->size] ?? $buttonPaddings['md'];
    }

    public function setSquareButtonSize(): void
    {
        // Define sizes for square buttons
        $squareButtonSizes = [
            'xs'  => 'w-7 h-7',
            'sm'  => 'w-8 h-8',
            'md'  => 'w-10 h-10',
            'lg'  => 'w-12 h-12',
            'xl'  => 'w-14 h-14',
            '2xl' => 'w-16 h-16',
        ];
        $this->squareButtonSize = $squareButtonSizes[$this->size] ?? $squareButtonSizes['md'];
    }

    public function render()
    {
        return view('laracosis::livewire.toggle-theme-cosis');
    }
}
