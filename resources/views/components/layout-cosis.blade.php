@props(['behaviour' => 'push'])

<div x-data="{ sidebarOpen: true }" class="min-h-screen flex flex-col bg-gray-50">
    @if($behaviour === 'push')
        <div class="flex flex-1 h-screen">
            {{-- SIDEBAR, pegado arriba --}}
            <template x-if="sidebarOpen">
                <div class="bg-green-600 text-white p-4 flex flex-col" style="width:260px;">
                    {{ $sidebar ?? '' }}
                </div>
            </template>
            {{-- CONTENIDO (HEADER + MAIN + FOOTER) --}}
            <div class="flex flex-col flex-1 min-h-0">
                {{-- HEADER solo en la parte derecha --}}
                <div class="bg-blue-600 text-white p-4 flex items-center justify-between">
                    <div>{{ $header ?? '' }}</div>
                    <button @click="sidebarOpen = !sidebarOpen" class="ml-4 px-2 py-1 bg-gray-900 text-white rounded">
                        <span x-show="sidebarOpen">Cerrar Sidebar</span>
                        <span x-show="!sidebarOpen">Abrir Sidebar</span>
                    </button>
                </div>
                {{-- MAIN --}}
                <div class="flex-1 bg-gray-100 p-6 min-h-0">
                    {{ $main ?? '' }}
                </div>
                {{-- FOOTER --}}
                <div class="bg-purple-600 text-white p-4 text-center">
                    {{ $footer ?? '' }}
                </div>
            </div>
        </div>
    @else
        {{-- MODOS "sidebar" y "header" (overlay/sidebar encima, header encima) --}}
        <div class="flex flex-col min-h-screen">
            {{-- HEADER --}}
            <div
                class="w-full
                    @if($behaviour === 'sidebar') z-10
                    @elseif($behaviour === 'header') z-20
                    @endif
                    bg-blue-600 text-white p-4 flex items-center justify-between"
            >
                <div>{{ $header ?? '' }}</div>
                <button @click="sidebarOpen = !sidebarOpen" class="ml-4 px-2 py-1 bg-gray-900 text-white rounded">
                    <span x-show="sidebarOpen">Cerrar Sidebar</span>
                    <span x-show="!sidebarOpen">Abrir Sidebar</span>
                </button>
            </div>
            <div class="flex flex-1 w-full relative">
                {{-- SIDEBAR --}}
                <template x-if="sidebarOpen">
                    <div
                        @if($behaviour === 'sidebar')
                            class="bg-green-600 text-white p-4 h-screen fixed z-30 left-0 top-0"
                            style="width:260px;"
                        @elseif($behaviour === 'header')
                            class="bg-green-600 text-white p-4 h-screen sticky top-0 z-10"
                            style="width:260px;"
                        @endif
                    >
                        {{ $sidebar ?? '' }}
                    </div>
                </template>
                {{-- MAIN --}}
                <main
                    @if($behaviour === 'sidebar' || $behaviour === 'header')
                        :style="sidebarOpen ? 'margin-left: 260px;' : 'margin-left:0;'"
                    @endif
                    class="flex-1 bg-gray-100 p-6 transition-all duration-300 min-h-[80vh]"
                >
                    {{ $main ?? '' }}
                </main>
            </div>
            {{-- FOOTER --}}
            <div class="bg-purple-600 text-white p-4 text-center">
                {{ $footer ?? '' }}
            </div>
        </div>
    @endif
</div>
