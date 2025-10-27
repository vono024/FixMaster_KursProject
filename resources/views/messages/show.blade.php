<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Повідомлення: {{ $repair->title }}
            </h2>
            <a href="{{ route('messages.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                ← Назад до списку
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $repair->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">Клієнт: {{ $repair->client->name }}</p>
                            </div>
                            <a href="{{ route('repairs.show', $repair) }}"
                               class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                Переглянути заявку →
                            </a>
                        </div>
                    </div>

                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                        @foreach($messages as $message)
                            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="flex items-start {{ $message->sender_id === auth()->id() ? 'flex-row-reverse' : 'flex-row' }} max-w-xs lg:max-w-md">
                                    <x-user-avatar :user="$message->sender" size="sm" class="flex-shrink-0 {{ $message->sender_id === auth()->id() ? 'ml-2' : 'mr-2' }}" />
                                    <div class="px-4 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
                                        <p class="text-sm">{{ $message->message }}</p>
                                        <p class="text-xs {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }} mt-1">
                                            {{ $message->created_at->format('d.m.Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <form method="POST" action="{{ route('messages.store', $repair) }}" class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        @csrf
                        <div class="flex space-x-4">
                            <input type="text" name="message" placeholder="Написати повідомлення..."
                                   class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                                Відправити
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
