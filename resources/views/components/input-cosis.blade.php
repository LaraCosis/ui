@props([
    'type' => 'text',
    'label' => null,
    'icon-start' => null,
    'icon-start-svg' => null,
    'icon-end' => null,
    'icon-end-svg' => null,
    'copy-button' => false,
    'clearable' => false,
    'help' => null,
    'error' => null,
    'placeholder' => '',
    'disabled' => false,
])

@php

    // Acceso props robusto
    $iconStart = ${'icon-start'} ?? null;
    $iconStartSvg = ${'icon-start-svg'} ?? null;
    $iconEnd = ${'icon-end'} ?? null;
    $iconEndSvg = ${'icon-end-svg'} ?? null;
    $copyButton = ${'copy-button'} ?? false;
    $clearable = ${'clearable'} ?? false;

    $isSearch = $type === 'search';
    // Placeholder: si el usuario manda uno, tiene prioridad sobre el default de search
    $ph = $placeholder !== '' ? $placeholder : ($isSearch ? 'Buscar...' : '');

    // Error validation auto/manual
    $wireModel = $attributes->wire('model')->value();
    $errorFromBag = $wireModel && $errors->has($wireModel) ? $errors->first($wireModel) : null;
    $finalError = $errorFromBag ?: $error;
    $hasError = !!$finalError;

    $fixLeftPadding = (isset($iconStart) || isset($iconStartSvg) || isset($start) || $isSearch) ? 'px-2' : 'px-4';

@endphp
<style>
    input[type="search"]::-webkit-search-cancel-button {
        display: none !important;
    }
    input[type="search"]::-webkit-search-clear-button {
        display: none !important;
    }
    input[type="search"]::-webkit-search-decoration,
    input[type="search"]::-webkit-search-results-decoration {
        display: none !important;
    }
    input[type="search"]::-ms-clear {
        display: none !important;
        width: 0;
        height: 0;
    }
    .laracosis-input:focus {
        outline: none !important;
        box-shadow: none !important;
    }
</style>
<div class="flex flex-col gap-1 w-full">
    {{-- Label --}}
    @if($label)
        <label class="-mb-1 ml-1 text-[15px] font-semibold {{ $hasError ? 'text-red-500 dark:text-red-400' : 'text-gray-800 dark:text-gray-300' }}">
            {{ $label }}
        </label>
    @endif

    <div
        class="relative flex items-center bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 border rounded-md shadow-sm px-0 py-0 focus-within:ring-2 transition
            @if($hasError) border-red-500 ring-red-200 dark:ring-red-900
            @else border-gray-300 dark:border-gray-700 focus-within:ring-blue-400 dark:focus-within:ring-blue-500 @endif"
        x-data="{
            show: false,
            copySuccess: false,
            value: '',
            get type() { return '{{ $type }}' === 'password' && this.show ? 'text' : '{{ $type }}'; },
            clear() {
                this.$refs.input.value = '';
                this.value = '';
                this.$refs.input.dispatchEvent(new Event('input'));
            },
            copyToClipboard() {
                navigator.clipboard.writeText(this.$refs.input.value).then(() => {
                    this.copySuccess = true;
                    setTimeout(() => this.copySuccess = false, 1000);
                });
            }
        }"
        x-init="value = $refs.input ? $refs.input.value : ''"
    >

        {{-- Slot inicio --}}
        @isset($start)
            <span class="mr-2">
                {{ $start }}
            </span>
        @endisset

        {{-- Icono inicio: SVG custom > icono clase > lupa de search --}}
        @if($iconStartSvg)
            {!! $iconStartSvg !!}
        @elseif($iconStart)
            <i class="{{ $iconStart }} mr-2 ml-4 text-neutral-400 dark:text-neutral-500"></i>
        @elseif($isSearch)
            <svg class="mr-2 ml-4 w-5 h-5 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        @endif

        {{-- Input --}}
        <input
            x-ref="input"
            x-bind:type="type"
            x-on:input="value = $event.target.value"
            {{ $attributes->merge([
                'class' => 'laracosis-input w-full border-none outline-none bg-transparent py-2 text-gray-800 dark:text-gray-100 '.$fixLeftPadding ,
                'placeholder' => $ph,
                'disabled' => $disabled,
                'autocomplete' => $type === 'password' ? 'current-password' : 'off',
                'aria-invalid' => $hasError ? 'true' : 'false',
            ]) }}
        />

        {{-- Clearable: solo si hay texto --}}
        @if($clearable)
            <button
                type="button"
                class="ml-2 mr-1 text-neutral-400 dark:text-neutral-500 hover:text-red-500 dark:hover:text-red-400 transition"
                x-show="value.length > 0"
                x-on:click="clear"
                tabindex="-1"
                aria-label="Borrar contenido"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        @endif

        {{-- Icono fin --}}
        @if($iconEndSvg)
            {!! $iconEndSvg !!}
        @elseif($iconEnd)
            <i class="{{ $iconEnd }} ml-2 mr-4 text-neutral-400 dark:text-neutral-500"></i>
        @endif

        {{-- Copy button --}}
        @if($copyButton)
            <button
                type="button"
                class="ml-2 text-neutral-400 dark:text-neutral-500 hover:text-green-600 dark:hover:text-green-400 transition {{(isset($end) || isset($copyButton) || isset($iconEndSvg) || isset($iconEnd)) ? 'mr-2' : 'mr-4'}}"
                x-on:click="copyToClipboard"
                x-tooltip.raw="Copiar"
                tabindex="-1"
                aria-label="Copiar al portapapeles"
            >
                <svg x-show="!copySuccess" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                <svg x-show="copySuccess" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
            </button>
        @endif

        {{-- Password: OJITO --}}
        @if($type === 'password')
            <button
                type="button"
                class="ml-2 text-neutral-400 dark:text-neutral-500 hover:text-blue-600 dark:hover:text-blue-400 transition {{(isset($end) || isset($copyButton) || isset($iconEndSvg) || isset($iconEnd)) ? 'mr-2' : 'mr-4'}}"
                tabindex="-1"
                x-on:click="show = !show"
                aria-label="Mostrar/ocultar contraseña"
            >
                {{-- Ojito cerrado --}}
                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                {{-- Ojito abierto --}}
                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13.875 18.825A10.05 10.05 0 0 1 12 19c-7 0-11-7-11-7a21.05 21.05 0 0 1 3.94-4.58m3.67-2.59C10.58 4.44 11.29 4 12 4c7 0 11 8 11 8a20.87 20.87 0 0 1-4.19 5.31M1 1l22 22"/></svg>
            </button>
        @endif

        {{-- Slot fin --}}
        @isset($end)
            <span class="ml-2">
                {{ $end }}
            </span>
        @endisset
    </div>

    @if($hasError)
        <div class="text-xs mt-1 text-red-500">{{ $finalError }}</div>
    @endif

    @if($help)
        <div class="text-xs mt-1 text-neutral-400 dark:text-neutral-500">{{ $help }}</div>
    @endif
</div>
