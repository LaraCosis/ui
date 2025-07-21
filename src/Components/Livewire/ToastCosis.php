<?php

namespace Laracosis\Ui\Components\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ToastCosis extends Component
{
    public $toasts = [];
    public $position;


    protected $listeners = ['toast-cosis' => 'addToast'];

    public function addToast($toast)
    {
        $toast['id'] = $toast['id'] ?? uniqid();
        $toast['duration'] = $toast['duration'] ?? 4000;
        $toast['position'] = $toast['position'] ?? $this->position;
        $this->toasts[] = $toast;
    }

    public function removeToast($id)
    {
        $this->toasts = array_values(array_filter($this->toasts, fn($t) => $t['id'] !== $id));
    }

    public function render()
    {
        return view('laracosis::livewire.toast-cosis');
    }
}
