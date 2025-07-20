# <x-input-cosis> — Input universal Laracosis

Input completamente customizable, con soporte Livewire, slots, iconos, acciones y validación automática.

---

## Props principales

| Prop             | Tipo        | Default | Descripción                                               |
| ---------------- | ----------- | ------- | --------------------------------------------------------- |
| `label`          | string/null | null    | Label flotante arriba del input.                          |
| `type`           | string      | 'text'  | Tipo de input (`text`, `search`, `password`, etc).        |
| `icon-start`     | string/null | null    | Clase FontAwesome (ej: `fa fa-user`) al inicio.           |
| `icon-start-svg` | string/null | null    | SVG inline personalizado al inicio.                       |
| `icon-end`       | string/null | null    | Clase FontAwesome al final.                               |
| `icon-end-svg`   | string/null | null    | SVG inline personalizado al final.                        |
| `copy-button`    | bool        | false   | Muestra botón para copiar el valor al clipboard.          |
| `clearable`      | bool        | false   | Muestra cruz para limpiar el input (solo si hay texto).   |
| `error`          | string/null | null    | Error manual (prioridad si errorBag está vacío).          |
| `help`           | string/null | null    | Texto de ayuda debajo del input.                          |
| `placeholder`    | string      | ''      | Placeholder del input (sobrescribe el default de search). |
| `disabled`       | bool        | false   | Deshabilita el input.                                     |

---

## Slots

| Slot    | Ubicación | Ejemplo de uso                               |
| ------- | --------- | -------------------------------------------- |
| `start` | Inicio    | Botón, dropdown, ícono extra antes del input |
| `end`   | Final     | Botón, dropdown, acción después del input    |

---

## Integración Livewire

* Soporta `wire:model`, `wire:model.lazy`, etc.
* Muestra errores automáticamente según errorBag.
* Al limpiar (clear), dispara el evento input para actualizar Livewire.

---

## Tips de estilos y clases

* El borde, color de foco y error siempre lo maneja el `div` padre.
* El input NO tiene borde ni ring propio.
* Los íconos y botones en slots pueden integrarse usando props especiales en tus componentes, ejemplo `<x-button-cosis for-input-end />`.
* Las acciones extra como copy/clear aparecen solo si corresponde.
* El dropdown en slot-end se integra usando Alpine.js.

---

## Ejemplos de uso

### Input simple

```blade
<x-input-cosis
    label="Nombre"
    wire:model="user.name"
    placeholder="Nombre completo"
/>
```

### Input con icono FontAwesome al inicio

```blade
<x-input-cosis
    label="Usuario"
    wire:model="username"
    icon-start="fa fa-user"
    clearable
    placeholder="Nombre de usuario"
/>
```

### Input tipo search (con lupa por defecto, o custom si mandás icon-start)

```blade
<x-input-cosis
    label="Buscar"
    type="search"
    wire:model.lazy="busqueda"
    clearable
/>
```

### Input con botón integrado (usando button-cosis en slot-end)

```blade
<x-input-cosis
    label="Buscar usuario"
    type="search"
    wire:model="search"
    clearable
>
    <x-slot name="end">
        <x-button-cosis for-input-end label="Buscar" />
    </x-slot>
</x-input-cosis>
```

### Input con dropdown en slot-end

```blade
<x-input-cosis label="Buscar" wire:model="search">
    <x-slot name="end">
        <div x-data="{ open: false }" class="relative h-full">
            <button
                @click="open = !open"
                type="button"
                class="h-full px-3 rounded-r-md bg-white dark:bg-gray-900 border-l border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition focus:outline-none"
            >
                Opciones
                <svg class="inline w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div
                x-show="open"
                @click.away="open = false"
                class="absolute right-0 mt-2 w-36 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50 py-1"
                style="display: none;"
            >
                <button
                    type="button"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800"
                >Filtro 1</button>
                <button
                    type="button"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800"
                >Filtro 2</button>
            </div>
        </div>
    </x-slot>
</x-input-cosis>
```

### Input password con toggle (ojito) y ayuda

```blade
<x-input-cosis
    label="Contraseña"
    type="password"
    wire:model="user.password"
    help="Debe tener al menos 8 caracteres."
/>
```

### Input con error manual

```blade
<x-input-cosis
    label="Cuil"
    wire:model="cuil"
    :error="'El CUIL no es válido.'"
/>
```

---

## Troubleshooting y tips

* **No se ve la cruz (clearable) en search:** asegurate de tener el CSS que oculta la cruz nativa del browser.
* **El botón/copy/clear no se ve integrado:** usá las clases de integración sugeridas y `items-stretch` en el div padre.
* **Livewire no borra el valor al clear:** el input dispara el evento input para sincronizar el valor automáticamente.
* **Error visual solo en el div:** el input no debe tener ring ni borde, todo el feedback visual está en el wrapper.
* **Slots start/end:** podés pasar `<x-button-cosis for-input-start />`, dropdowns, iconos extra, etc.

---

## Créditos y buenas prácticas

* Inspirado en los mejores patrones de diseño de inputs modernos.
* Totalmente personalizable y extensible.
* Para sumar más features (sizes, etc), usá props y helpers en tus propios componentes.
