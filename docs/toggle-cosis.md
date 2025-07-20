# `<x-toggle-cosis>` — Toggle UI Component para LaraCosis UI

Un componente Blade de LaraCosis UI, compatible con Livewire y Alpine.js, 100% personalizable, soporta dark/light mode, tamaños, colores Tailwind y personalizados, loading, labels y total accesibilidad.

---

## Instalación y requisitos

* **Laravel 9+**
* **Alpine.js 3+**
* **Livewire** (opcional, solo si querés two-way binding)
* **Tailwind CSS** (con safelist para colores dinámicos si usás custom)

---

## Uso básico

```blade
<x-toggle-cosis wire:model="is_active" label="Activo" />
```

* **`wire:model`**: sincroniza el valor con Livewire (opcional, funciona sin Livewire)
* **`label`**: texto opcional para mostrar al lado del toggle

---

## Props disponibles

| Prop            | Tipo   | Default | Descripción                                |
| --------------- | ------ | ------- | ------------------------------------------ |
| `wire:model`    | any    | —       | Bind con Livewire                          |
| `label`         | string | `null`  | Texto del label                            |
| `labelPosition` | string | `right` | "left" o "right"                           |
| `disabled`      | bool   | `false` | Desactiva el toggle                        |
| `color`         | string | `blue`  | Color base Tailwind (`blue`, `green`, etc) |
| `colorHex`      | string | `null`  | Color personalizado HEX (`#fb923c`, etc.)  |
| `size`          | string | `md`    | Tamaño: `xs`, `sm`, `md`, `lg`             |

---

## Ejemplos de uso

### Colores y tamaños

```blade
<x-toggle-cosis wire:model="flag1" label="XS" size="xs" color="green" />
<x-toggle-cosis wire:model="flag2" label="Pequeño" size="sm" color="red" label-position="left" />
<x-toggle-cosis wire:model="flag3" label="Mediano" size="md" color-hex="#7c3aed" />
<x-toggle-cosis wire:model="flag4" label="Grande" size="lg" color="amber" />
```

### Deshabilitado

```blade
<x-toggle-cosis wire:model="is_active" label="No editable" disabled />
```

### Loading automático (al cambiar el estado)

Muestra un spinner mientras se procesa el cambio.

---

## Accesibilidad

* Etiquetas `<label>` correctamente asociadas.
* Soporte `role="switch"`, `aria-checked` y navegación con teclado.
* Click en el label activa el toggle (como un checkbox nativo).

---

## Notas para Tailwind

Si usás colores dinámicos (ej: `colorHex` o múltiples colores), **agregá las clases a la safelist de tu `tailwind.config.js`**:

```js
safelist: [
  'bg-blue-600', 'dark:bg-blue-500', 'border-blue-300', 'dark:border-blue-500', 'text-blue-600', 'dark:text-blue-400',
  'bg-green-600', 'dark:bg-green-500', 'border-green-300', 'dark:border-green-500', 'text-green-600', 'dark:text-green-400',
  'bg-red-600', 'dark:bg-red-500', 'border-red-300', 'dark:border-red-500', 'text-red-600', 'dark:text-red-400',
  'bg-amber-600', 'dark:bg-amber-500', 'border-amber-300', 'dark:border-amber-500', 'text-amber-600', 'dark:text-amber-400',
  // ...y para custom: usa pattern
  { pattern: /bg-\[#([A-Fa-f0-9]{6})\]/ },
  { pattern: /border-\[#([A-Fa-f0-9]{6})\]/ },
  { pattern: /text-\[#([A-Fa-f0-9]{6})\]/ },
],
```

---

## Buenas prácticas Livewire/Eloquent

Asegurate de castear los atributos booleanos en tu modelo para evitar problemas de tipos:

```php
protected $casts = [
    'is_active' => 'boolean',
    // otros campos...
];
```

---

## Extensión y personalización

* Puedes sumar iconos, labels ON/OFF, tooltips, track custom, etc.
* El slot del label puede recibir HTML.
* Adaptá el tamaño y color a cualquier layout.

---

## Créditos y agradecimientos

Componente desarrollado para LaraCosis UI — [https://github.com/laracosis/ui](https://github.com/laracosis/ui)

¡Con aportes y feedback de la comunidad!
