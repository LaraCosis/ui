@props([
    'items' => [],
    'sidebarCollapsed' => false,
    'highlightMode' => 'standard',
    'highlightParentClass' => '',
    'highlightChildClass' => '',
    'itemClass' => '',
    'childItemClass' => '',
    'categoryClass' => '',
    'iconClass' => '',
    'childBorderClass' => '',
])

@php
    // Hover sólo si es modo text (siempre en inactivos)
    $itemHover = $highlightMode === 'text' ? $hoverTextClass : '';
    $childHover = $highlightMode === 'text' ? $hoverTextChildClass : '';


    function navCosisIsActive($item) {
        $request = request();
        if (!empty($item['match'])) {
            $matches = is_array($item['match']) ? $item['match'] : [$item['match']];
            foreach ($matches as $pattern) {
                if ($request->is(ltrim($pattern, '/'))) return true;
            }
        }
        if (!empty($item['route']) && $item['route'] !== '/' && (!isset($item['external']) || !$item['external'])) {
            if (is_string($item['route']) && !str_starts_with($item['route'], 'http')) {
                if ($request->is(ltrim($item['route'], '/'))) return true;
            }
        }
        if (!empty($item['children'])) {
            foreach ($item['children'] as $child) {
                if (navCosisIsActive($child)) return true;
            }
        }
        return false;
    }
    function navCosisRenderIcon($icon, $iconClass = '') {
        if (!$icon) return '';
        if (str_starts_with($icon, '<svg') || str_starts_with($icon, '<img')) {
            return $icon;
        }
        return '<i class="' . e(trim($icon . ' ' . $iconClass)) . '"></i>';
    }
    function navCosisId($item) {
        return md5(($item['route'] ?? '') . ($item['label'] ?? '') . json_encode($item['children'] ?? []));
    }
@endphp

<nav
    x-data="{
        open: {},
        init() {
            @foreach($items as $category)
                @foreach($category['items'] as $item)
                    @php $id = navCosisId($item); @endphp
                    @if(navCosisIsActive($item) && !empty($item['children']))
                        this.open['{{ $id }}'] = true;
                    @endif
                @endforeach
            @endforeach
        },
        toggle(id) { this.open[id] = !this.open[id]; },
        isOpen(id) { return !!this.open[id]; }
    }"
    class="flex-1 px-2 py-4 overflow-y-auto space-y-6"
>
    @foreach($items as $category)
        <div>
            <div class="{{ $categoryClass }} {{ $sidebarCollapsed === true || $sidebarCollapsed === 'true' ? 'hidden' : 'block' }}">
                {{ $category['category'] }}
            </div>
            <div class="space-y-1">
                @foreach($category['items'] as $item)
                    @if(!empty($item['divider']))
                        <div class="my-2 border-t border-gray-200 dark:border-gray-600"></div>
                        @continue
                    @endif
                    @php
                        $isActive = navCosisIsActive($item);
                        $hasChildren = !empty($item['children']);
                        $iconHtml = navCosisRenderIcon($item['icon'] ?? '', $iconClass);
                        $badge = $item['badge'] ?? null;
                        $disabled = $item['disabled'] ?? false;
                        $external = $item['external'] ?? false;
                        $itemId = navCosisId($item);
                        $itemClassOverride = $item['class'] ?? null;
                        $itemLabelClass = $item['label_class'] ?? '';

                        if ($itemClassOverride) {
                            $finalItemClass = trim($itemClassOverride);
                        } else {
                            if ($isActive) {
                                // Elimina cualquier text-gray-* (incluyendo dark:) y suma solo el highlight
                                $cleanClass = preg_replace('/text-gray-\d{3}|dark:text-gray-\d{3}/', '', $itemClass);
                                $finalItemClass = trim($cleanClass . ' ' . $highlightParentClass);
                            } else {
                                $finalItemClass = trim($itemClass . ' ' . $itemHover);
                            }
                        }
                    @endphp
                    <div>
                        <a
                            href="{{ $hasChildren ? '#' : ($item['route'] ?? '#') }}"
                            @if($hasChildren) @click.prevent="toggle('{{ $itemId }}')" @endif
                            class="{{ $finalItemClass }}{{ $disabled ? ' opacity-60 pointer-events-none' : '' }}"
                            title="{{ $item['tooltip'] ?? '' }}"
                            @if(!empty($item['tooltip'])) x-tooltip="'{{ $item['tooltip'] }}'" @endif
                            @if($external) target="_blank" rel="noopener" @endif
                            style="cursor: pointer;"
                        >
                            {!! $iconHtml !!}
                            <span class="truncate {{ $itemLabelClass }}" @if($sidebarCollapsed === true || $sidebarCollapsed === 'true') style="display:none;" @endif>
                                {{ $item['label'] }}
                            </span>
                            @if($badge)
                                <span class="ml-2 text-xs bg-green-600 text-white px-2 py-0.5 rounded-full">{{ $badge }}</span>
                            @endif
                            @if($hasChildren)
                                <i class="fas fa-caret-down ml-auto text-xs opacity-60"
                                    :class="{ 'rotate-180': isOpen('{{ $itemId }}') }"
                                    style="transition: transform 0.2s"
                                ></i>
                            @endif
                        </a>
                        @if($hasChildren)
                            <div
                                class="ml-7 {{ $childBorderClass }} pl-3 mt-1 space-y-1"
                                x-show="isOpen('{{ $itemId }}')"
                                x-transition
                                style="display: none;"
                            >
                                @foreach($item['children'] as $child)
                                    @if(!empty($child['divider']))
                                        <div class="my-2 border-t border-gray-200 dark:border-gray-600"></div>
                                        @continue
                                    @endif
                                    @php
                                        $childIsActive = navCosisIsActive($child);
                                        $childIcon = navCosisRenderIcon($child['icon'] ?? '', $iconClass);
                                        $childBadge = $child['badge'] ?? null;
                                        $childDisabled = $child['disabled'] ?? false;
                                        $childExternal = $child['external'] ?? false;
                                        $childClassOverride = $child['class'] ?? null;
                                        $childLabelClass = $child['label_class'] ?? '';
                                        if ($childClassOverride) {
                                            $finalChildClass = trim($childClassOverride);
                                        } else {
                                            if ($childIsActive) {
                                                $cleanChildClass = preg_replace('/text-gray-\d{3}|dark:text-gray-\d{3}/', '', $childItemClass);
                                                $finalChildClass = trim($cleanChildClass . ' ' . $highlightChildClass);
                                            } else {
                                                $finalChildClass = trim($childItemClass . ' ' . $childHover);
                                            }
                                        }

                                    @endphp
                                    <a
                                        href="{{ $child['route'] ?? '#' }}"
                                        class="{{ $finalChildClass }}{{ $childDisabled ? ' opacity-60 pointer-events-none' : '' }}"
                                        title="{{ $child['tooltip'] ?? '' }}"
                                        @if(!empty($child['tooltip'])) x-tooltip="'{{ $child['tooltip'] }}'" @endif
                                        @if($childExternal) target="_blank" rel="noopener" @endif
                                    >
                                        {!! $childIcon !!}
                                        <span class="truncate {{ $childLabelClass }}" @if($sidebarCollapsed === true || $sidebarCollapsed === 'true') style="display:none;" @endif>
                                            {{ $child['label'] }}
                                        </span>
                                        @if($childBadge)
                                            <span class="ml-2 text-xs bg-green-600 text-white px-2 py-0.5 rounded-full">{{ $childBadge }}</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</nav>
