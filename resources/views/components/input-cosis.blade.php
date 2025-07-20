@props([
    'type' => 'text',
    'placeholder' => '',
    'iconStart' => null,
    'iconEnd' => null,
    'buttonStart' => null,
    'buttonEnd' => null,
    'clearable' => false,
    'model' => null,
])

<div x-data="{ value: @entangle($attributes->wire('model')).live }" class="relative flex items-center w-full">

    @if($iconStart)
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-gray-400">
            <x-dynamic-component :component="$iconStart" class="w-5 h-5" />
        </span>
    @endif

    @if($buttonStart)
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
            {{ $buttonStart }}
        </span>
    @endif

    <input
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        x-model="value"
        class="w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 py-2
        {{ $iconStart || $buttonStart ? 'pl-10' : 'pl-3' }}
        {{ $iconEnd || $buttonEnd || $clearable ? 'pr-10' : 'pr-3' }}
        shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
    />

    @if($clearable)
        <button x-show="value" @click="value = ''"
            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9.293l4.646-4.647a.5.5 0 01.708.708L10.707 10l4.647 4.646a.5.5 0 01-.708.708L10 10.707l-4.646 4.647a.5.5 0 01-.708-.708L9.293 10 4.646 5.354a.5.5 0 01.708-.708L10 9.293z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif

    @if($iconEnd)
        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-400">
            <x-dynamic-component :component="$iconEnd" class="w-5 h-5" />
        </span>
    @endif

    @if($buttonEnd)
        <span class="absolute inset-y-0 right-0 flex items-center pr-2">
            {{ $buttonEnd }}
        </span>
    @endif

</div>
