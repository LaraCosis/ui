# `<x-header-cosis>` – Componente Header LaraCosis

Un componente Blade flexible y moderno para encabezados de aplicaciones o sitios en Laravel/Livewire.
Permite desde headers simples hasta variantes avanzadas (glass, sticky, transparent, etc), con posibilidad de override completo vía `class`.

---

## 🚀 Uso básico

```blade
<x-header-cosis title="LaraCosis UI" logo="/images/logo-cosis.svg" />
```

---

## ⚡️ Props disponibles

| Prop          | Tipo        | Default                                 | Descripción                                                   |
| ------------- | ----------- | --------------------------------------- | ------------------------------------------------------------- |
| `logo`        | string/null | null                                    | Ruta del logo a mostrar (SVG, PNG, etc)                       |
| `title`       | string      | env('APP\_NAME', 'LaraCosis')           | Título a mostrar junto al logo                                |
| `sticky`      | bool        | false                                   | Hace el header sticky arriba (CSS `sticky`)                   |
| `fixed`       | bool        | false                                   | Hace el header fixed (CSS `fixed`)                            |
| `shadow`      | bool        | true                                    | Sombra por defecto                                            |
| `transparent` | bool        | false                                   | Header flotante, fondo transparente                           |
| `blur`        | bool        | false                                   | Aplica glass/backdrop blur (usalo con transparent)            |
| `border`      | bool        | true                                    | Muestra borde inferior                                        |
| `borderColor` | string      | 'border-gray-200 dark\:border-gray-800' | Clases Tailwind para color del borde                          |
| `class`       | string/null | null                                    | Override total de clases (ignora el layout y props de estilo) |

---

## 🎨 Ejemplos visuales

### Header clásico

```blade
<x-header-cosis title="LaraCosis" logo="/images/logo-cosis.svg" />
```

### Header glass (transparent + blur)

```blade
<x-header-cosis logo="/images/logo-cosis.svg" transparent blur />
```

### Header sticky, sombra fuerte y borde fucsia

```blade
<x-header-cosis sticky :shadow="true" borderColor="border-fuchsia-500" />
```

### Header sin borde ni sombra

```blade
<x-header-cosis :border="false" :shadow="false" />
```

### Header FULL custom (ignora props de estilo)

```blade
<x-header-cosis
    class="fixed top-0 left-0 w-full h-20 bg-gradient-to-r from-pink-500 to-indigo-500 border-b-4 border-fuchsia-300 shadow-2xl flex items-center"
>
    {{-- Contenido custom --}}
</x-header-cosis>
```

---

## 🧩 Slots disponibles

* **Contenido central** (`$slot`):

  * Puedes poner tabs, breadcrumbs, buscador, lo que quieras en el centro del header.
* **Acciones a la derecha** (`@slot('actions')`):

  * Para botones, toggles, menús, etc.

```blade
<x-header-cosis logo="/images/logo-cosis.svg" title="LaraCosis UI">
    {{-- Centro --}}
    <div class="w-full flex items-center justify-center">
        <span class="font-bold text-xl">Docs</span>
    </div>
    <x-slot name="actions">
        <button class="bg-fuchsia-500 text-white px-3 py-1 rounded-full hover:bg-fuchsia-700">
            Google
        </button>
    </x-slot>
</x-header-cosis>
```

---

## 🛠️ Tips & Buenas prácticas

* Si usas la prop `class`, todo el layout lo defines vos, props de estilo no aplican.
* El slot y actions pueden ser cualquier Blade/HTML. No hay restricción.
* Recomiendo usar `shadow` en sticky/fixed para mejor contraste.
* Para header glass, usá siempre fondo animado o imagen detrás para aprovechar el efecto.

---

## 👀 Ejemplo completo

```blade
<x-header-cosis
    logo="/images/logo-cosis.svg"
    title="LaraCosis Playground"
    sticky
    transparent
    blur
    borderColor="border-fuchsia-400"
>
    <div class="flex-1 flex items-center justify-center">
        <span class="text-base font-semibold">Bienvenido al Playground</span>
    </div>
    <x-slot name="actions">
        <a href="https://github.com/laracosis/ui" target="_blank" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 8a6 6 0 0 1-12 0 6 6 0 0 1 12 0Z" />
            </svg>
        </a>
    </x-slot>
</x-header-cosis>
```
