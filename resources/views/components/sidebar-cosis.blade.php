@props([
    'items' => [], // Ej: [['label' => 'Home', 'icon' => 'home', 'route' => '/'], ...]
    'logo' => null,
    'fixed' => true,
])

<aside
    class="bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800
        {{ $fixed ? 'fixed top-0 left-0 h-screen' : 'relative' }}
        w-64 z-40 flex flex-col shadow-sm"
>
    <div class="h-20 flex items-center justify-center border-b border-gray-100 dark:border-gray-800">
        @if($logo)
            <img src="{{ $logo }}" alt="Logo" class="h-12">
        @else
            <span class="text-2xl font-bold bg-gradient-to-r from-fuchsia-600 to-blue-500 bg-clip-text text-transparent">LaraCosis</span>
        @endif
    </div>
    <nav class="flex-1 overflow-y-auto px-2 py-4">
        {{ $slot }}
        @if(count($items))
            <ul class="space-y-1">
                @foreach($items as $item)
                    <li>
                        <a href="{{ $item['route'] }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-fuchsia-50 dark:hover:bg-gray-800 font-medium transition
                            {{ (request()->is(ltrim($item['route'],'/'))) ? 'bg-fuchsia-100 dark:bg-gray-800 font-semibold' : '' }}"
                        >
                            @if(isset($item['icon']))
                                <i class="{{ $item['icon'] }}"></i>
                            @endif
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </nav>
    @if (isset($footer))
        <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-800">
            {{ $footer }}
        </div>
    @endif
</aside>
