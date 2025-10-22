<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Повідомлення: {{ $repair->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $repair->title }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                @if($repair->client_id === auth()->id())
                                    Майстер: {{ $repair->master->name ?? 'Не призначено' }}
                                @else
                                    Клієнт: {{ $repair->client->name }}
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('repairs.show', $repair) }}"
                           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">
                            Переглянути заявку →
                        </a>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-gray-900 max-h-96 overflow-y-auto">
                    <div class="space-y-4">
                        @forelse($messages as $message)
                            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md">
                                    <div class="flex items-center mb-1 {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                        <img src="{{ $message->sender->avatar_url }}" alt="{{ $message->sender->name }}"
                                             class="w-6 h-6 rounded-full {{ $message->sender_id === auth()->id() ? 'ml-2 order-2' : 'mr-2' }}">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $message->sender->name }}
                                        </span>
                                    </div>
                                    <div class="px-4 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-700' }}">
                                        <p class="break-words">{{ $message->message }}</p>
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 {{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                        {{ $message->created_at->format('d.m.Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center">Повідомлень ще немає</p>
                        @endforelse
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('messages.store', $repair) }}">
                        @csrf
                        <div class="flex space-x-2">
                            <textarea name="message" rows="2" required
                                      placeholder="Написати повідомлення..."
                                      class="flex-1 shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('message') border-red-500 @enderror"></textarea>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded whitespace-nowrap">
                                Відправити
                            </button>
                        </div>
                        @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
