<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Мої повідомлення
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($repairRequests->count() > 0)
                        <div class="space-y-4">
                            @foreach($repairRequests as $repair)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <x-user-avatar :user="auth()->user()->role === 'client' ? $repair->master : $repair->client" size="sm" />
                                            <div class="ml-3">
                                                <h3 class="font-semibold text-gray-800 dark:text-gray-200">
                                                    {{ $repair->title }}
                                                </h3>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ auth()->user()->role === 'client' ? 'Майстер: ' . ($repair->master->name ?? 'Не призначено') : 'Клієнт: ' . $repair->client->name }}
                                                </p>
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $repair->updated_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($repair->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($repair->status === 'new') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                            @elseif($repair->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                            @elseif($repair->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                            @endif">
                                            {{ ucfirst($repair->status) }}
                                        </span>
                                        <a href="{{ route('messages.show', $repair) }}"
                                           class="text-blue-600 dark:text-blue-400 hover:underline">
                                            Переглянути повідомлення
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $repairRequests->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">У вас ще немає повідомлень</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
