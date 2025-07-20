# <x-select-cosis /> — Select avanzado de LaraCosis UI

Componente Blade para selects avanzados en Laravel.  
Diseñado para soportar UX moderna, íconos, search, selección múltiple y fetch remoto.  
Perfecto para dashboards, filtros y formularios amigables.

---

## Características principales

- Opciones: simples, con ícono/avatar/descripción
- Single o múltiple (`multiple`)
- Búsqueda instantánea (`searchable`)
- Limpieza rápida (`clearable`)
- Opciones asincrónicas/remotas (`remote`)
- Personalización de estilos y ancho (`class`)
- Totalmente compatible con Livewire y Alpine.js

---

## Instalación y uso básico

1. **Instala el paquete**  
   (Ver README principal para agregarlo vía composer local/path o packagist)

2. **Incluye el componente donde lo necesites:**

```blade
<x-select-cosis
    :options="$categorias"
    wire:model.live="categoria_id"
    placeholder="Seleccionar categoría"
    :searchable="true"
/>
```

---

## Props disponibles

| Prop          | Tipo    | Descripción                                      | Default           |
|---------------|---------|--------------------------------------------------|-------------------|
| `options`     | array   | Opciones (array, dict o colección Eloquent)      | `[]`              |
| `selected`    | mixed   | Valor seleccionado inicial                       | `null`            |
| `multiple`    | bool    | Selección múltiple                               | `false`           |
| `searchable`  | bool    | Habilita el buscador                             | `false`           |
| `clearable`   | bool    | Muestra botón limpiar                            | `true`            |
| `icon`        | string  | Ícono SVG o emoji para el botón                  | `null`            |
| `placeholder` | string  | Texto por defecto                                | `Seleccionar...`  |
| `label`       | string  | Label externo                                    | `null`            |
| `remote`      | bool    | Habilita fetch de opciones vía AJAX              | `false`           |
| `remote-url`  | string  | URL para fetch remoto (con `remote=true`)        | `null`            |
| `class`       | string  | Clases extra para el contenedor principal        | `-`               |

---

## Formatos de opciones soportados

1. **Array asociativo**  
   ```php
   [1 => 'Opción 1', 2 => 'Opción 2']
   ```
2. **Array de arrays**  
   ```php
   [
      ['id' => 1, 'label' => 'Opción A', 'icon' => '🟢'],
      ['id' => 2, 'label' => 'Opción B', 'avatar' => 'https://i.pravatar.cc/40?img=3'],
      ['id' => 3, 'label' => 'Opción C', 'description' => 'Detalle extra'],
   ]
   ```
3. **Collection Eloquent**  
   ```php
   $categories = Category::all(); // El select extrae id/name/icon/avatar automáticamente
   ```

---

## Ejemplo simple (single select)

```blade
<x-select-cosis
    :options="$metodosPago"
    wire:model.live="payment_method_id"
    placeholder="Método de pago"
    :searchable="true"
/>
```

---

## Ejemplo múltiple

```blade
<x-select-cosis
    :options="$usuarios"
    wire:model.live="usuarios_id"
    :multiple="true"
    placeholder="Seleccionar usuarios"
    :clearable="true"
/>
```

---

## Ejemplo con íconos y avatares

```php
// En tu controlador
$categories = [
    1 => ['label' => 'Supermercado', 'icon' => '🛒'],
    2 => ['label' => 'Salud', 'avatar' => 'https://i.pravatar.cc/40?img=5'],
    3 => ['label' => 'Ocio', 'icon' => '<svg ...>...</svg>'],
];
```

```blade
<x-select-cosis
    :options="$categories"
    wire:model.live="category_id"
    placeholder="Categoría"
/>
```

---

## Ejemplo con opciones remotas (async/remote)

### Blade

```blade
<x-select-cosis
    remote="true"
    remote-url="{{ route('api.categorias.search') }}"
    wire:model.live="categoria_id"
    placeholder="Buscar categoría..."
    :searchable="true"
/>
```

### Backend (Laravel Controller)

```php
public function searchCategorias(Request $request)
{
    $q = $request->input('q', '');
    $results = Category::query()
        ->where('name', 'like', "%{$q}%")
        ->limit(15)
        ->get()
        ->map(function ($cat) {
            return [
                'id' => $cat->id,
                'label' => $cat->name,
                'icon' => $cat->icon, // Puede ser emoji o SVG
            ];
        })
        ->values();

    return response()->json($results);
}
```

- El componente hace un GET con `?q=texto`
- Espera un array de opciones como en el ejemplo de arriba

---

## Limpieza rápida de selección

Si `clearable=true` (default), aparece una X para limpiar la selección.  
Funciona para single y múltiple.

---

## Personalización de ancho y clases

```blade
<x-select-cosis
    ...otros props
    class="w-[220px] min-w-[200px] max-w-[220px]"
/>
```

---

## Eventos y uso avanzado (Alpine.js/Livewire)

- Cambios se propagan vía wire:model automáticamente
- Internamente usa Alpine.js; podés engancharte a eventos con `@change` o customizar
- Accesible y navegable por teclado

---

## Tips y notas

- El select normaliza automáticamente colecciones y arrays, ¡no hace falta procesar!
- Si pasás modelos Eloquent, usará `id` y `name` (o `label`) automáticamente
- Los chips apilados en múltiple nunca agrandan el botón, y se truncan si hay muchos seleccionados
- Funciona en cualquier layout y modo oscuro

---

## Ejemplo: Todos juntos (multi + remote + iconos)

```blade
<x-select-cosis
    :multiple="true"
    remote="true"
    remote-url="{{ route('api.usuarios.busqueda') }}"
    wire:model.live="usuarios_id"
    placeholder="Buscar usuarios..."
    :searchable="true"
    class="w-[300px]"
/>
```

---

# FAQ

**¿Funciona con Livewire?**  
¡Sí! wire:model funciona con todos los modos (lazy/live/defer).

**¿Tengo que normalizar las opciones?**  
No, el componente soporta arrays simples, diccionarios, Eloquent, etc.

**¿Soporta descripciones, íconos SVG, emojis o avatares?**  
¡Sí! `description`, `icon`, `avatar` en cada opción.

---

# Créditos

Desarrollado por LaraCosis Team.  
Ideas, PR y feedback bienvenidos en el repo.

---
