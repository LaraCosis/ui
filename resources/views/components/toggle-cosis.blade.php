@props([
    'label' => null,
    'disabled' => false,
    'color' => 'blue',
    'colorHex' => null,
    'size' => 'md', // 'xs', 'sm', 'md', 'lg'
    'labelPosition' => 'right', // o 'left'
])

@php
    $toggleId = uniqid('toggle_');
    $sizeMap = [
        'xs' => [
            'toggle' => 'w-7 h-3',
            'thumb' => 'w-3.5 h-3.5', // 14px
            'thumb-translate' => 'translate-x-3.5',
            'label' => 'text-xs',
        ],
        'sm' => [
            'toggle' => 'w-8 h-4',
            'thumb' => 'w-4 h-4', // 16px
            'thumb-translate' => 'translate-x-4',
            'label' => 'text-sm',
        ],
        'md' => [
            'toggle' => 'w-10 h-6',
            'thumb' => 'w-6 h-6', // 24px
            'thumb-translate' => 'translate-x-4',
            'label' => 'text-base',
        ],
        'lg' => [
            'toggle' => 'w-14 h-8',
            'thumb' => 'w-8 h-8', // 32px
            'thumb-translate' => 'translate-x-6',
            'label' => 'text-lg',
        ],
    ];
    $s = $sizeMap[$size] ?? $sizeMap['md'];

    // Lógica de color Tailwind o custom hex
    $tailwindBgOn = "bg-{$color}-600 dark:bg-{$color}-500";
    $tailwindBorderOn = "border-{$color}-300 dark:border-{$color}-500";
    $tailwindTextOn = "text-{$color}-600 dark:text-{$color}-400";
    $customBgOn = $colorHex ? "bg-[{$colorHex}]" : $tailwindBgOn;
    $customBorderOn = $colorHex ? "border-[{$colorHex}]" : $tailwindBorderOn;
    $customTextOn = $colorHex ? "text-[{$colorHex}]" : $tailwindTextOn;
@endphp

<div
    x-data="{
        checked: @entangle($attributes->wire('model')),
        loading: false,
        toggle() {
            if (this.loading || {{ $disabled ? 'true' : 'false' }}) return;
            this.loading = true;
            this.checked = !this.checked;
            setTimeout(() => this.loading = false, 350);
        }
    }"
    class="flex items-center gap-2"
>
    @if($label && $labelPosition === 'left')
        <label
            for="{{ $toggleId }}"
            class="{{ $s['label'] }} select-none text-gray-800 dark:text-gray-200 cursor-pointer"
            @click.prevent="$refs.toggleBtn.click()"
        >
            {{ $label }}
        </label>
    @endif

    <button
        x-ref="toggleBtn"
        id="{{ $toggleId }}"
        type="button"
        :class="checked
            ? '{{ $customBgOn }}'
            : 'bg-gray-300 dark:bg-gray-700'"
        class="relative {{ $s['toggle'] }} rounded-full transition-colors duration-200 focus:outline-none"
        @click="toggle"
        :disabled="loading || {{ $disabled ? 'true' : 'false' }}"
        aria-checked="checked"
        role="switch"
    >
        <span
            :class="checked ? '{{ $s['thumb-translate'] }}' : 'translate-x-0'"
            class="absolute left-0 top-0 {{ $s['thumb'] }} bg-white rounded-full shadow transition-transform duration-200 flex items-center justify-center border
                {{ $customBorderOn }}"
        >
            <template x-if="loading">
                <svg class="animate-spin w-4 h-4 {{ $customTextOn }}" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
            </template>
        </span>
        <input
            id="{{ $toggleId }}_input"
            type="checkbox"
            class="hidden"
            {{ $attributes->merge(['disabled' => $disabled]) }}
            :checked="checked"
            @change="toggle"
            tabindex="-1"
            aria-hidden="true"
        />
    </button>

    @if($label && $labelPosition !== 'left')
        <label
            for="{{ $toggleId }}"
            class="{{ $s['label'] }} select-none text-gray-800 dark:text-gray-200 cursor-pointer"
            @click.prevent="$refs.toggleBtn.click()"
        >
            {{ $label }}
        </label>
    @endif
</div>
