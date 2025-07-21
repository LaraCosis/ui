<?php

namespace Laracosis\Ui\Components\Livewire;

use Livewire\Component;
use Laracosis\Ui\Helpers\SpinnerRegistry;

class ToastCosis extends Component
{
    public $toasts = [];

    protected $listeners = ['toast-cosis' => 'addToast'];

    public function addToast($toast)
    {
        // Asegurarse de id único
        $toast['id'] = $toast['id'] ?? uniqid();
        $this->toasts[] = $toast;
    }

    public function removeToast($id)
    {
        $this->toasts = array_filter($this->toasts, fn($toast) => $toast['id'] !== $id);
    }

    public function render()
    {
        return view('laracosis::livewire.toast-cosis');
    }
}
