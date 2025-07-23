# LayoutCosis

Componente Blade flexible para layouts de aplicaciones, con soporte para sidebar colapsable, sticky/fixed, mini-sidebar y 100% configurable con props.

---

## 🚀 Características principales

* Header sticky (opcional)
* Sidebar sticky/fixed o “grow”
* Sidebar colapsable (con o sin mini-sidebar)
* Botón de colapso integrable en sidebar o en header
* Footer fijo (opcional)
* Offsets automáticos para que todo se alinee
* Soporte para variantes: header sobre sidebar, sidebar en row, etc.
* Personalización total de tamaños en rem
* Animaciones suaves con Alpine.js + Tailwind

---

## 🧩 Props disponibles

| Prop                  | Tipo      | Default | Descripción                                        |
| --------------------- | --------- | ------- | -------------------------------------------------- |
| stickyHeader          | bool      | false   | Header sticky                                      |
| stickySidebar         | bool      | false   | Sidebar sticky/fixed                               |
| footerFixed           | bool      | false   | Footer fixed                                       |
| sidebarGrow           | bool      | false   | Sidebar usa grow/sticky en vez de fixed            |
| sidebarOver           | bool      | false   | Header arriba de todo (no como parte del flex row) |
| sidebarWidth          | int/float | 16      | Ancho del sidebar expandido, en rem                |
| collapsedSidebarWidth | int/float | 4       | Ancho del sidebar colapsado, en rem                |
| footerHeight          | int/float | 3       | Altura del footer, en rem                          |
| headerHeight          | int/float | 3.5     | Altura del header, en rem                          |
| collapsibleSidebar    | bool      | false   | Sidebar colapsable con botón                       |

---

## 🎛️ Slots disponibles

* **header:** contenido del header
* **sidebar:** contenido del sidebar (usa Alpine para manejar el colapso de labels/textos)
* **footer:** contenido del footer
* **default:** contenido principal del layout (main)

---

## 🧑‍💻 Ejemplo de uso

```blade
<x-layout-cosis
    :stickyHeader="true"
    :stickySidebar="true"
    :footerFixed="true"
    :collapsibleSidebar="true"
    sidebarWidth="16"
    collapsedSidebarWidth="4"
>
    <x-slot name="sidebar">
        <div class="flex flex-col gap-4 w-full h-full">
            <a class="flex items-center gap-2 px-4 py-2 rounded hover:bg-white/10">
                <svg class="h-5 w-5"></svg>
                <span x-show="!sidebarCollapsed" x-transition>Inicio</span>
            </a>
            <a class="flex items-center gap-2 px-4 py-2 rounded hover:bg-white/10">
                <svg class="h-5 w-5"></svg>
                <span x-show="!sidebarCollapsed" x-transition>Componentes</span>
            </a>
            <!-- ... más items -->
        </div>
    </x-slot>
    <x-slot name="header">
        <div class="h-full flex items-center px-4 bg-orange-300 text-orange-900 font-bold text-xl">
            HEADER
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="w-full h-full flex items-center justify-center bg-blue-300 text-blue-900 font-bold text-xl">
            FOOTER
        </div>
    </x-slot>
    <div class="min-h-[80vh] flex flex-col justify-center items-center bg-violet-200 text-violet-900 font-bold text-2xl rounded-xl border-2 border-violet-400">
        MAIN CONTENT
    </div>
</x-layout-cosis>
```

---

## 🛠️ Customización

* Cambiá los valores de `sidebarWidth` y `collapsedSidebarWidth` para adaptar el ancho.
* Usá Alpine `x-show`/`x-transition` en tus labels para que los textos desaparezcan suavemente al colapsar el sidebar.
* Poné tu botón hamburguesa donde quieras y conéctalo a la función Alpine `toggleSidebar()`.

---

## 🎨 Tips de diseño

* **Animaciones:**

  * El ancho del sidebar y los textos usan `transition-all`/`transition-colors`.
  * Usá transiciones Alpine para fades, slides y opacidad.
* **Mobile:**

  * Agregá breakpoints con Tailwind o Alpine según tus necesidades.
* **Mini sidebar:**

  * Al colapsar a `collapsedSidebarWidth`, ocultá los textos y dejá solo los íconos (usá Alpine `x-show`).

---

## ❓ Preguntas frecuentes

* **¿Cómo cambio el color del sidebar/header/footer?**

  * Agregá clases Tailwind o custom directamente en cada slot.
* **¿Se puede usar el botón hamburguesa para abrir/cerrar el sidebar?**

  * ¡Sí! Declarando la función `toggleSidebar()` en `x-data` del layout, podés llamarla desde cualquier parte del layout.
* **¿Funciona con Livewire?**

  * 100%. Alpine y Livewire conviven perfecto en este layout.

---

## 📦 Requisitos

* Alpine.js >= 3.x
* Tailwind >= 3.x

---

## 🏁 Listo para usar

¡Incluí el componente en tu proyecto, personalizá a gusto y usá LaraCosis UI como base para todos tus proyectos!
