<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                @if(auth()->user()->role === 'client')
                    Мої заявки
                @elseif(auth()->user()->role === 'master')
                    Заявки на ремонт
                @else
                    Всі заявки
                @endif
            </h2>
            @if(auth()->user()->role === 'client')
                <a href="{{ route('repairs.create') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Створити заявку
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($repairs as $repair)
                        <div class="border-b border-gray-200 dark:border-gray-700 py-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <a href="{{ route('repairs.show', $repair) }}"
                                       class="text-lg font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                        {{ $repair->title }}
                                    </a>
                                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($repair->description, 100) }}</p>
                                    <div class="flex items-center mt-2 text-sm text-gray-500 dark:text-gray-400 space-x-4">
                                        <span>{{ $repair->created_at->format('d.m.Y H:i') }}</span>
                                        @if(auth()->user()->role === 'master' && $repair->client)
                                            <span>Клієнт: {{ $repair->client->name }}</span>
                                        @endif
                                        @if(auth()->user()->role === 'client' && $repair->master)
                                            <span>Майстер: {{ $repair->master->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold whitespace-nowrap
                                        @if($repair->status === 'new') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                        @elseif($repair->status === 'assigned') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                        @elseif($repair->status === 'in_progress') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                        @elseif($repair->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                        @endif">
                                        @if($repair->status === 'new') Нова
                                        @elseif($repair->status === 'assigned') Призначено
                                        @elseif($repair->status === 'in_progress') В роботі
                                        @elseif($repair->status === 'completed') Завершено
                                        @else Скасовано
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">Заявок поки немає</p>
                    @endforelse
                </div>

                @if($repairs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $repairs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
