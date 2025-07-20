// laracosis-local-spinner Alpine directive
document.addEventListener('alpine:init', () => {
    Alpine.directive('local-spinner', (el, {expression}, {evaluateLater, cleanup}) => {
        let target = el.getAttribute('wire:target');
        let message = el.getAttribute('spinner-message') || 'Procesando...';

        if (!target) return;

        function showSpinner() {
            let spinner = document.getElementById('laracosis-local-spinner');
            if (spinner && spinner.__x) {
                spinner.__x.$data.show = true;
                spinner.__x.$data.message = message;
            }
        }
        function hideSpinner() {
            let spinner = document.getElementById('laracosis-local-spinner');
            if (spinner && spinner.__x) {
                spinner.__x.$data.show = false;
            }
        }

        const start = (e) => {
            if (e.detail && e.detail.component && e.detail.target && e.detail.target === target) {
                showSpinner();
            }
        };
        const stop = (e) => {
            if (e.detail && e.detail.component && e.detail.target && e.detail.target === target) {
                hideSpinner();
            }
        };

        window.addEventListener('livewire:loading', start);
        window.addEventListener('livewire:loading-done', stop);

        cleanup(() => {
            window.removeEventListener('livewire:loading', start);
            window.removeEventListener('livewire:loading-done', stop);
        });
    });
});
