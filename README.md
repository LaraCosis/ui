# LaraCosis UI

**LaraCosis UI** es un paquete de componentes Blade y Livewire modernos, personalizables y accesibles para Laravel.  
Incluye toggles, alerts, inputs y más, compatibles con Tailwind, Alpine.js y dark mode.

---

## Instalación

```bash
composer require laracosis/ui
```

Agregá Alpine.js y Tailwind si tu proyecto aún no los tiene.

---

## Documentación de componentes

- [Select (`<x-select-cosis>`)](docs/select-cosis.md)
- [Toggle (`<x-toggle-cosis>`)](docs/toggle-cosis.md)
- [Global Spinner (`<x-loading-cosis>`)](docs/loading-cosis.md)


---

## Ejemplo rápido

```blade
<x-toggle-cosis wire:model="is_active" label="Activo" />
```

---

## Personalización

Todos los componentes son:
- Personalizables por props (colores, tamaños, estados, etc.)
- Accesibles (a11y)
- Compatibles con dark/light mode
- Usables tanto con Livewire como en Blade puro

---

## Más información

Mirá la documentación completa de cada componente en la carpeta [docs](docs/).

¿Querés sumar componentes o sugerir mejoras?  
¡Pull Requests y feedback bienvenidos!

---

## Licencia

MIT
