@props([
    'id' => null,
    'maxWidth' => '3xl',
    'zIndex' => 'z-50',
])

@php
    $modalId = $id ?? 'modal-' . uniqid();
@endphp

<div
    x-data="{
        open: @entangle($attributes->wire('model')),
        close() { this.open = false; },
        openModal() { this.open = true; },
    }"
    x-show="open"
{{--     x-cloak --}}
    id="{{ $modalId }}"
    class="fixed inset-0 {{ $zIndex }} flex items-start justify-center transition-all"
    x-on:keydown.escape.window="close()"
    x-on:close-modal.window="close()"
    x-on:open-modal.window="openModal()"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95 translate-y-2"
    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    x-transition:leave="ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
    x-transition:leave-end="opacity-0 scale-95 translate-y-2"
{{--     style="display: none;" --}}
>
    <!-- Overlay (z-index igual al modal) -->
    <div
        class="absolute inset-0 w-full h-full bg-black/50 dark:bg-black/70 backdrop-blur-md transition-all {{ $zIndex }}"
        @click="close()"
    ></div>
    <!-- Wrapper para ubicar el modal -->
    <div class="mt-32 w-full flex justify-center {{ $zIndex }}">
        <!-- Contenido del modal (también el z-index!) -->
        <div
            @click.stop
            class="relative w-full max-w-{{ $maxWidth }} mx-auto rounded-2xl shadow-2xl p-8
                bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg
                border border-gray-200 dark:border-gray-700
                ring-1 ring-black/5 dark:ring-white/10
                transition-all {{ $zIndex }}"
        >
            <!-- Botón cerrar -->
            <button type="button"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-100 transition"
                @click="close()"
            >
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

            @isset($title)
                <div class="mb-6 text-2xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight">
                    {{ $title }}
                </div>
            @endisset

            <div class="mb-4 text-gray-800 dark:text-gray-200">
                {{ $slot }}
            </div>

            @isset($footer)
                <div class="flex justify-end gap-2 mt-6">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
