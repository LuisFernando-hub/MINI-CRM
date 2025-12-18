@props([
    'action' => null,
    'method' => 'GET',
    'statuses' => [],
])

<form action="{{ $action }}" method="{{ $method }}" class="mb-4">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input
                type="name"
                name="name"
                value="{{ request('name') }}"
                class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Name"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">E-mail</label>
            <input
                type="email"
                name="email"
                value="{{ request('email') }}"
                class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="email@exemplo.com"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input
                type="text"
                name="phone"
                value="{{ request('phone') }}"
                class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="+5511999999999"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select
                name="status"
                class="w-full px-4 py-1.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
                <option value="">All</option>

                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') == $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex gap-2 mt-4 justify-end mb-3 p-1">
        <x-button type="primary">Filter</x-button>

        <a href="{{ url()->current() }}"
           class="text-sm text-gray-600 hover:underline flex items-center">
            Clear filters
        </a>
    </div>
</form>