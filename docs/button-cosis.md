# `<x-button-cosis>` — Componente de Botón Universal para Laravel/Livewire

Un botón increíblemente flexible, con soporte para múltiples colores, variantes, tamaños, iconos, spinner integrado y total compatibilidad con dark mode.

---

## Props principales

| Prop           | Valores posibles                    | Descripción                                              |
| -------------- | ----------------------------------- | -------------------------------------------------------- |
| `size`         | xs, sm, md, lg, xl                  | Tamaño del botón.                                        |
| `color`        | primary, secondary, ... + variantes | Color del botón. Soporta muchas variantes (ver abajo).   |
| `outline`      | true / false                        | Estilo borde/outline o sólido.                           |
| `icon`         | Nombre FontAwesome (ej: fa fa-save) | Icono opcional a izquierda o derecha.                    |
| `iconPosition` | left / right                        | Posición del icono.                                      |
| `spinner`      | true / false                        | Si muestra spinner al cargar (con wire\:loading/target). |
| `disabled`     | true / false                        | Desactiva el botón.                                      |
| ...            | Cualquier atributo Blade estándar   | (Ej: wire\:click, wire\:target, id, class, etc)          |

---

## Ejemplo básico

```blade
<x-button-cosis wire:click="guardar" size="md" color="primary">
    Guardar
</x-button-cosis>
```

## Ejemplo con icono, outline y spinner

```blade
<x-button-cosis wire:click="borrar" color="danger" outline="true" icon="fa fa-trash" iconPosition="right">
    Borrar todo
</x-button-cosis>
```

## Ejemplo de todos los colores y variantes (tint, pastel, glass)

```blade
<div class="flex flex-wrap gap-2 mb-4">
    <x-button-cosis color="primary-tint" wire:click="loadingcosis">Primary Tint</x-button-cosis>
    <x-button-cosis color="success-pastel" wire:click="loadingcosis">Success Pastel</x-button-cosis>
    <x-button-cosis color="danger-glass" wire:click="loadingcosis">Danger Glass</x-button-cosis>
    ...
</div>
```

## Tabla de variantes de color

| Color Base | Sólido    | Outline             | Tint           | Pastel           | Glass           |
| ---------- | --------- | ------------------- | -------------- | ---------------- | --------------- |
| primary    | primary   | primary + outline   | primary-tint   | primary-pastel   | primary-glass   |
| secondary  | secondary | secondary + outline | secondary-tint | secondary-pastel | secondary-glass |
| success    | success   | success + outline   | success-tint   | success-pastel   | success-glass   |
| danger     | danger    | danger + outline    | danger-tint    | danger-pastel    | danger-glass    |
| info       | info      | info + outline      | info-tint      | info-pastel      | info-glass      |
| warning    | warning   | warning + outline   | warning-tint   | warning-pastel   | warning-glass   |
| accent     | accent    | accent + outline    | accent-tint    | accent-pastel    | accent-glass    |
| neutral    | neutral   | neutral + outline   | neutral-tint   | neutral-pastel   | neutral-glass   |
| dark       | dark      | dark + outline      | dark-tint      | dark-pastel      | dark-glass      |

---

## Spinner inteligente

* El spinner se adapta de color automáticamente para contrastar con el fondo.
* En variantes `tint`, `pastel` y `glass` es oscuro en light y claro en dark.
* En variantes sólidas es blanco.

---

## Tips extra

* El ancho del botón **no cambia** mientras carga (spinner): usa un span invisible para reservar espacio.
* Siempre usá `wire:click` o `wire:target` para evitar que el spinner se dispare globalmente.
* Puedes combinar con cualquier icono FontAwesome.

---

## Demo de todos los estilos (copiar/pegar en Blade)

> Agregale un wire:click="test" a una funcion test con sleep(3) para ver todos los spinners al mismo tiempo!

```blade
<div class="space-y-8">
    <div>
        <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Sólidos</h2>
        <div class="flex flex-wrap gap-2">
            <x-button-cosis color="primary" >Primary</x-button-cosis>
            <x-button-cosis color="secondary" >Secondary</x-button-cosis>
            <x-button-cosis color="success" >Success</x-button-cosis>
            <x-button-cosis color="danger" >Danger</x-button-cosis>
            <x-button-cosis color="info" >Info</x-button-cosis>
            <x-button-cosis color="warning" >Warning</x-button-cosis>
            <x-button-cosis color="muted" >Muted</x-button-cosis>
            <x-button-cosis color="light" >Light</x-button-cosis>
            <x-button-cosis color="dark" >Dark</x-button-cosis>
            <x-button-cosis color="accent" >Accent</x-button-cosis>
            <x-button-cosis color="neutral" >Neutral</x-button-cosis>
            <x-button-cosis color="white" >White</x-button-cosis>
            <x-button-cosis color="black" >Black</x-button-cosis>
        </div>
    </div>

    <div>
        <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Outline</h2>
        <div class="flex flex-wrap gap-2">
            <x-button-cosis color="primary" outline="true" >Primary</x-button-cosis>
            <x-button-cosis color="secondary" outline="true" >Secondary</x-button-cosis>
            <x-button-cosis color="success" outline="true" >Success</x-button-cosis>
            <x-button-cosis color="danger" outline="true" >Danger</x-button-cosis>
            <x-button-cosis color="info" outline="true" >Info</x-button-cosis>
            <x-button-cosis color="warning" outline="true" >Warning</x-button-cosis>
            <x-button-cosis color="muted" outline="true" >Muted</x-button-cosis>
            <x-button-cosis color="light" outline="true" >Light</x-button-cosis>
            <x-button-cosis color="dark" outline="true" >Dark</x-button-cosis>
            <x-button-cosis color="accent" outline="true" >Accent</x-button-cosis>
            <x-button-cosis color="neutral" outline="true" >Neutral</x-button-cosis>
            <x-button-cosis color="white" outline="true" >White</x-button-cosis>
            <x-button-cosis color="black" outline="true" >Black</x-button-cosis>
        </div>
    </div>

    <div>
        <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Tint (liviano, fondo apenas tintado)</h2>
        <div class="flex flex-wrap gap-2">
            <x-button-cosis color="primary-tint" >Primary Tint</x-button-cosis>
            <x-button-cosis color="secondary-tint" >Secondary Tint</x-button-cosis>
            <x-button-cosis color="success-tint" >Success Tint</x-button-cosis>
            <x-button-cosis color="danger-tint" >Danger Tint</x-button-cosis>
            <x-button-cosis color="info-tint" >Info Tint</x-button-cosis>
            <x-button-cosis color="warning-tint" >Warning Tint</x-button-cosis>
            <x-button-cosis color="accent-tint" >Accent Tint</x-button-cosis>
            <x-button-cosis color="neutral-tint" >Neutral Tint</x-button-cosis>
            <x-button-cosis color="dark-tint" >Dark Tint</x-button-cosis>
        </div>
    </div>

    <div>
        <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Pastel (ultra suave)</h2>
        <div class="flex flex-wrap gap-2">
            <x-button-cosis color="primary-pastel" >Primary Pastel</x-button-cosis>
            <x-button-cosis color="secondary-pastel" >Secondary Pastel</x-button-cosis>
            <x-button-cosis color="success-pastel" >Success Pastel</x-button-cosis>
            <x-button-cosis color="danger-pastel" >Danger Pastel</x-button-cosis>
            <x-button-cosis color="info-pastel" >Info Pastel</x-button-cosis>
            <x-button-cosis color="warning-pastel" >Warning Pastel</x-button-cosis>
            <x-button-cosis color="accent-pastel" >Accent Pastel</x-button-cosis>
            <x-button-cosis color="neutral-pastel" >Neutral Pastel</x-button-cosis>
            <x-button-cosis color="dark-pastel" >Dark Pastel</x-button-cosis>
        </div>
    </div>

    <div>
        <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-gray-200">Glass (glassmorphism, translúcido)</h2>
        <div class="flex flex-wrap gap-2">
            <x-button-cosis color="primary-glass" >Primary Glass</x-button-cosis>
            <x-button-cosis color="secondary-glass" >Secondary Glass</x-button-cosis>
            <x-button-cosis color="success-glass" >Success Glass</x-button-cosis>
            <x-button-cosis color="danger-glass" >Danger Glass</x-button-cosis>
            <x-button-cosis color="info-glass" >Info Glass</x-button-cosis>
            <x-button-cosis color="warning-glass" >Warning Glass</x-button-cosis>
            <x-button-cosis color="accent-glass" >Accent Glass</x-button-cosis>
            <x-button-cosis color="neutral-glass" >Neutral Glass</x-button-cosis>
            <x-button-cosis color="dark-glass" >Dark Glass</x-button-cosis>
        </div>
    </div>
</div>
```

---

## Personalización avanzada

* Puedes agregar nuevos estilos o modificar el array `$main` fácilmente.
* Compatible con dark mode y todas las clases de Tailwind.
* Listo para usar en Laravel, Livewire y cualquier Blade.

---

¿Listo para el package definitivo? :)
