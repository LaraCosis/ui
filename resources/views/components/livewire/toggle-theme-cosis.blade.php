<section>
@php
// Helpers
if(! function_exists('getIconClass')) {
    function getIconClass($base, $custom, $default) {
        if ($custom === 'parent') return $base;
        if ($custom) return $base . ' ' . $custom;
        return $base . ' ' . $default;
    }
}

if(! function_exists('getBorderClass')) {
    function getBorderClass($custom, $default) {
        if ($custom === 'parent') return '';
        if ($custom) return $custom;
        return $default;
    }
}
@endphp

<style>
.theme-rotatable {
    transform: rotate(0deg);
    transition: transform 0.5s cubic-bezier(.4,2,.6,1) !important;
}
.theme-rotate {
    transform: rotate(360deg) !important;
}
</style>

<div
    x-data="{
        dark: localStorage.theme === 'dark'
            || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        rotating: false,
        toggle() {
            this.rotating = true;
            this.dark = !this.dark;
            if (this.dark) {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            }
            if (window.Livewire) {
                window.Livewire.dispatch('theme-toggled', { dark: this.dark });
            }
            setTimeout(() => { this.rotating = false }, 50);
        },
    }"
    x-init="
        if (dark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        document.addEventListener('set-theme', function(e) {
            dark = e.detail[0].dark;
        });
    "
    class="inline-flex items-center cursor-pointer {{ $class }}"
>
    @if($mode === 'button')
        <button
            type="button"
            @click="toggle()"
            :aria-pressed="dark"
            class="flex items-center gap-2 rounded-full border-2
                   bg-white dark:bg-gray-900 transition
                   hover:bg-gray-100 dark:hover:bg-gray-800
                   shadow-sm focus:outline-none {{ $buttonPadding }} {{ getBorderClass($borderColorLight, $defaultBorderLight) }}"
            :class="dark ? '{{ getBorderClass($borderColorDark, $defaultBorderDark) }}' : '{{ getBorderClass($borderColorLight, $defaultBorderLight) }}'"
        >
            <svg
                x-show="!dark"
                :class="[
                    'theme-rotatable',
                    '{{ getIconClass($iconSize, $iconColorLight, $defaultIconLight) }}',
                    rotating ? 'theme-rotate' : ''
                ]"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            >
                <circle cx="12" cy="12" r="5"/>
                <path d="M12 1v2m0 18v2m11-11h-2M3 12H1
                    m16.95 7.07l-1.41-1.41
                    M5.46 5.46L4.05 4.05
                    m14.14 0l-1.41 1.41
                    M5.46 18.54l-1.41 1.41"/>
            </svg>
            <svg
                x-show="dark"
                :class="[
                    'theme-rotatable',
                    '{{ getIconClass($iconSize, $iconColorDark, $defaultIconDark) }}',
                    rotating ? 'theme-rotate' : ''
                ]"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            >
                <path d="M21 12.79A9 9 0 1111.21 3
                    a7 7 0 109.79 9.79z"/>
            </svg>
        </button>
    @elseif($mode === 'square-button')
        <button
            type="button"
            @click="toggle()"
            :aria-pressed="dark"
            class="flex items-center justify-center border-2 transition shadow-sm focus:outline-none rounded-lg
                   bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800
                   {{ $squareButtonSize }} {{ getBorderClass($borderColorLight, $defaultBorderLight) }}"
            :class="dark ? '{{ getBorderClass($borderColorDark, $defaultBorderDark) }}' : '{{ getBorderClass($borderColorLight, $defaultBorderLight) }}'"
            style="padding: 0;"
        >
            <svg
                x-show="!dark"
                :class="[
                    'theme-rotatable',
                    '{{ getIconClass($iconSize, $iconColorLight, $defaultIconLight) }}',
                    rotating ? 'theme-rotate' : ''
                ]"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            >
                <circle cx="12" cy="12" r="5"/>
                <path d="M12 1v2m0 18v2m11-11h-2M3 12H1
                    m16.95 7.07l-1.41-1.41
                    M5.46 5.46L4.05 4.05
                    m14.14 0l-1.41 1.41
                    M5.46 18.54l-1.41 1.41"/>
            </svg>
            <svg
                x-show="dark"
                :class="[
                    'theme-rotatable',
                    '{{ getIconClass($iconSize, $iconColorDark, $defaultIconDark) }}',
                    rotating ? 'theme-rotate' : ''
                ]"
                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            >
                <path d="M21 12.79A9 9 0 1111.21 3
                    a7 7 0 109.79 9.79z"/>
            </svg>
        </button>
    @else
        <svg
            x-show="!dark"
            @click="toggle()"
            :class="[
                'theme-rotatable',
                '{{ getIconClass($iconSize, $iconColorLight, $defaultIconLight) }}',
                rotating ? 'theme-rotate' : ''
            ]"
            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            style="cursor: pointer"
        >
            <circle cx="12" cy="12" r="5"/>
            <path d="M12 1v2m0 18v2m11-11h-2M3 12H1
                m16.95 7.07l-1.41-1.41
                M5.46 5.46L4.05 4.05
                m14.14 0l-1.41 1.41
                M5.46 18.54l-1.41 1.41"/>
        </svg>
        <svg
            x-show="dark"
            @click="toggle()"
            :class="[
                'theme-rotatable',
                '{{ getIconClass($iconSize, $iconColorDark, $defaultIconDark) }}',
                rotating ? 'theme-rotate' : ''
            ]"
            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            style="cursor: pointer"
        >
            <path d="M21 12.79A9 9 0 1111.21 3
                a7 7 0 109.79 9.79z"/>
        </svg>
    @endif
</div>
</section>
