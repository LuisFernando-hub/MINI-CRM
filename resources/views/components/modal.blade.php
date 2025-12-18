@props([
    'id',
    'title' => null,
    'maxWidth' => 'max-w-lg',
])

<div
    x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail.id === '{{ $id }}') open = true"
    x-on:keydown.escape.window="open = false"
    x-show="open"
    class="fixed inset-0 z-50 flex items-center justify-center"
    style="display: none;"
>
    <div
        class="fixed inset-0 bg-black/50"
        x-on:click="open = false"
    ></div>

    <div class="bg-white rounded-lg shadow-xl w-full {{ $maxWidth }} z-50">
        <div class="flex items-center justify-between px-4 py-3 border-b">
            <h2 class="text-lg font-semibold">
                {{ $title }}
            </h2>

            <button
                x-on:click="open = false"
                class="text-gray-400 hover:text-gray-600"
            >
                ✕
            </button>
        </div>

        <div class="p-4">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="px-4 py-3 border-t bg-gray-50 text-right">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
