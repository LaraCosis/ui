# Modos de Layout para LaraCosis UI

Este documento explica cómo estructurar y configurar el layout de tu aplicación con los componentes `<x-header-cosis>` y `<x-sidebar-cosis>`, para lograr cualquiera de estos 3 modos:

* **Push** (sidebar empuja el contenido y el header)
* **Header sobre Sidebar** (el header siempre arriba, tapa el sidebar)
* **Sidebar sobre Header** (el sidebar tapa al header, flota sobre todo)

---

## 1. Push (modo por defecto)

El sidebar es parte del flujo del layout. El header y el main ocupan sólo el espacio restante.

```blade
<div class="flex min-h-screen">
    <x-sidebar-cosis ... fixed="false" zIndex="40" />
    <div class="flex-1 flex flex-col min-h-screen">
        <x-header-cosis ... zIndex="50" />
        <main class="flex p-8">
            ...
        </main>
    </div>
</div>
```

**Claves:**

* Ambos componentes están en el flujo normal (`fixed=false`).
* No hay solapamiento.
* El header y el main se "achican" si el sidebar está abierto o mini.

---

## 2. Header sobre Sidebar

El header está siempre visible y por arriba, "flotando" sobre el sidebar.

```blade
<div class="flex min-h-screen">
    <x-sidebar-cosis ... fixed="false" zIndex="40" />
    <div class="flex-1 flex flex-col min-h-screen">
        <x-header-cosis ... fixed="true" zIndex="50" />
        <main class="flex p-8 pt-14">
            ...
        </main>
    </div>
</div>
```

**Claves:**

* Header usa `fixed="true"` y zIndex mayor.
* Sidebar sigue en el flujo normal.
* El `<main>` lleva `pt-14` (o el alto del header) para no quedar tapado.

---

## 3. Sidebar sobre Header

El sidebar "flota" y tapa al header y contenido.

```blade
<div>
    <x-header-cosis ... fixed="true" zIndex="40" />
    <x-sidebar-cosis ... fixed="true" zIndex="60" style="top:0;" />
    <main class="flex p-8 pt-14 pl-64">
        ...
    </main>
</div>
```

**Claves:**

* Ambos usan `fixed="true"`.
* Sidebar tiene zIndex mayor.
* El `<main>` lleva `pt-14` y `pl-64` (ajustar según alto del header/ancho sidebar y si está mini).
* El sidebar puede tener shadow y animaciones propias.

---

## Ejemplo de Props para cada modo

| Modo                 | Sidebar                   | Header                   |
| -------------------- | ------------------------- | ------------------------ |
| Push (default)       | fixed="false" zIndex="40" | (default) zIndex="50"    |
| Header sobre Sidebar | fixed="false" zIndex="40" | fixed="true" zIndex="50" |
| Sidebar sobre Header | fixed="true"  zIndex="60" | fixed="true" zIndex="40" |

---

## Tips & Consideraciones

* Si usás ambos como `fixed`, recordá que el orden en el DOM y el z-index deciden cuál queda arriba.
* El padding/margen en `<main>` es fundamental para evitar que el contenido quede tapado.
* Podés alternar entre modos fácilmente cambiando sólo los props y el orden de los componentes en el layout.
* El ancho del sidebar puede variar según mini/full; ajustá los paddings en `<main>` acorde.

---

## Demo Playground

Podés mostrar los tres modos en tu demo usando un simple select y cambiando el layout dinámicamente. ¡Esto le da máxima claridad a los usuarios sobre el poder del package!
