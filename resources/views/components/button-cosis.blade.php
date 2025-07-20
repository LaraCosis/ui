@props([
    'type' => 'button',
    'size' => 'md', // xs, sm, md, lg, xl
    'color' => 'primary',
    'icon' => null,
    'iconPosition' => 'left',
    'spinner' => true,
    'outline' => false,
    'disabled' => false,
    'forInputStart' => false,
    'forInputEnd' => false,
    'label' => null,
])

@php
    // Tamaños ajustados, todos con min-width y paddings bien claros
    $sizes = [
        'xs' => 'py-0.5 text-xs h-7',
        'sm' => 'py-1 text-sm h-8',
        'md' => 'py-2 text-base h-9',
        'lg' => 'py-2.5 text-base h-11',
        'xl' => 'py-3 text-lg h-12',
    ];

    $spinnerSizes = [
        'xs' => 'w-2 h-2',
        'sm' => 'w-3 h-3',
        'md' => 'w-4 h-4',
        'lg' => 'w-5 h-5',
        'xl' => 'w-6 h-6',
    ];

    $main = [
        'primary' => [
            'bg' => 'bg-blue-600 hover:bg-blue-700 text-white',
            'border' => 'border-blue-600',
            'dark' => 'dark:bg-blue-500 dark:hover:bg-blue-600 dark:text-white',
            'outline' => 'text-blue-700 border-blue-600 bg-transparent hover:bg-blue-50 dark:text-blue-300 dark:border-blue-300 dark:hover:bg-blue-900/10',
        ],
        'secondary' => [
            'bg' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
            'border' => 'border-gray-400',
            'dark' => 'dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200',
            'outline' => 'text-gray-700 border-gray-400 bg-transparent hover:bg-gray-100 dark:text-gray-200 dark:border-gray-400 dark:hover:bg-gray-900/10',
        ],
        'success' => [
            'bg' => 'bg-green-600 hover:bg-green-700 text-white',
            'border' => 'border-green-600',
            'dark' => 'dark:bg-green-500 dark:hover:bg-green-600 dark:text-white',
            'outline' => 'text-green-700 border-green-600 bg-transparent hover:bg-green-50 dark:text-green-300 dark:border-green-300 dark:hover:bg-green-900/10',
        ],
        'danger' => [
            'bg' => 'bg-red-600 hover:bg-red-700 text-white',
            'border' => 'border-red-600',
            'dark' => 'dark:bg-red-500 dark:hover:bg-red-600 dark:text-white',
            'outline' => 'text-red-700 border-red-600 bg-transparent hover:bg-red-50 dark:text-red-300 dark:border-red-300 dark:hover:bg-red-900/10',
        ],
        'info' => [
            'bg' => 'bg-cyan-600 hover:bg-cyan-700 text-white',
            'border' => 'border-cyan-600',
            'dark' => 'dark:bg-cyan-500 dark:hover:bg-cyan-600 dark:text-white',
            'outline' => 'text-cyan-700 border-cyan-600 bg-transparent hover:bg-cyan-50 dark:text-cyan-300 dark:border-cyan-300 dark:hover:bg-cyan-900/10',
        ],
        'warning' => [
            'bg' => 'bg-yellow-500 hover:bg-yellow-600 text-black',
            'border' => 'border-yellow-500',
            'dark' => 'dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:text-black',
            'outline' => 'text-yellow-800 border-yellow-500 bg-transparent hover:bg-yellow-100 dark:text-yellow-300 dark:border-yellow-400 dark:hover:bg-yellow-900/10',
        ],
        'muted' => [
            'bg' => 'bg-gray-100 hover:bg-gray-200 text-gray-600',
            'border' => 'border-gray-300',
            'dark' => 'dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-400',
            'outline' => 'text-gray-500 border-gray-300 bg-transparent hover:bg-gray-50 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-900/10',
        ],
        'light' => [
            'bg' => 'bg-white hover:bg-gray-50 text-gray-800',
            'border' => 'border-gray-200',
            'dark' => 'dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-white',
            'outline' => 'text-gray-700 border-gray-200 bg-transparent hover:bg-gray-50 dark:text-white dark:border-gray-700 dark:hover:bg-gray-900/10',
        ],
        'dark' => [
            'bg' => 'bg-gray-900 hover:bg-black text-white',
            'border' => 'border-gray-900',
            'dark' => 'dark:bg-black dark:hover:bg-gray-800 dark:text-white',
            'outline' => 'text-gray-900 border-gray-900 bg-transparent hover:bg-gray-200 dark:text-gray-100 dark:border-gray-800 dark:hover:bg-gray-900/20',
        ],
        'accent' => [
            'bg' => 'bg-fuchsia-600 hover:bg-fuchsia-700 text-white',
            'border' => 'border-fuchsia-600',
            'dark' => 'dark:bg-fuchsia-500 dark:hover:bg-fuchsia-600 dark:text-white',
            'outline' => 'text-fuchsia-700 border-fuchsia-600 bg-transparent hover:bg-fuchsia-50 dark:text-fuchsia-300 dark:border-fuchsia-400 dark:hover:bg-fuchsia-900/10',
        ],
        'neutral' => [
            'bg' => 'bg-neutral-500 hover:bg-neutral-600 text-white',
            'border' => 'border-neutral-500',
            'dark' => 'dark:bg-neutral-400 dark:hover:bg-neutral-500 dark:text-white',
            'outline' => 'text-neutral-700 border-neutral-500 bg-transparent hover:bg-neutral-50 dark:text-neutral-300 dark:border-neutral-400 dark:hover:bg-neutral-900/10',
        ],
        'white' => [
            'bg' => 'bg-white hover:bg-gray-100 text-gray-900',
            'border' => 'border-gray-200',
            'dark' => 'dark:bg-gray-900 dark:hover:bg-gray-800 dark:text-white',
            'outline' => 'text-gray-900 border-gray-200 bg-transparent hover:bg-gray-50 dark:text-white dark:border-gray-700 dark:hover:bg-gray-900/10',
        ],
        'black' => [
            'bg' => 'bg-black hover:bg-gray-900 text-white',
            'border' => 'border-black',
            'dark' => 'dark:bg-black dark:hover:bg-gray-800 dark:text-white',
            'outline' => 'text-black border-black bg-transparent hover:bg-gray-200 dark:text-white dark:border-gray-800 dark:hover:bg-gray-900/20',
        ],

        // Soft y ghost buttons (menos saturados)
        'primary-soft' => [
            'bg' => 'bg-blue-50 hover:bg-blue-100 text-blue-700',
            'border' => 'border-blue-100',
            'dark' => 'dark:bg-blue-900/20 dark:hover:bg-blue-900/40 dark:text-blue-300',
            'outline' => 'text-blue-700 border-blue-200 bg-transparent hover:bg-blue-50 dark:text-blue-300 dark:border-blue-400 dark:hover:bg-blue-900/20',
        ],
        'success-soft' => [
            'bg' => 'bg-green-50 hover:bg-green-100 text-green-700',
            'border' => 'border-green-100',
            'dark' => 'dark:bg-green-900/20 dark:hover:bg-green-900/40 dark:text-green-300',
            'outline' => 'text-green-700 border-green-200 bg-transparent hover:bg-green-50 dark:text-green-300 dark:border-green-400 dark:hover:bg-green-900/20',
        ],
        'danger-soft' => [
            'bg' => 'bg-red-50 hover:bg-red-100 text-red-700',
            'border' => 'border-red-100',
            'dark' => 'dark:bg-red-900/20 dark:hover:bg-red-900/40 dark:text-red-300',
            'outline' => 'text-red-700 border-red-200 bg-transparent hover:bg-red-50 dark:text-red-300 dark:border-red-400 dark:hover:bg-red-900/20',
        ],
        'warning-soft' => [
            'bg' => 'bg-yellow-50 hover:bg-yellow-100 text-yellow-700',
            'border' => 'border-yellow-100',
            'dark' => 'dark:bg-yellow-900/20 dark:hover:bg-yellow-900/40 dark:text-yellow-300',
            'outline' => 'text-yellow-700 border-yellow-200 bg-transparent hover:bg-yellow-50 dark:text-yellow-300 dark:border-yellow-400 dark:hover:bg-yellow-900/20',
        ],
        'info-soft' => [
            'bg' => 'bg-cyan-50 hover:bg-cyan-100 text-cyan-700',
            'border' => 'border-cyan-100',
            'dark' => 'dark:bg-cyan-900/20 dark:hover:bg-cyan-900/40 dark:text-cyan-300',
            'outline' => 'text-cyan-700 border-cyan-200 bg-transparent hover:bg-cyan-50 dark:text-cyan-300 dark:border-cyan-400 dark:hover:bg-cyan-900/20',
        ],

        // Ghost style (solo texto, sin fondo, solo hover/borde)
        'ghost' => [
            'bg' => 'bg-transparent hover:bg-gray-100 text-gray-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-transparent dark:hover:bg-gray-900/10 dark:text-gray-200',
            'outline' => 'text-gray-500 border-transparent bg-transparent hover:bg-gray-100 dark:text-gray-300 dark:border-transparent dark:hover:bg-gray-900/20',
        ],

        'primary-tint' => [
            'bg' => 'bg-blue-100 hover:bg-blue-200 text-blue-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-blue-900/30 dark:hover:bg-blue-900/50 dark:text-blue-300',
            'outline' => 'text-blue-700 border-transparent bg-blue-100 hover:bg-blue-200 dark:text-blue-300 dark:border-transparent dark:bg-blue-900/30 dark:hover:bg-blue-900/50',
        ],
        'secondary-tint' => [
            'bg' => 'bg-gray-100 hover:bg-gray-200 text-gray-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-gray-800/30 dark:hover:bg-gray-800/50 dark:text-gray-200',
            'outline' => 'text-gray-700 border-transparent bg-gray-100 hover:bg-gray-200 dark:text-gray-200 dark:border-transparent dark:bg-gray-800/30 dark:hover:bg-gray-800/50',
        ],
        'success-tint' => [
            'bg' => 'bg-green-100 hover:bg-green-200 text-green-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-green-900/30 dark:hover:bg-green-900/50 dark:text-green-300',
            'outline' => 'text-green-700 border-transparent bg-green-100 hover:bg-green-200 dark:text-green-300 dark:border-transparent dark:bg-green-900/30 dark:hover:bg-green-900/50',
        ],
        'danger-tint' => [
            'bg' => 'bg-red-100 hover:bg-red-200 text-red-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-300',
            'outline' => 'text-red-700 border-transparent bg-red-100 hover:bg-red-200 dark:text-red-300 dark:border-transparent dark:bg-red-900/30 dark:hover:bg-red-900/50',
        ],
        'info-tint' => [
            'bg' => 'bg-cyan-100 hover:bg-cyan-200 text-cyan-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-cyan-900/30 dark:hover:bg-cyan-900/50 dark:text-cyan-300',
            'outline' => 'text-cyan-700 border-transparent bg-cyan-100 hover:bg-cyan-200 dark:text-cyan-300 dark:border-transparent dark:bg-cyan-900/30 dark:hover:bg-cyan-900/50',
        ],
        'warning-tint' => [
            'bg' => 'bg-yellow-100 hover:bg-yellow-200 text-yellow-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-yellow-900/30 dark:hover:bg-yellow-900/50 dark:text-yellow-300',
            'outline' => 'text-yellow-700 border-transparent bg-yellow-100 hover:bg-yellow-200 dark:text-yellow-300 dark:border-transparent dark:bg-yellow-900/30 dark:hover:bg-yellow-900/50',
        ],
        'accent-tint' => [
            'bg' => 'bg-fuchsia-100 hover:bg-fuchsia-200 text-fuchsia-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-fuchsia-900/30 dark:hover:bg-fuchsia-900/50 dark:text-fuchsia-300',
            'outline' => 'text-fuchsia-700 border-transparent bg-fuchsia-100 hover:bg-fuchsia-200 dark:text-fuchsia-300 dark:border-transparent dark:bg-fuchsia-900/30 dark:hover:bg-fuchsia-900/50',
        ],
        'neutral-tint' => [
            'bg' => 'bg-neutral-100 hover:bg-neutral-200 text-neutral-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-neutral-900/30 dark:hover:bg-neutral-900/50 dark:text-neutral-300',
            'outline' => 'text-neutral-700 border-transparent bg-neutral-100 hover:bg-neutral-200 dark:text-neutral-300 dark:border-transparent dark:bg-neutral-900/30 dark:hover:bg-neutral-900/50',
        ],
        'dark-tint' => [
            'bg' => 'bg-gray-800/10 hover:bg-gray-800/20 text-gray-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-gray-800/30 dark:hover:bg-gray-800/50 dark:text-white',
            'outline' => 'text-gray-800 border-transparent bg-gray-800/10 hover:bg-gray-800/20 dark:text-white dark:border-transparent dark:bg-gray-800/30 dark:hover:bg-gray-800/50',
        ],

        // === PASTEL (aún más suave, sin hover fuerte, ideal para fondos claros) ===
        'primary-pastel' => [
            'bg' => 'bg-blue-50 hover:bg-blue-100 text-blue-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-blue-900/10 dark:hover:bg-blue-900/20 dark:text-blue-200',
            'outline' => 'text-blue-800 border-transparent bg-blue-50 hover:bg-blue-100 dark:text-blue-200 dark:border-transparent dark:bg-blue-900/10 dark:hover:bg-blue-900/20',
        ],
        'secondary-pastel' => [
            'bg' => 'bg-gray-50 hover:bg-gray-100 text-gray-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-gray-900/10 dark:hover:bg-gray-900/20 dark:text-gray-200',
            'outline' => 'text-gray-700 border-transparent bg-gray-50 hover:bg-gray-100 dark:text-gray-200 dark:border-transparent dark:bg-gray-900/10 dark:hover:bg-gray-900/20',
        ],
        'success-pastel' => [
            'bg' => 'bg-green-50 hover:bg-green-100 text-green-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-green-900/10 dark:hover:bg-green-900/20 dark:text-green-200',
            'outline' => 'text-green-800 border-transparent bg-green-50 hover:bg-green-100 dark:text-green-200 dark:border-transparent dark:bg-green-900/10 dark:hover:bg-green-900/20',
        ],
        'danger-pastel' => [
            'bg' => 'bg-red-50 hover:bg-red-100 text-red-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-red-900/10 dark:hover:bg-red-900/20 dark:text-red-200',
            'outline' => 'text-red-800 border-transparent bg-red-50 hover:bg-red-100 dark:text-red-200 dark:border-transparent dark:bg-red-900/10 dark:hover:bg-red-900/20',
        ],
        'info-pastel' => [
            'bg' => 'bg-cyan-50 hover:bg-cyan-100 text-cyan-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-cyan-900/10 dark:hover:bg-cyan-900/20 dark:text-cyan-200',
            'outline' => 'text-cyan-800 border-transparent bg-cyan-50 hover:bg-cyan-100 dark:text-cyan-200 dark:border-transparent dark:bg-cyan-900/10 dark:hover:bg-cyan-900/20',
        ],
        'warning-pastel' => [
            'bg' => 'bg-yellow-50 hover:bg-yellow-100 text-yellow-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-yellow-900/10 dark:hover:bg-yellow-900/20 dark:text-yellow-200',
            'outline' => 'text-yellow-800 border-transparent bg-yellow-50 hover:bg-yellow-100 dark:text-yellow-200 dark:border-transparent dark:bg-yellow-900/10 dark:hover:bg-yellow-900/20',
        ],
        'accent-pastel' => [
            'bg' => 'bg-fuchsia-50 hover:bg-fuchsia-100 text-fuchsia-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-fuchsia-900/10 dark:hover:bg-fuchsia-900/20 dark:text-fuchsia-200',
            'outline' => 'text-fuchsia-800 border-transparent bg-fuchsia-50 hover:bg-fuchsia-100 dark:text-fuchsia-200 dark:border-transparent dark:bg-fuchsia-900/10 dark:hover:bg-fuchsia-900/20',
        ],
        'neutral-pastel' => [
            'bg' => 'bg-neutral-50 hover:bg-neutral-100 text-neutral-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-neutral-900/10 dark:hover:bg-neutral-900/20 dark:text-neutral-200',
            'outline' => 'text-neutral-800 border-transparent bg-neutral-50 hover:bg-neutral-100 dark:text-neutral-200 dark:border-transparent dark:bg-neutral-900/10 dark:hover:bg-neutral-900/20',
        ],
        'dark-pastel' => [
            'bg' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-gray-800/10 dark:hover:bg-gray-800/20 dark:text-white',
            'outline' => 'text-gray-800 border-transparent bg-gray-200 hover:bg-gray-300 dark:text-white dark:border-transparent dark:bg-gray-800/10 dark:hover:bg-gray-800/20',
        ],

        // === GLASS (fondo translúcido, glassmorphism, sin borde) ===
        'primary-glass' => [
            'bg' => 'bg-blue-400/20 hover:bg-blue-400/30 backdrop-blur-md text-blue-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-blue-200/10 dark:hover:bg-blue-200/20 dark:text-blue-200',
            'outline' => 'text-blue-700 border-transparent bg-blue-400/20 hover:bg-blue-400/30 backdrop-blur-md dark:text-blue-200 dark:border-transparent dark:bg-blue-200/10 dark:hover:bg-blue-200/20',
        ],
        'secondary-glass' => [
            'bg' => 'bg-gray-400/20 hover:bg-gray-400/30 backdrop-blur-md text-gray-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-gray-200/10 dark:hover:bg-gray-200/20 dark:text-gray-200',
            'outline' => 'text-gray-800 border-transparent bg-gray-400/20 hover:bg-gray-400/30 backdrop-blur-md dark:text-gray-200 dark:border-transparent dark:bg-gray-200/10 dark:hover:bg-gray-200/20',
        ],
        'success-glass' => [
            'bg' => 'bg-green-400/20 hover:bg-green-400/30 backdrop-blur-md text-green-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-green-200/10 dark:hover:bg-green-200/20 dark:text-green-200',
            'outline' => 'text-green-700 border-transparent bg-green-400/20 hover:bg-green-400/30 backdrop-blur-md dark:text-green-200 dark:border-transparent dark:bg-green-200/10 dark:hover:bg-green-200/20',
        ],
        'danger-glass' => [
            'bg' => 'bg-red-400/20 hover:bg-red-400/30 backdrop-blur-md text-red-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-red-200/10 dark:hover:bg-red-200/20 dark:text-red-200',
            'outline' => 'text-red-700 border-transparent bg-red-400/20 hover:bg-red-400/30 backdrop-blur-md dark:text-red-200 dark:border-transparent dark:bg-red-200/10 dark:hover:bg-red-200/20',
        ],
        'info-glass' => [
            'bg' => 'bg-cyan-400/20 hover:bg-cyan-400/30 backdrop-blur-md text-cyan-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-cyan-200/10 dark:hover:bg-cyan-200/20 dark:text-cyan-200',
            'outline' => 'text-cyan-700 border-transparent bg-cyan-400/20 hover:bg-cyan-400/30 backdrop-blur-md dark:text-cyan-200 dark:border-transparent dark:bg-cyan-200/10 dark:hover:bg-cyan-200/20',
        ],
        'warning-glass' => [
            'bg' => 'bg-yellow-400/20 hover:bg-yellow-400/30 backdrop-blur-md text-yellow-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-yellow-200/10 dark:hover:bg-yellow-200/20 dark:text-yellow-200',
            'outline' => 'text-yellow-700 border-transparent bg-yellow-400/20 hover:bg-yellow-400/30 backdrop-blur-md dark:text-yellow-200 dark:border-transparent dark:bg-yellow-200/10 dark:hover:bg-yellow-200/20',
        ],
        'accent-glass' => [
            'bg' => 'bg-fuchsia-400/20 hover:bg-fuchsia-400/30 backdrop-blur-md text-fuchsia-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-fuchsia-200/10 dark:hover:bg-fuchsia-200/20 dark:text-fuchsia-200',
            'outline' => 'text-fuchsia-700 border-transparent bg-fuchsia-400/20 hover:bg-fuchsia-400/30 backdrop-blur-md dark:text-fuchsia-200 dark:border-transparent dark:bg-fuchsia-200/10 dark:hover:bg-fuchsia-200/20',
        ],
        'neutral-glass' => [
            'bg' => 'bg-neutral-400/20 hover:bg-neutral-400/30 backdrop-blur-md text-neutral-700',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-neutral-200/10 dark:hover:bg-neutral-200/20 dark:text-neutral-200',
            'outline' => 'text-neutral-700 border-transparent bg-neutral-400/20 hover:bg-neutral-400/30 backdrop-blur-md dark:text-neutral-200 dark:border-transparent dark:bg-neutral-200/10 dark:hover:bg-neutral-200/20',
        ],
        'dark-glass' => [
            'bg' => 'bg-gray-900/20 hover:bg-gray-900/30 backdrop-blur-md text-gray-800',
            'border' => 'border-transparent',
            'dark' => 'dark:bg-gray-800/30 dark:hover:bg-gray-800/50 dark:text-white',
            'outline' => 'text-gray-800 border-transparent bg-gray-900/20 hover:bg-gray-900/30 backdrop-blur-md dark:text-white dark:border-transparent dark:bg-gray-800/30 dark:hover:bg-gray-800/50',
        ],
    ];

    $spinnerColor = 'text-white dark:text-gray-200'; // default (sólido)

    if (
        Str::endsWith($color, ['tint', 'pastel', 'glass'])
        || ($outline && isset($c['outline']) && Str::contains($c['outline'], 'bg-transparent'))
    ) {
        // Tints, pastels y glass: spinner oscuro en light, claro en dark
        $spinnerColor = 'text-gray-700 dark:text-gray-100';
    }


    $c = $main[$color] ?? $main['primary'];

    $buttonClass = $sizes[$size]
        . ' px-3 border-2 '
        . ($outline
            ? "{$c['outline']} {$c['border']}"
            : "{$c['bg']} {$c['border']} " . ($c['dark'] ?? '')
        )
        . ' rounded-lg shadow font-semibold flex items-center justify-center gap-2 relative transition-all duration-150 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2'
        . ($outline ? ' bg-transparent' : '')
        . ' overflow-hidden';



    // Chequear si está en modo "input"
    $forInput = isset(${'for-input-start'}) || isset(${'for-input-end'});

    // Si está en modo input, override algunas clases
    if ($forInput) {
        $buttonClass =
            'h-8 px-3 bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition focus:outline-none focus:ring-0'
            . (isset(${'for-input-start'}) ? ' rounded-l-md border-r border-gray-300 dark:border-gray-700' : '')
            . (isset(${'for-input-end'}) ? ' rounded-r-md border-l border-gray-300 dark:border-gray-700' : '');

        $spinnerColor = 'text-gray-700 dark:text-gray-100';

    }


    $target = $attributes->get('wire:target');

    // Detectar wire:target automáticamente
    $wireTarget = $attributes->get('wire:target');
    if (!$wireTarget && $attributes->has('wire:click')) {
        // Extrae el método del wire:click
        $wireClick = $attributes->get('wire:click');
        // Si es tipo 'method' o 'method(param)', extrae solo el método
        if (preg_match('/^\s*([a-zA-Z0-9_]+)/', $wireClick, $matches)) {
            $wireTarget = $matches[1];
        }
    }

@endphp

<button
    {{ $attributes->merge([
        'type' => $type,
        'class' => $buttonClass,
        'disabled' => $disabled ? 'disabled' : null,
    ]) }}
>


<span class="flex items-center justify-center w-full relative">
    {{-- Texto visible solo si NO está loading --}}
    <span class="text-center" wire:loading.remove wire:target="{{$wireTarget}}">
        @if($icon && $iconPosition === 'left')
            <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ trim($slot) !== '' ? $slot : $label }}
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} ml-2"></i>
        @endif
    </span>
    {{-- Spinner solo si está loading --}}
    <span
        wire:loading
        wire:target="{{$wireTarget}}"
        class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center"
    >
        <svg class="animate-spin {{$spinnerSizes[$size]}} {{$spinnerColor}}" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
        </svg>

    </span>
    {{-- Span fantasma visible siempre, para reservar el ancho del texto --}}
    <span class="invisible pointer-events-none select-none" wire:loading wire:target="{{$wireTarget}}">
        @if($icon && $iconPosition === 'left')
            <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ trim($slot) !== '' ? $slot : $label }}
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} ml-2"></i>
        @endif
    </span>
</span>


</button>
