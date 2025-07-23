<?php

namespace Laracosis\Ui;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class UiServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->registerLivewireComponents();

        // Publish views
        $this->loadViewsFrom(__DIR__.'/../resources/views/components', 'laracosis');

        $this->registerCustomComponents();

        Blade::componentNamespace('Laracosis\\Ui\\Components', 'laracosis');

        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/vendor/laracosis'),
        ], 'laracosis-ui-components');

        $this->publishes([
            __DIR__.'/../config/twigui' => config_path('twigui'),
        ], 'laracosis-ui-config');

        $this->publishPresets();
    }

    public function registerLivewireComponents()
    {
        // Register Livewire components
        \Livewire\Livewire::component('loading-cosis', \Laracosis\Ui\Components\Livewire\LoadingCosis::class);
        \Livewire\Livewire::component('toast-cosis', \Laracosis\Ui\Components\Livewire\ToastCosis::class);
        \Livewire\Livewire::component('toggle-theme-cosis', \Laracosis\Ui\Components\Livewire\ToggleThemeCosis::class);
    }

    public function registerCustomComponents()
    {
        #Blade::component(\Laracosis\Ui\Components\TemplateComponent::class, 'template-component');
        Blade::component(\Laracosis\Ui\Components\SelectCosis::class, 'select-cosis');
        Blade::component(\Laracosis\Ui\Components\ToggleCosis::class, 'toggle-cosis');
        Blade::component(\Laracosis\Ui\Components\InputCosis::class, 'input-cosis');
        Blade::component(\Laracosis\Ui\Components\LoadingCosis::class, 'loading-cosis');
        Blade::component(\Laracosis\Ui\Components\ButtonCosis::class, 'button-cosis');
        Blade::component(\Laracosis\Ui\Components\ToastCosis::class, 'toast-cosis');
        Blade::component(\Laracosis\Ui\Components\ModalCosis::class, 'modal-cosis');
        Blade::component(\Laracosis\Ui\Components\HeaderCosis::class, 'header-cosis');
        Blade::component(\Laracosis\Ui\Components\SidebarCosis::class, 'sidebar-cosis');
        Blade::component(\Laracosis\Ui\Components\ToggleThemeCosis::class, 'toggle-theme-cosis');
        Blade::component(\Laracosis\Ui\Components\LayoutCosis::class, 'layout-cosis');
        Blade::component(\Laracosis\Ui\Components\NavCosis::class, 'nav-cosis');

    }

    public function publishPresets() {
            $this->publishes([
                __DIR__ . '/../resources/views/presets/nav/colors.blade.php' => resource_path('views/vendor/twigui/presets/nav/colors.blade.php'),
            ], 'twigui-nav-presets');

            $this->publishes([
                __DIR__ . '/../resources/views/presets/nav/colors.php' => resource_path('views/vendor/twigui/presets/nav/colors.php'),
                // Agregá otros presets acá:
                // __DIR__ . '/../resources/views/presets/button/colors.php' => resource_path('views/vendor/twigui/presets/button/colors.php'),
                // __DIR__ . '/../resources/views/presets/table/colors.php' => resource_path('views/vendor/twigui/presets/table/colors.php'),
            ], 'twigui-presets');
    }
}
