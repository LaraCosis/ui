# LaraCosis Theme Toggle Component

Cambia entre modo claro y oscuro con un toggle súper flexible y personalizable para Laravel + Blade + AlpineJS + Tailwind.

---

## 🚀 Instalación y uso básico

1. **Asegúrate de tener AlpineJS y Tailwind (con darkMode: 'class')**

2. **Usa el componente donde quieras:**

```blade
<x-toggle-theme-cosis />
```

Esto crea un ícono interactivo, amarillo para claro, azul para oscuro, tamaño mediano.

---

## 🎨 Props disponibles

| Prop               | Tipo   | Default | Descripción                                                |
| ------------------ | ------ | ------- | ---------------------------------------------------------- |
| `size`             | string | `md`    | Tamaño: xs, sm, md, lg, xl, 2xl                            |
| `mode`             | string | `icon`  | Variante visual: `icon` \| `button` \| `square-button`     |
| `class`            | string |         | Clases extras para el wrapper                              |
| `iconColorLight`   | string | `null`  | Clase de color para el icono en modo claro (o `'parent'`)  |
| `iconColorDark`    | string | `null`  | Clase de color para el icono en modo oscuro (o `'parent'`) |
| `borderColorLight` | string | `null`  | Clase de color para el borde en modo claro (o `'parent'`)  |
| `borderColorDark`  | string | `null`  | Clase de color para el borde en modo oscuro (o `'parent'`) |
| `inheritColor`     | bool   | `false` | Si es `true`, todos los colores heredan del padre          |

---

## 🧩 Variantes visuales

### **Modo icono minimalista (default)**

```blade
<x-toggle-theme-cosis />
<x-toggle-theme-cosis size="xl" />
<x-toggle-theme-cosis size="sm" class="ml-2" />
```

### **Modo botón pill (redondeado)**

```blade
<x-toggle-theme-cosis mode="button" />
<x-toggle-theme-cosis mode="button" size="lg" class="mx-3" />
```

### **Modo botón cuadrado**

```blade
<x-toggle-theme-cosis mode="square-button" />
<x-toggle-theme-cosis mode="square-button" size="xl" class="shadow-lg" />
```

---

## 🌈 Personalización de colores

### **Colores personalizados por modo:**

```blade
<x-toggle-theme-cosis
    mode="button"
    iconColorLight="text-rose-400"
    iconColorDark="text-violet-600"
    borderColorLight="border-rose-300"
    borderColorDark="border-violet-600"
/>
```

### **Herencia total (`inheritColor`):**

```blade
<div class="text-green-600 border-green-400">
    <x-toggle-theme-cosis inheritColor size="xl" mode="button" />
</div>
```

**Tip:** Puedes combinar, por ejemplo sólo los iconos:

```blade
<div class="text-blue-500">
    <x-toggle-theme-cosis inheritColor mode="icon" />
</div>
```

### **Mezcla de custom y herencia:**

```blade
<x-toggle-theme-cosis
    mode="button"
    iconColorLight="parent"
    iconColorDark="text-orange-500"
    borderColorLight="parent"
    borderColorDark="border-orange-400"
/>
```

---

## 🔄 Animación

Cada cambio de modo anima el ícono con una rotación suave.

---

## 🦄 Ejemplos creativos

### **Toggle enorme en navbar**

```blade
<nav class="flex items-center justify-between bg-gray-900 p-6">
    <span class="font-bold text-white">LaraCosis</span>
    <x-toggle-theme-cosis size="2xl" mode="button" class="ml-auto" />
</nav>
```

### **Integración con texto:**

```blade
<div class="flex items-center gap-2 text-gray-600 dark:text-gray-200">
    <span x-text="dark ? 'Modo Oscuro' : 'Modo Claro'"></span>
    <x-toggle-theme-cosis size="md" />
</div>
```

### **Solo icono, hereda color y cambia tamaño al hover:**

```blade
<div class="group text-teal-600">
    <x-toggle-theme-cosis inheritColor class="transition-all group-hover:scale-125" />
</div>
```

### **Modo cuadrado, borde de color custom:**

```blade
<x-toggle-theme-cosis mode="square-button" borderColorLight="border-fuchsia-400" borderColorDark="border-sky-400" />
```

### **Modo pill, con sombra y espaciado:**

```blade
<x-toggle-theme-cosis mode="button" class="shadow-md ml-4" size="lg" />
```

---

## 💡 FAQ

* **¿Funciona con Livewire 3?**

  > Sí, es totalmente compatible, no requiere wire\:model ni estados server-side.
* **¿El color se puede heredar de cualquier elemento?**

  > Sí, usando `inheritColor`, el color del SVG y el borde lo pone el parent (usá clases de Tailwind donde lo necesites).
* **¿Se puede usar en cualquier layout?**

  > Sí, mientras el `darkMode` esté en `'class'` en Tailwind y Alpine.js esté presente.
* **¿Admite animaciones extra?**

  > Puedes agregar más animaciones en el `class` del wrapper.

---

## 🔥 Pro tips

* Usá `group` en el padre para hover/active states en el icono.
* Usalo en cards, navbars, menús, donde quieras. Siempre flexible.
* Podés combinar la animación de rotación con escalado, color, etc.

---

## 🎉 Listo para usar, customizar y disfrutar!
