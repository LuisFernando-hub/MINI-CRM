@props([
    'striped' => true,
    'hover' => true,
    'bordered' => false,
    'size' => 'md', // sm | md | lg
])

@php
    $tableClasses = \Illuminate\Support\Arr::toCssClasses([
        'w-full text-left border-collapse',
        'text-sm' => $size === 'sm',
        'text-base' => $size === 'md',
        'text-lg' => $size === 'lg',
        'border border-gray-200' => $bordered,
    ]);

    $theadClasses = 'bg-gray-100 text-gray-700';

    $tbodyClasses = \Illuminate\Support\Arr::toCssClasses([
        'divide-y divide-gray-200',
        'odd:bg-gray-50' => $striped,
        'hover:bg-gray-100 transition-colors' => $hover,
    ]);
@endphp

<div class="overflow-x-auto rounded-lg border border-gray-200">
    <table {{ $attributes->merge(['class' => $tableClasses]) }}>
        <thead class="{{ $theadClasses }}">
            {{ $thead }}
        </thead>

        <tbody class="{{ $tbodyClasses }}">
            {{ $slot }}
        </tbody>
    </table>
</div>
