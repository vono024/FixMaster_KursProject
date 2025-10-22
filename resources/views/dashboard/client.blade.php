<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Панель клієнта
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Активні заявки</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $activeRequests->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Завершено</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $completedRequests }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                            <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Очікують відгуку</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $pendingReviews }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Мої активні заявки</h3>
                        <a href="{{ route('repairs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Створити заявку
                        </a>
                    </div>

                    @forelse($activeRequests as $repair)
                        <div class="border-b dark:border-gray-700 py-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <a href="{{ route('repairs.show', $repair) }}" class="text-lg font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                        {{ $repair->title }}
                                    </a>
                                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($repair->description, 100) }}</p>
                                    <div class="flex items-center mt-2 text-sm text-gray-500 dark:text-gray-400 space-x-4">
                                        <span>{{ $repair->created_at->format('d.m.Y H:i') }}</span>
                                        @if($repair->master)
                                            <span>Майстер: {{ $repair->master->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold whitespace-nowrap
                                    @if($repair->status === 'new') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @elseif($repair->status === 'assigned') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @elseif($repair->status === 'in_progress') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                    @endif">
                                    @if($repair->status === 'new') Нова
                                    @elseif($repair->status === 'assigned') Призначено
                                    @elseif($repair->status === 'in_progress') В роботі
                                    @endif
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">Активних заявок немає</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
