@props([
    'type' => 'button',
    'size' => 'md',
    'color' => 'primary',
    'icon' => null,
    'iconPosition' => 'left',
    'spinner' => true,
    'disabled' => false,
])

@php
    // Tamaños de botón
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-5 py-2 text-base',
        'lg' => 'px-8 py-3 text-lg',
    ];

    // Colores
    $colors = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white border border-blue-700 dark:bg-blue-500 dark:border-blue-400 dark:hover:bg-blue-600',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800 border border-gray-300 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-200 dark:hover:bg-gray-600',
        'success' => 'bg-green-600 hover:bg-green-700 text-white border border-green-700 dark:bg-green-500 dark:border-green-400 dark:hover:bg-green-600',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white border border-red-700 dark:bg-red-500 dark:border-red-400 dark:hover:bg-red-600',
    ];

    $buttonClass = $sizes[$size] . ' ' . ($colors[$color] ?? $color) . ' rounded-2xl shadow-md font-semibold flex items-center gap-2 transition-all duration-200 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 dark:focus:ring-blue-800';

@endphp

<button 
    {{ $attributes->merge([
        'type' => $type,
        'class' => $buttonClass,
        'disabled' => $disabled ? 'disabled' : null
    ]) }}
>
    {{-- Spinner Livewire: wire:loading y wire:target--}}
    @if($spinner)
        <span 
            wire:loading 
            @if($attributes->has('wire:target'))
                wire:target="{{ $attributes->get('wire:target') }}"
            @endif
            class="absolute left-4 flex items-center"
        >
            <svg class="animate-spin w-5 h-5 text-white dark:text-gray-200" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </span>
    @endif

    {{-- Icono a la izquierda --}}
    @if($icon && $iconPosition === 'left')
        <i class="{{ $icon }} mr-2"></i>
    @endif

    {{-- Contenido principal --}}
    <span class="flex-1">
        {{ $slot }}
    </span>

    {{-- Icono a la derecha --}}
    @if($icon && $iconPosition === 'right')
        <i class="{{ $icon }} ml-2"></i>
    @endif
</button>
