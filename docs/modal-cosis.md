# Modal LaraCosis

Componente Modal para Laravel + Livewire + Alpine.js

* Apertura/cierre desde Livewire (wire\:model) **y** desde JS/Alpine.
* Soporte para stacking (modal sobre modal) con z-index configurable.
* Blur, sombra, dark mode.
* 100% personalizable.

---

## Uso Básico

### 1. Definí la variable en tu componente Livewire:

```php
public $showParentModal = false;
```

### 2. Usalo en tu Blade:

```blade
<button wire:click="$set('showParentModal', true)">Abrir Modal</button>

<x-modal-cosis wire:model="showParentModal" maxWidth="2xl">
    <x-slot name="title">Título del Modal</x-slot>
    Contenido del modal.
    <x-slot name="footer">
        <button wire:click="$set('showParentModal', false)">Cerrar</button>
    </x-slot>
</x-modal-cosis>
```

---

## Abrir/Cerrar desde Alpine/JS

```blade
<button x-data @click="$dispatch('open-modal')">
    Abrir Modal con JS
</button>
```

---

## Modal sobre Modal (Stacking)

```php
public $showParentModal = false;
public $showChildModal = false;
```

```blade
<button wire:click="$set('showParentModal', true)">Abrir Modal Principal</button>

<x-modal-cosis wire:model="showParentModal" zIndex="z-[60]">
    <x-slot name="title">Modal Principal</x-slot>
    Contenido del modal principal.
    <x-slot name="footer">
        <button wire:click="$set('showParentModal', false)">Cerrar</button>
        <button wire:click="$set('showChildModal', true)">Abrir Confirmación</button>
    </x-slot>
</x-modal-cosis>

<x-modal-cosis wire:model="showChildModal" zIndex="z-[70]">
    <x-slot name="title">Confirmación</x-slot>
    ¿Seguro que querés continuar?
    <x-slot name="footer">
        <button wire:click="$set('showChildModal', false)">Cancelar</button>
        <button wire:click="$set('showChildModal', false); $set('showParentModal', false)">Sí, continuar</button>
    </x-slot>
</x-modal-cosis>
```

* Usá distintos `zIndex` (`z-[60]`, `z-[70]`, etc.) para apilar los modales.

---

## Props disponibles

| Prop     | Descripción             | Ejemplo          |
| -------- | ----------------------- | ---------------- |
| id       | ID único para el modal  | id="user-modal"  |
| maxWidth | Ancho máximo (tailwind) | maxWidth="4xl"   |
| zIndex   | Z-index para stacking   | zIndex="z-\[80]" |

---

## Personalización visual

* Sombra, blur, dark mode, animación de entrada/salida.
* Cambiá el `maxWidth`, color y nivel de blur a gusto.
* Se ubica arriba con `mt-16`, cambiá por `mt-24`, etc. si querés más separación.

---

## Tips

* El overlay y el modal tienen animación suave.

* Agregá esto para bloquear el scroll del fondo:

  ```blade
  x-effect="document.body.classList.toggle('overflow-hidden', open)"
  ```

  (agregalo en el `<div x-data=...>` del modal)

* Si usás stacking, asegurate de que el z-index del overlay y el modal sean iguales.

* Si usás PurgeCSS, incluí las clases x-transition y variantes de Tailwind.

---

## Ejemplo avanzado (Livewire + Alpine juntos)

```blade
<button wire:click="$set('showModal', true)">Abrir Modal (Livewire)</button>
<button x-data @click="$dispatch('open-modal')">Abrir Modal (JS)</button>

<x-modal-cosis wire:model="showModal">
    <x-slot name="title">Modal full power</x-slot>
    ¡Funciona con Livewire y JS!
    <x-slot name="footer">
        <button wire:click="$set('showModal', false)">Cerrar</button>
    </x-slot>
</x-modal-cosis>
```
