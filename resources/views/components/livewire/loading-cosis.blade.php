<div>
<div
    x-data="{ show: false, message: 'Cargando...' }"
    x-on:show-global-spinner.window="show = true; message = $event.detail?.message || 'Cargando...'; document.body.classList.add('overflow-hidden')"
    x-on:hide-global-spinner.window="show = false; document.body.classList.remove('overflow-hidden')"
    x-show="show"
    class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-black/60 dark:bg-black/80 backdrop-blur-sm"
    style="display: none"
    x-transition.opacity
>

    @if(view()->exists($customView ?? ''))
        @include($customView, ['message' => $message ?? 'Cargando...'])
    @else
        <div class="flex flex-col items-center gap-4">
            {{-- Spinner SVG --}}
            <svg class="animate-spin h-14 w-14 text-white dark:text-white/80" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
            </svg>
            <span class="text-white dark:text-white/90 text-xl font-semibold" x-text="message"></span>
        </div>
    @endif
</div>


<script>
    window.laraCosisSpinnerMethods = @json($spinnerMethods ?? ['*']);

document.addEventListener('DOMContentLoaded', () => {
    if (!window.Livewire || !window.Livewire.hook) {
        console.error('Livewire 3+ no detectado. El spinner global no funcionará.');
        return;
    }

    window.Livewire.hook('request', (context) => {
        const { payload, finish } = context;
        const methods = window.laraCosisSpinnerMethods || [];

        let method = null;

        // 1. Parsear el payload para encontrar el método
        if (typeof payload === 'string') {
            try {
                const payloadObj = JSON.parse(payload);

                // components[0].calls puede tener varios llamados
                if (Array.isArray(payloadObj.components)) {
                    for (const component of payloadObj.components) {
                        if (Array.isArray(component.calls) && component.calls.length > 0) {
                            // Típicamente solo 1 por acción
                            method = component.calls[0].method;
                            break;
                        }
                    }
                }
            } catch (e) {
                console.warn('No se pudo parsear Livewire payload:', e);
            }
        }

        // Debug
        console.log('Livewire3 spinner método:', method);

        if (!method) {
            if (typeof finish === 'function') {
                finish(() => {
                    window.dispatchEvent(new Event('hide-global-spinner'));
                });
            }
            return;
        }

        if (
            (methods.length === 1 && methods[0] === '*') ||
            methods.includes(method)
        ) {
            window.dispatchEvent(
                new CustomEvent('show-global-spinner', { detail: { message: 'Procesando...' } })
            );
        }

        if (typeof finish === 'function') {
            console.log('Llamando finish...');
            finish(() => {
                console.log('Cerrando spinner global (finish hook)');
                window.dispatchEvent(new Event('hide-global-spinner'));
            });
            console.log('Finish llamado');
        }
    });
});



</script>
</div>
