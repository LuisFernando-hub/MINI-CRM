@props([
    'label' => '',
    'name' => '',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Selecione',
])

<div class="mb-4">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <select
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
        ]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $optionLabel)
            <option value="{{ $optionLabel->value }}" @selected($selected == $optionLabel->value)>{{ $optionLabel->getReadableName() }}</option>
        @endforeach
    </select>
</div>
