# LaraCosis UI: Global Spinner Overlay for Livewire 3


Este componente te permite mostrar un spinner global de loading en cualquier momento y en cualquier parte de tu app Livewire 3, con opciones automáticas y manuales.

---

## 🟦 Instalación

1. **Agregá el paquete a tu proyecto:**

   ```bash
   composer require laracosis/ui
   ```
2. **Publicá las vistas si querés customizarlas:**

   ```bash
   php artisan vendor:publish --tag=laracosis-ui-components
   ```
3. **Incluí el spinner global en tu layout base:**

   ```blade
   <!-- En tu layout base, justo antes de @livewireScripts -->
   <x-loading-cosis />
   @livewireScripts
   ```

---

## 🚀 Modo Automático (recomendado para UX instantáneo)

### ¿Cómo funciona?

* El overlay aparece automáticamente al ejecutar métodos específicos (o todos), sin tener que llamar nada desde PHP.
* El spinner se muestra INSTANTÁNEO al click, antes de que empiece la request AJAX Livewire.

### Uso

1. **En tu componente Livewire:**

   ```php
   use Laracosis\Ui\Traits\HasSpinnerMethods;

   class Dashboard extends Component
   {
       use HasSpinnerMethods;
       public $spinnerMethods = ['loadingcosis', 'getAllCategories'];

       public function loadingcosis() {
           sleep(2); // Ejemplo de proceso largo
       }
   }
   ```
2. **En tu blade del componente:**

   ```blade
   <button wire:click="loadingcosis">Actualizar</button>
   ```

**Nota:**

* Si `$spinnerMethods` es `['*']`, el spinner se muestra en todos los métodos Livewire.
* Si no definís `$spinnerMethods`, el spinner **no se muestra automáticamente**.

---

## 🟢 Modo Manual (control absoluto desde PHP)

### ¿Cómo funciona?

* Mostrá y ocultá el spinner exactamente cuando quieras, con el mensaje que quieras, desde tu método Livewire.
* Útil para flujos personalizados, acciones en mitad de una función, o pasos condicionales.

### Uso

1. **Agregá el trait:**

   ```php
   use Laracosis\Ui\Traits\ShowsGlobalSpinner;

   class Dashboard extends Component
   {
       use ShowsGlobalSpinner;
       
       public function mifuncion() {
           $this->showSpinner('¡Procesando gastos!');
           sleep(2);
           $this->closeSpinner();
       }
   }
   ```
2. **En tu blade:**

   ```blade
   <button wire:click="mifuncion">Ejecutar manual</button>
   ```

**IMPORTANTE:**

* En modo manual, el spinner **sólo aparece y desaparece al finalizar el request**. No es instantáneo, sino que sigue el ciclo clásico de Livewire.

---

## ❗ Obligatorio: Cerrá siempre el spinner

> **IMPORTANTE:**
> Una vez que el spinner fue mostrado (ya sea automáticamente o manualmente), **no se oculta nunca de forma automática**.
> Siempre debés cerrarlo explícitamente:
>
> * Si lo mostraste desde Livewire (PHP), **llamá** `$this->closeSpinner()` al final de tu método.
> * Si lo mostraste desde Alpine/JS, **llamá** a `hideSpinner()` cuando quieras ocultarlo.
>
> Si tu método Livewire puede finalizar en varios puntos (por ejemplo, tiene varios `return`, validaciones, o puede lanzar excepciones),
> asegurate de cerrar el spinner en **todas las salidas** del método.
>
> Ejemplo con múltiples returns:
>
> ```php
> public function guardar()
> {
>     $this->showSpinner('Guardando...');
>     if ($this->conErrores()) {
>         $this->closeSpinner();
>         return;
>     }
>     // ...más lógica...
>     $this->closeSpinner();
> }
> ```
>
> De igual forma, **si lo mostraste desde JS/Alpine, ocultalo con `hideSpinner()`** según tu flujo.

---

## 🟡 Usar el spinner con helpers globales desde Alpine/JS/JavaScript puro

### ¿Cómo funciona?

El paquete define dos helpers universales en `window`:

```js
showSpinner('Mensaje que quieras');
hideSpinner();
```

Esto permite mostrar u ocultar el overlay desde cualquier lugar del frontend, no solo Livewire.

### **Ejemplo básico:**

```blade
<!-- Mostrar spinner al hacer click -->
<button @click="showSpinner('Cargando desde Alpine...')">Mostrar spinner</button>
<button @click="hideSpinner()">Ocultar spinner</button>
```

### **Ejemplo con otros eventos Alpine:**

```blade
<!-- Mostrar spinner cuando se envía un formulario -->
<form @submit.prevent="showSpinner('Enviando formulario...')">
    ...
    <button type="submit">Enviar</button>
</form>

<!-- Mostrar spinner cuando un input pierde el foco -->
<input @blur="showSpinner('Guardando cambios...')">

<!-- Cerrar spinner al finalizar animación -->
<div @animationend="hideSpinner()"></div>
```

### **Desde JavaScript puro:**

```js
// En cualquier parte de tu JS
showSpinner('Mensaje desde JS puro');
setTimeout(() => hideSpinner(), 2000);
```

¡Podés lanzar el overlay con cualquier evento Alpine o JS nativo!

---

## 🎨 Customización

### Cambiar el contenido visual del spinner

1. **Opción A: Vendor publish**
   Publicá y edita la vista:

   ```bash
   php artisan vendor:publish --tag=laracosis-ui-components
   ```

   Editá el archivo en `resources/views/vendor/laracosis/livewire/loading-cosis.blade.php`.

2. **Opción B: customView prop**
   Usá tu propio Blade solo para el contenido visual:

   ```blade
   <x-loading-cosis customView="custom.spinner" />
   ```

   Y creá tu Blade en `resources/views/custom/spinner.blade.php`, usando `{{ $message }}` si querés el mensaje dinámico.

### Cambiar el mensaje del spinner

* En modo automático: El mensaje default es "Procesando..." pero podés customizar el evento desde JS o con helpers.
* En modo manual: Pasá el mensaje deseado a `$this->showSpinner('Mensaje aquí')`.
* En customView, usá `{{ $message }}` para mostrarlo.

---

## ⚠️ Limitaciones técnicas (Livewire 3)

* **El modo manual** sólo muestra el spinner al usuario al final del request (por limitaciones propias de Livewire/browser events). No es instantáneo.
* **El modo automático** sí muestra el spinner instantáneo, usando el hook JS del request Livewire.
* **Los helpers globales** permiten mostrar/ocultar el spinner en cualquier momento y con cualquier evento, sin pasar por Livewire.

---

## 🧩 Ejemplo completo

```php
use Laracosis\Ui\Traits\HasSpinnerMethods;

class Dashboard extends Component
{
    use HasSpinnerMethods;
    public $spinnerMethods = ['loadingcosis'];

    public function loadingcosis() {
        sleep(2);
    }
}
```

O manual:

```php
use Laracosis\Ui\Traits\ShowsGlobalSpinner;

class Dashboard extends Component
{
    use ShowsGlobalSpinner;
    public function mifuncion() {
        $this->showSpinner('¡Procesando!');
        sleep(2);
        $this->closeSpinner();
    }
}
```

---

¡Listo! Ahora tu app tiene un overlay global moderno, customizable y súper flexible 🎉
