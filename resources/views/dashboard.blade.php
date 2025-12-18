<x-layouts.app>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Dashboard')}}</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Welcome to the dashboard') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Total Tickets') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $totalTickets }}</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg> --}}
                        {{-- {{ __('No data') }} --}}
                    </p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-archive-x-icon lucide-archive-x">
                        <rect width="20" height="5" x="2" y="3" rx="1" />
                        <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8" />
                        <path d="m9.5 17 5-5" />
                        <path d="m9.5 12 5 5" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Total Tickets New') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $totalTicketsNew }}</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg> --}}
                        {{-- {{ __('No data') }} --}}
                    </p>
                </div>
                <div class="bg-orange-100 dark:bg-orange-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-plus-icon lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Total Tickets in progress') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $totalTicketsInProgess }}</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        {{ __('No data') }} --}}
                    </p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chart-no-axes-column-icon lucide-chart-no-axes-column">
                        <path d="M5 21v-6" />
                        <path d="M12 21V3" />
                        <path d="M19 21V9" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Visitors Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Total Tickets Processed') }}
                    </p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">{{ $totalTicketsProcessed }}</p>
                    <p class="text-xs text-gray-500 flex items-center mt-1">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg> --}}
                        {{-- {{ __('No data') }} --}}
                    </p>
                </div>
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-list-check-icon lucide-list-check">
                        <path d="M16 5H3" />
                        <path d="M16 12H3" />
                        <path d="M11 19H3" />
                        <path d="m15 18 2 2 4-4" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <x-table>
        <x-table.filters action="{{ route('dashboard') }}" :statuses="[
        'new' => 'New',
        'in_progress' => 'In Progress',
        'processed' => 'Processed',
    ]" />
        <x-slot name="thead">
            <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Phone</th>
                <th class="px-4 py-3">E-mail</th>
                <th class="px-4 py-3">Subject</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Created At</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </x-slot>
        @foreach ($tickets as $ticket)
                    <tr>
                        <td class="px-4 py-3">{{ $ticket->id }}</td>
                        <td class="px-4 py-3">{{ $ticket->customer->name }}</td>
                        <td class="px-4 py-3">{{ $ticket->customer->phone_number }}</td>
                        <td class="px-4 py-3">{{ $ticket->customer->email }}</td>
                        <td class="px-4 py-3">{{ $ticket->subject }}</td>
                        <td class="px-4 py-3">{{ $ticket->status }}</td>
                        <td class="px-4 py-3">{{ $ticket->created_at }}</td>
                        <td>
                            <x-button type="primary"
                                x-on:click="$dispatch('open-modal', { id: 'customer-details-{{ $ticket->id }}' })">
                                Details
                            </x-button>
                        </td>
                    </tr>
                    <x-modal id="customer-details-{{ $ticket->id }}" title="Customer details" maxWidth="max-w-xl">
                        <div class="space-y-2 text-sm">
                            <div>
                                <strong>Name:</strong> {{ $ticket->customer->name }}
                            </div>

                            <div>
                                <strong>Email:</strong> {{ $ticket->customer->email }}
                            </div>

                            <div>
                                <strong>Phone:</strong> {{ $ticket->customer->phone }}
                            </div>

                            <div>
                                <strong>Status:</strong> {{ ucfirst($ticket->status) }}
                            </div>

                            <div>
                                <strong>Created Ticket:</strong>
                                {{ $ticket->created_at }}
                            </div>
                        </div>

                        <div class="mt-4">
                            <div x-data='{files: @json($ticket->customer->documents, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)}'>
                                <template x-for="(file, index) in files" :key="index">
                                    <div class="border rounded mb-2">
                                        <button type="button"
                                            class="w-full px-4 py-2 flex justify-between items-center bg-gray-100 hover:bg-gray-200 rounded-t"
                                            @click="files[index].open = !files[index].open">
                                            <span x-text="file.file_name"></span>
                                            <svg x-show="!file.open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg x-show="file.open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v8a1 1 0 11-2 0V6a1 1 0 011-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <div x-show="files[index].open" class="px-4 py-2 bg-white border-t">
                                            <a :href="file.url" target="_blank"
                                                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="flex flex-col w-full">
                            <form class="max-w-md mb-10 w-full" action="{{ route('tickets.update.status', $ticket->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-6">
                                    <x-forms.select label="Status" name="status" type="select" :options="$statuses"
                                        :selected="$ticket->status" />
                                </div>

                                <x-slot name="footer">
                                    <div class="flex gap-2 justify-end">
                                        <x-button type="danger" x-on:click="$dispatch('open-modal', { id: null })">
                                            Close
                                        </x-button>
                                    </div>
                                </x-slot>
                                <x-button type="primary">{{ __('Update Status Ticket') }}</x-button>
                            </form>
                        </div>
                    </x-modal>
        @endforeach
    </x-table>
</x-layouts.app>