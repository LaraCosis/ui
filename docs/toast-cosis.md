# LaraCosis ToastCosis

**Notificaciones toast flexibles, bonitas y 100% Livewire-ready para Laravel.**

* Animaciones, autocierre, progress bar ultra-fina, pause/resume en hover
* Iconos SVG automáticos según tipo
* Posicionamiento: top-right (default), top-left, bottom-right, bottom-left
* API ultra simple via trait, sin stores JS ni dependencias extras

---

## Instalación

1. Instala el paquete (si es un paquete Composer):

   ```bash
   composer require laracosis/ui
   ```
2. Publica los componentes si es necesario:

   ```bash
   php artisan vendor:publish --tag=laracosis-ui-components
   ```
3. Asegúrate de tener **Livewire 3+** y **Alpine.js** en tu proyecto.

---

## Uso básico

### 1. Agrega el componente en tu layout principal

```blade
<!-- En resources/views/layouts/app.blade.php, al final del <body> -->
<x-toast-cosis />
```

Opcional: puedes indicar la posición global por defecto:

```blade
<x-toast-cosis position="bottom-right" />
```

### 2. Usa el trait en tus componentes Livewire

```php
use Laracosis\Ui\Traits\HasToastCosis;

class DemoComponent extends \Livewire\Component
{
    use HasToastCosis;

    public function save()
    {
        // ...
        $this->toast()->success('¡Guardado!', 'Tus cambios fueron aplicados.');
    }
}
```

### 3. Disparar toasts personalizados

Puedes disparar cualquier tipo:

```php
$this->toast()->success('Título', 'Mensaje opcional', 6000); // 6 segundos
$this->toast()->error('Ups', 'Algo salió mal...', 3000, 'bottom-left');
$this->toast()->info('Info', 'Todo correcto', 4000, 'top-left');
$this->toast()->warning('Atención', '¡Verifica los datos!', 7000, 'bottom-right');
```

* El 3er parámetro es duración en milisegundos (default: 4000).
* El 4to parámetro es la posición específica para ese toast (`top-right`, `top-left`, `bottom-right`, `bottom-left`).
* Si no se indica, usa la global.

---

## Opciones de posición

Puedes mostrar varios stacks en simultáneo, ¡y cada toast puede ir a una esquina diferente!

```blade
<x-toast-cosis position="top-right" />
<x-toast-cosis position="bottom-right" />
<x-toast-cosis position="top-left" />
<x-toast-cosis position="bottom-left" />
```

**Cada componente maneja solo los toasts de su posición, el trait los agrupa automáticamente.**

---

## Características visuales

* Animación de entrada/salida, movimiento y escala.
* Barra de progreso ultra-fina (congelable con hover).
* Iconos SVG automáticos según tipo (`success`, `error`, `info`, `warning`).
* Botón de cerrar.
* Diseño adaptable a dark mode.
* Soporte multi-stack (varias esquinas a la vez).

---

## Ejemplo completo de uso

```php
// En cualquier componente Livewire:
$this->toast()->success('¡Bien!', 'Guardado exitoso', 4000, 'bottom-right');
$this->toast()->error('Error', 'No se pudo guardar.', 5000, 'top-left');
```

```blade
<!-- En tu layout principal (por ejemplo layouts/app.blade.php) -->
<x-toast-cosis position="bottom-right" />
<x-toast-cosis position="top-left" />
```

---

## Personalización

* Puedes personalizar colores y SVGs editando el Blade `toast-cosis.blade.php`.
* Puedes cambiar la duración y posición para cada toast.
* Si quieres un diseño ultra-flat, sólo ajusta los paddings y el alto de la barra de progreso.

---

## ¿Problemas?

* Revisa que Alpine y Livewire estén correctamente cargados.
* Revisa que tu layout no tape el stack (z-50 en el contenedor).
* Si usas componentes de slots/yield, asegúrate de poner el ToastCosis **fuera de esos stacks**.
* El trait **no requiere JS, sólo Livewire**.

---

## Créditos y licencia

* Inspirado en los mejores toasts de la web, pero 100% orientado a Livewire + Alpine.
* Licencia MIT, libre para modificar y usar en proyectos propios o comerciales.

---

¡Hecho con ❤️ por LaraCosis!
