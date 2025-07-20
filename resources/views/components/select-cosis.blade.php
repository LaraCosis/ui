@props([
    'options' => [],
    'selected' => null,
    'icon' => null,
    'placeholder' => 'Seleccionar...',
    'searchable' => false,
    'label' => null,
    'multiple' => false,
    'clearable' => true,
    'remote' => false,
    'remoteUrl' => null,
])

@php
    $model = $attributes->wire('model');
    $classValue = $attributes->get('class');
    if (is_array($classValue)) {
        $classValue = implode(' ', $classValue);
    }
@endphp

<div
    x-data="{
        open: false,
        search: '',
        loading: false,
        searchable: {{ $searchable ? 'true' : 'false' }},
        multiple: {{ $multiple ? 'true' : 'false' }},
        clearable: {{ $clearable ? 'true' : 'false' }},
        remote: {{ $remote ? 'true' : 'false' }},
        remoteUrl: '{{ $remoteUrl ?? '' }}',
        @if($model)
            selected: @entangle($model),
        @else
            selected: {{ $multiple ? (is_array($selected) ? Js::from($selected) : '[]') : "'" . (string) $selected . "'" }},
        @endif
        options: {{ $remote ? '{}' : Js::from($options) }},
        get filteredOptions() {
            if (!this.search) return this.options;
            const s = this.search.toLowerCase();
            return Object.fromEntries(
                Object.entries(this.options)
                    .filter(([key, option]) => {
                        let label = typeof option === 'object'
                            ? (option.label ?? option.name ?? option.value)
                            : option;
                        return label && label.toLowerCase().includes(s);
                    })
            );
        },
        fetchRemote() {
            if (!this.remote || !this.remoteUrl) return;
            this.loading = true;
            fetch(this.remoteUrl + '?q=' + encodeURIComponent(this.search))
                .then(res => res.json())
                .then(data => { this.options = data; })
                .finally(() => { this.loading = false; });
        },
    }"
    x-effect="open && remote && fetchRemote()"
    @input.debounce.400ms="if(remote) fetchRemote()"
    class="relative w-full {{ $classValue }}"
>
    {{-- Fix Livewire + Alpine: sincronización 100% confiable --}}
    @if($model)
        <input type="hidden" {{ $attributes->whereStartsWith('wire:model') }} x-model="selected">
    @endif

    @if ($label)
        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <!-- Botón principal -->
    <button
        @click="open = !open"
        type="button"
        class="flex items-center w-full rounded-xl bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-700
               text-gray-900 dark:text-gray-100 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
               shadow-sm justify-between transition"
        :class="{ 'ring-2 ring-blue-500': open }"
    >
        <span class="flex items-center gap-2 flex-1 min-w-0">
            @if (!empty($icon))
                {!! $icon !!}
            @endif
            <!-- Si hay una sola seleccionada: avatar o icono -->
            <template x-if="
                (multiple && Array.isArray(selected) && selected.length === 1 && typeof options[selected[0]] === 'object' && (options[selected[0]].avatar || options[selected[0]].icon))
                || (!multiple && selected && typeof options[selected] === 'object' && (options[selected].avatar || options[selected].icon))
            ">
                <span class="flex items-center">
                    <!-- Avatar -->
                    <template x-if="multiple
                        ? (options[selected[0]] && options[selected[0]].avatar)
                        : (options[selected] && options[selected].avatar)">
                        <img
                            :src="multiple ? options[selected[0]].avatar : options[selected].avatar"
                            alt="avatar"
                            class="w-6 h-6 rounded-full object-cover"
                        />
                    </template>
                    <!-- Icon -->
                    <template x-if="multiple
                        ? (options[selected[0]] && !options[selected[0]].avatar && options[selected[0]].icon)
                        : (options[selected] && !options[selected].avatar && options[selected].icon)">
                        <span
                            x-html="multiple ? options[selected[0]].icon : options[selected].icon"
                            class="w-6 h-6 flex-shrink-0"
                        ></span>
                    </template>
                </span>
            </template>

            <!-- Si hay varias seleccionadas: avatares apilados -->
            <template x-if="multiple && Array.isArray(selected) && selected.length > 1">
                <span class="flex -space-x-2">
                    <template x-for="(id, idx) in selected.slice(0,3)" :key="id">
                        <span>
                            <template x-if="options[id]?.avatar">
                                <img :src="options[id].avatar"
                                     alt="avatar"
                                     class="w-6 h-6 rounded-full object-cover ring-2 ring-white dark:ring-gray-800" />
                            </template>
                            <template x-if="!options[id]?.avatar && options[id]?.icon">
                                <span x-html="options[id].icon"
                                      class="w-6 h-6 rounded-full bg-gray-200 ring-2 ring-white dark:ring-gray-800 flex items-center justify-center"></span>
                            </template>
                            <template x-if="!options[id]?.avatar && !options[id]?.icon">
                                <span class="w-6 h-6 rounded-full bg-gray-300 ring-2 ring-white dark:ring-gray-800 flex items-center justify-center text-xs text-gray-500">
                                    <span x-text="options[id]?.label ? options[id].label.charAt(0).toUpperCase() : '?'"></span>
                                </span>
                            </template>
                        </span>
                    </template>
                    <!-- +N extra si hay más de 3 -->
                    <template x-if="selected.length > 3">
                        <span class="w-6 h-6 rounded-full bg-gray-400 ring-2 ring-white dark:ring-gray-800 flex items-center justify-center text-xs text-white font-bold">
                            <span x-text="'+' + (selected.length - 3)"></span>
                        </span>
                    </template>
                </span>
            </template>

            <span class="truncate"
                x-text="
                    multiple
                        ? (
                            Array.isArray(selected) && selected.length > 0
                                ? selected.map(id => (options[id]?.label ?? options[id]?.name ?? options[id] ?? '')).join(', ')
                                : '{{ $placeholder }}'
                          )
                        : (selected && options[selected] ? (options[selected]?.label ?? options[selected]?.name ?? options[selected]) : '{{ $placeholder }}')
                ">
            </span>
        </span>

        <!-- Botón limpiar selección (a la derecha) -->
        <template x-if="clearable && ((multiple && Array.isArray(selected) && selected.length > 0) || (!multiple && selected))">
            <button
                type="button"
                class="ml-1 text-gray-400 hover:text-red-500 transition focus:outline-none"
                @click.stop="
                    if (multiple) { selected = []; }
                    else { selected = null; }
                "
                tabindex="-1"
                title="Limpiar selección"
            >
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 8.586l4.95-4.95a1 1 0 111.414 1.414L11.414 10l4.95 4.95a1 1 0 01-1.414 1.414L10 11.414l-4.95 4.95a1 1 0 01-1.414-1.414L8.586 10l-4.95-4.95A1 1 0 015.05 3.636l4.95 4.95z" clip-rule="evenodd" />
                </svg>
            </button>
        </template>

        <svg class="w-5 h-5 text-gray-400 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <!-- Dropdown -->
    <div
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute left-0 z-50 mt-2 w-full rounded-xl bg-white dark:bg-gray-900 shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"
    >
        <!-- Input búsqueda (opcional) -->
        <template x-if="searchable">
            <div class="p-2 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <input
                    type="text"
                    x-model="search"
                    placeholder="Buscar..."
                    class="w-full px-3 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition text-sm"
                    autocomplete="off"
                />
            </div>
        </template>
        <ul class="divide-y divide-gray-100 dark:divide-gray-800 max-h-60 overflow-y-auto">
            <!-- Loading -->
            <template x-if="loading">
                <li class="block px-4 py-2 text-gray-400 text-sm italic">Cargando...</li>
            </template>
            <template x-for="[id, option] in (searchable ? Object.entries(filteredOptions) : Object.entries(options))" :key="id">
                <li>
                    <button
                        @click="
                            if (multiple) {
                                if (Array.isArray(selected)) {
                                    if (selected.includes(id)) {
                                        selected = selected.filter(i => i !== id);
                                    } else {
                                        selected = [...selected, id];
                                    }
                                } else {
                                    selected = [id];
                                }
                            } else {
                                selected = id;
                                open = false;
                            }
                        "
                        type="button"
                        class="w-full text-left px-4 py-2 flex items-center gap-2
                            hover:bg-blue-50 dark:hover:bg-blue-800/70 transition"
                        :class="multiple
                            ? (Array.isArray(selected) && selected.includes(id)
                                ? 'font-bold text-blue-600 dark:text-blue-300 bg-blue-100 dark:bg-blue-900/60'
                                : 'text-gray-900 dark:text-gray-100')
                            : (id == selected
                                ? 'font-bold text-blue-600 dark:text-blue-300 bg-blue-100 dark:bg-blue-900/60'
                                : 'text-gray-900 dark:text-gray-100')"
                    >
                        <!-- Avatar por opción -->
                        <template x-if="typeof option === 'object' && option.avatar">
                            <img :src="option.avatar" alt="avatar" class="w-6 h-6 rounded-full object-cover" />
                        </template>
                        <!-- Icono por opción -->
                        <template x-if="typeof option === 'object' && !option.avatar && option.icon">
                            <span x-html="option.icon"></span>
                        </template>
                        <!-- Label/nombre -->
                        <span class="truncate" x-text="typeof option === 'object'
                            ? (option.label ?? option.name ?? option.value ?? id)
                            : option
                        "></span>
                        <!-- Description -->
                        <template x-if="typeof option === 'object' && option.description">
                            <span class="ml-2 text-xs text-gray-400" x-text="option.description"></span>
                        </template>
                        <!-- Checkbox para multiselección -->
                        <template x-if="multiple">
                            <span class="ml-auto">
                                <input type="checkbox"
                                    :checked="Array.isArray(selected) && selected.includes(id)"
                                    class="form-checkbox rounded border-gray-400"
                                    readonly
                                />
                            </span>
                        </template>
                    </button>
                </li>
            </template>
            <template x-if="Object.keys(filteredOptions).length === 0 && search && !loading">
                <li>
                    <span class="block px-4 py-2 text-gray-400 text-sm italic">Sin resultados</span>
                </li>
            </template>
        </ul>
    </div>
</div>
