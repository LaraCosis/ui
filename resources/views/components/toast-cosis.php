<div 
    x-data="{
        toasts: [],
        add(toast) {
            this.toasts.push(toast);
            setTimeout(() => this.remove(toast.id), toast.duration || 4000);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id)
        }
    }"
    x-init="
        window.addEventListener('toast-cosis', e => add(e.detail));
    "
    class="fixed z-50 top-6 right-6 flex flex-col gap-3 max-w-sm"
    style="pointer-events: none;"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-6"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="pointer-events-auto flex items-start rounded-lg shadow-lg px-4 py-3 bg-white dark:bg-gray-800 border-l-4"
            :class="{
                'border-green-500': toast.type === 'success',
                'border-red-500': toast.type === 'error',
                'border-yellow-500': toast.type === 'warning',
                'border-blue-500': toast.type === 'info',
            }"
        >
            <!-- Icono -->
            <template x-if="toast.icon">
                <i :class="toast.icon + ' mr-3 text-2xl'"></i>
            </template>
            <!-- Contenido -->
            <div class="flex-1">
                <div class="font-bold mb-1" x-text="toast.title"></div>
                <div x-text="toast.message"></div>
            </div>
            <!-- Cerrar -->
            <button @click="remove(toast.id)" class="ml-4 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-xl">&times;</button>
        </div>
    </template>
</div>
