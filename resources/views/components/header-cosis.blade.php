@props([
    'logo' => null,
    'title' => 'LaraCosis Playground',
])

<header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 h-16 flex items-center px-6 shadow-sm z-30">
    <div class="flex items-center gap-4">
        @if($logo)
            <img src="{{ $logo }}" alt="Logo" class="h-8">
        @else
            <span class="text-xl font-black bg-gradient-to-r from-fuchsia-600 to-blue-500 bg-clip-text text-transparent">LaraCosis</span>
        @endif
        <span class="ml-2 text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $title }}</span>
    </div>
    <div class="flex-1 flex items-center justify-center">
        {{ $slot ?? '' }}
    </div>
    <div class="flex items-center gap-3 ml-auto">
        {{ $actions ?? '' }}
    </div>
</header>
