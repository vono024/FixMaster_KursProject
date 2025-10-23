<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Деталі заявки #{{ $repair->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $repair->title }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Створено: {{ $repair->created_at->format('d.m.Y H:i') }}
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
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

                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Тип пристрою:</h4>
                            <p class="text-gray-600 dark:text-gray-400">{{ $repair->device_type }}</p>
                        </div>

                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Опис проблеми:</h4>
                            <p class="text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $repair->description }}</p>
                        </div>

                        @if($repair->scheduled_date)
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Бажана дата:</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $repair->scheduled_date->format('d.m.Y H:i') }}</p>
                            </div>
                        @endif

                        @if($repair->completed_at)
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Завершено:</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $repair->completed_at->format('d.m.Y H:i') }}</p>
                            </div>
                        @endif

                        @if(auth()->user()->role === 'client' && $repair->client_id === auth()->id())
                            <div class="flex space-x-2 mt-6">
                                @if($repair->canBeEditedBy(auth()->user()))
                                    <a href="{{ route('repairs.edit', $repair) }}"
                                       class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                        Редагувати
                                    </a>
                                @endif

                                @if($repair->canBeDeletedBy(auth()->user()))
                                    <form method="POST" action="{{ route('repairs.destroy', $repair) }}" onsubmit="return confirm('Ви впевнені?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Видалити
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                    @if($repair->status === 'completed' && !$repair->review && auth()->user()->role === 'client' && $repair->client_id === auth()->id())
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Залишити відгук</h3>
                            <form method="POST" action="{{ route('reviews.store', $repair) }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                        Оцінка
                                    </label>
                                    <div class="flex space-x-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="rating" value="{{ $i }}" required class="hidden peer">
                                                <span class="text-3xl peer-checked:text-yellow-400 text-gray-300 hover:text-yellow-300">★</span>
                                            </label>
                                        @endfor
                                    </div>
                                    @error('rating')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="comment" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                        Коментар
                                    </label>
                                    <textarea name="comment" id="comment" rows="4"
                                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                </div>

                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Відправити відгук
                                </button>
                            </form>
                        </div>
                    @endif

                    @if($repair->review)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Відгук клієнта</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="text-xl">{{ $i <= $repair->review->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $repair->review->rating }}/5</span>
                            </div>
                            @if($repair->review->comment)
                                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $repair->review->comment }}</p>
                            @endif
                            <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">
                                {{ $repair->review->created_at->format('d.m.Y H:i') }}
                            </p>
                        </div>
                    @endif

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Повідомлення</h3>

                        <div class="space-y-4 mb-6 max-h-96 overflow-y-auto">
                            @forelse($repair->messages as $message)
                                <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-xs lg:max-w-md">
                                        <div class="flex items-center mb-1 {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $message->sender->name }}
                                            </span>
                                        </div>
                                        <div class="px-4 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
                                            <p>{{ $message->message }}</p>
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

                        @if($repair->master_id && ($repair->client_id === auth()->id() || $repair->master_id === auth()->id()))
                            <form method="POST" action="{{ route('messages.store', $repair) }}">
                                @csrf
                                <div class="flex space-x-2">
                                    <textarea name="message" rows="2" required
                                              placeholder="Написати повідомлення..."
                                              class="flex-1 shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Відправити
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Клієнт</h3>
                        <div class="flex items-center mb-3">
                            <x-user-avatar :user="$repair->client" size="lg" />
                            <div class="ml-3">
                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $repair->client->name }}</p>
                                @if($repair->client->phone)
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $repair->client->phone }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($repair->master)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Майстер</h3>
                            <div class="flex items-center mb-3">
                                <x-user-avatar :user="$repair->master" size="lg" />
                                <div class="ml-3">
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $repair->master->name }}</p>
                                    @if($repair->master->specialization)
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $repair->master->specialization }}</p>
                                    @endif
                                </div>
                            </div>
                            @if($repair->master->phone)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">📞 {{ $repair->master->phone }}</p>
                            @endif
                            @if($repair->master->hourly_rate)
                                <p class="text-sm text-gray-600 dark:text-gray-400">💰 {{ $repair->master->hourly_rate }} грн/год</p>
                            @endif
                            <a href="{{ route('masters.show', $repair->master) }}"
                               class="block mt-3 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">
                                Переглянути профіль →
                            </a>
                        </div>
                    @endif

                    @if(auth()->user()->role === 'master' && $repair->status === 'new')
                        <form method="POST" action="{{ route('repairs.assign', $repair) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded">
                                Взяти в роботу
                            </button>
                        </form>
                    @endif

                    @if(auth()->user()->role === 'master' && $repair->master_id === auth()->id() && in_array($repair->status, ['assigned', 'in_progress']))
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Оновити статус</h3>
                            <form method="POST" action="{{ route('repairs.update-status', $repair) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status"
                                        class="w-full mb-3 shadow border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="assigned" {{ $repair->status === 'assigned' ? 'selected' : '' }}>Призначено</option>
                                    <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>В роботі</option>
                                    <option value="completed">Завершено</option>
                                </select>
                                <button type="submit"
                                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Оновити
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
