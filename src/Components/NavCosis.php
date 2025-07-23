<?php

namespace Laracosis\Ui\Components;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class NavCosis extends Component
{

    public $items;
    public $sidebarCollapsed;
    public $highlightMode;
    public $highlightParentClass;
    public $highlightChildClass;
    public $itemClass;
    public $childItemClass;
    public $categoryClass;
    public $iconClass;
    public $childBorderClass;
    public $hoverTextClass;
    public $hoverTextChildClass;


    public function __construct(
        $items = null,
        $sidebarCollapsed = false,
        $highlightMode = 'standard',
        $highlightParentClass = null,
        $highlightChildClass = null,
        $itemClass = null,
        $childItemClass = null,
        $categoryClass = 'text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase px-3 mb-1 tracking-wide select-none',
        $iconClass = '',
        $childBorderClass = 'border-l border-gray-300 dark:border-gray-700',
        $hoverTextClass = null,
        $hoverTextChildClass = null,
        $color = 'green',
    ) {
        $this->sidebarCollapsed = $sidebarCollapsed;
        $this->highlightMode = $highlightMode;

        $presets = $this->getColorPresets();

        // Fallback: si no existe el color, usa 'green'
        $preset = $presets[$color] ?? $presets['green'];


        $this->highlightParentClass = $highlightParentClass ?? (
            $highlightMode === 'text'
                ? $preset['highlightParentText']
                : $preset['highlightParentStandard']
        );
        $this->highlightChildClass = $highlightChildClass ?? (
            $highlightMode === 'text'
                ? $preset['highlightChildText']
                : $preset['highlightChildStandard']
        );

        $this->itemClass = $itemClass ?? (
            $highlightMode === 'text'
                ? $preset['itemClassText']
                : $preset['itemClassStandard']
        );
        $this->childItemClass = $childItemClass ?? (
            $highlightMode === 'text'
                ? $preset['childItemClassText']
                : $preset['childItemClassStandard']
        );

        $this->hoverTextClass = $hoverTextClass ?? $preset['hoverText'];
        $this->hoverTextChildClass = $hoverTextChildClass ?? $preset['hoverTextChild'];

        $this->categoryClass = $categoryClass;
        $this->iconClass = $iconClass;
        $this->childBorderClass = $childBorderClass;
        $this->items = $this->resolveItems($items);
    }




    /**
     * Decide de dónde sacar el array de navegación
     */
    protected function resolveItems($items)
    {
        // Si es null/empty, busca default
        if (empty($items)) {
            return $this->loadConfigNav('default');
        }

        // Si es string, busca navs/<string>.php
        if (is_string($items)) {
            return $this->loadConfigNav($items);
        }

        // Si es array, úsalo directo
        if (is_array($items)) {
            return $items;
        }

        // Fallback
        return [];
    }

    protected function getColorPresets()
    {
        // 1. Prioridad: archivo publicado por el usuario (resource_path)
        $userPresetsFile = resource_path('views/vendor/twigui/presets/nav/colors.blade.php');
        if (file_exists($userPresetsFile)) {
            $presets = require $userPresetsFile;
            if (is_array($presets)) {
                return $presets;
            }
        }

        // 2. Fallback: archivo del package (interno)
        $packagePresetsFile = __DIR__ . '/../../resources/views/presets/nav/colors.blade.php';
        if (file_exists($packagePresetsFile)) {
            $presets = require $packagePresetsFile;
            if (is_array($presets)) {
                return $presets;
            }
        }

        // 3. Última instancia: vacío
        return [];
    }


    /**
     * Carga el archivo de navegación: config/twigui/navs/<nav>.php
     */
    protected function loadConfigNav($nav = 'default')
    {
        $path = config_path("twigui/navs/{$nav}.php");
        if (file_exists($path)) {
            return include $path;
        }

        return [];
    }

    // --- Todo igual que antes ---
    public function isActive($item)
    {
        $request = request();
        if (!empty($item['match'])) {
            $matches = is_array($item['match']) ? $item['match'] : [$item['match']];
            foreach ($matches as $pattern) {
                if ($request->is(ltrim($pattern, '/'))) return true;
            }
        }
        if (!empty($item['route']) && $item['route'] !== '/' && !$item['external'] ?? true) {
            if (str_starts_with($item['route'], 'http')) {
                // nunca marcar como activo si es external
            } elseif ($request->is(ltrim($item['route'], '/'))) {
                return true;
            }
        }
        if (!empty($item['children'])) {
            foreach ($item['children'] as $child) {
                if ($this->isActive($child)) return true;
            }
        }
        return false;
    }

    public function renderIcon($icon, $iconClass = '')
    {
        if (!$icon) return '';
        if (str_starts_with($icon, '<svg') || str_starts_with($icon, '<img')) {
            return $icon;
        }
        return '<i class="' . e(trim($icon . ' ' . $iconClass)) . '"></i>';
    }

    // (Opcional) Filtro por permisos, igual que antes
    public static function filterNavItems($items, $user = null)
    {
        $user = $user ?: auth()->user();

        $canAccess = function ($can) use ($user) {
            if (!$can) return true;
            if (is_array($can)) {
                foreach ($can as $perm) {
                    if ($user && $user->can($perm)) return true;
                }
                return false;
            }
            return $user && $user->can($can);
        };

        $filter = function ($items) use (&$filter, $canAccess) {
            $out = [];
            foreach ($items as $item) {
                if (isset($item['can']) && !$canAccess($item['can'])) continue;
                if (!empty($item['children'])) {
                    $item['children'] = $filter($item['children']);
                    if (empty($item['children'])) continue;
                }
                $out[] = $item;
            }
            return $out;
        };

        return $filter($items);
    }

    public function render()
    {
        return view('laracosis::nav-cosis');
    }
}
