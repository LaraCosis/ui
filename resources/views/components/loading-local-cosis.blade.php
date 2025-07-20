<div
    x-data="{ show: false, message: '' }"
    x-show="show"
    x-transition.opacity
    x-cloak
    id="laracosis-local-spinner"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
    style="backdrop-filter: blur(2px);"
>
    <div class="rounded-full animate-spin w-16 h-16 border-4 border-white border-t-blue-500"></div>
    <span class="ml-4 text-white text-xl" x-text="message"></span>
</div>
<script src="{{ asset('vendor/laracosis/ui/local-spinner.js') }}"></script>