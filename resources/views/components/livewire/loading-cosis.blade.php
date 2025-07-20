<div
    x-data="{ show: false, message: 'Cargando...' }"
    x-on:show-global-spinner.window="show = true; message = $event.detail?.message || 'Cargando...'; document.body.classList.add('overflow-hidden')"
    x-on:hide-global-spinner.window="show = false; document.body.classList.remove('overflow-hidden')"
    x-show="show"
    class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-black/60 dark:bg-black/80 backdrop-blur-sm"
    style="display: none"
    x-transition.opacity
>
    <div class="flex flex-col items-center gap-4">
        {{-- Spinner SVG --}}
        <svg class="animate-spin h-14 w-14 text-white dark:text-white/80" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
        </svg>
        <span class="text-white dark:text-white/90 text-xl font-semibold" x-text="message"></span>
    </div>
</div>

<script>
    window.laraCosisSpinnerMethods = @json($spinnerMethods ?? ['*']);

    document.addEventListener('livewire:message.sent', event => {
        const methods = window.laraCosisSpinnerMethods || [];
        const payload = event.detail?.updateQueue?.[0]?.payload;
        if (!payload) return;

        // Si methods es ['*'] o vacío, match cualquier método
        if (
            methods.length === 0 ||
            (methods.length === 1 && methods[0] === '*') ||
            methods.includes(payload.method)
        ) {
            window.dispatchEvent(
                new CustomEvent('show-global-spinner', { detail: { message: 'Procesando...' } })
            );
        }
    });

    document.addEventListener('livewire:idle', () => {
        window.dispatchEvent(new Event('hide-global-spinner'));
    });
</script>