@props([
    'id' => null,
    'maxWidth' => '2xl', // tailwind max-w-2xl por defecto
    'show' => false, // Puede venir de Livewire o Alpine
])

@php
    $modalId = $id ?? 'modal-' . uniqid();
@endphp

<div
    x-data="{
        open: @entangle($attributes->wire('model')) || {{ $show ? 'true' : 'false' }},
        close() { this.open = false; }
    }"
    x-show="open"
    x-cloak
    id="{{ $modalId }}"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
    x-on:keydown.escape.window="close()"
    x-on:close-modal.window="close()"
    style="display: none;"
>
    <!-- Fondo oscuro (cierra modal al hacer click afuera) -->
    <div class="absolute inset-0" @click="close()"></div>

    <!-- Contenido del modal -->
    <div
        @click.stop
        class="relative w-full max-w-{{ $maxWidth }} mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
    >
        <!-- Botón cerrar -->
        <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600" @click="close()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Slot título -->
        @if(isset($title) || isset($header))
            <div class="mb-4 text-lg font-bold">
                {{ $title ?? $header }}
            </div>
        @endif

        <!-- Slot contenido -->
        <div class="mb-4">
            {{ $slot }}
        </div>

        <!-- Slot acciones -->
        @if(isset($footer))
            <div class="flex justify-end gap-2 mt-4">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
