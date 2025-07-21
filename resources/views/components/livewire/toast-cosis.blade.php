<div class="fixed z-50 top-6 right-6 flex flex-col gap-3 max-w-sm w-96">
    @foreach($toasts as $toast)
        <div wire:key="{{ $toast['id'] }}" class="bg-white border p-4 mb-2 rounded shadow">
            <div class="font-semibold">{{ $toast['title'] ?? '' }}</div>
            <div>{{ $toast['message'] ?? '' }}</div>
            <button wire:click="removeToast('{{ $toast['id'] }}')" class="ml-4 text-gray-500 hover:text-gray-700 text-xl float-right">×</button>
        </div>
    @endforeach
</div>