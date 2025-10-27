<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Наші майстри
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('masters.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Пошук
                            </label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Ім'я або спеціалізація"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Спеціалізація
                            </label>
                            <select name="specialization"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Всі спеціалізації</option>
                                @foreach($specializations as $spec)
                                    <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                                        {{ $spec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Макс. ставка (грн/год)
                            </label>
                            <input type="number" name="max_rate" value="{{ request('max_rate') }}"
                                   placeholder="Наприклад: 500"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Сортувати за
                            </label>
                            <select name="sort"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Рейтингом</option>
                                <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Кількістю відгуків</option>
                                <option value="completed" {{ request('sort') == 'completed' ? 'selected' : '' }}>Виконаними роботами</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Ціною (від низької)</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Ціною (від високої)</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Ім'ям</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                            Застосувати фільтри
                        </button>
                        <a href="{{ route('masters.index') }}"
                           class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 underline">
                            Скинути всі фільтри
                        </a>
                    </div>
                </form>
            </div>

            <div class="mb-6 text-gray-600 dark:text-gray-400">
                <p>Знайдено майстрів: <span class="font-semibold">{{ $masters->total() }}</span></p>
            </div>

            @if($masters->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-items-center mb-8">
                    @foreach($masters as $master)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col w-full max-w-sm">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                                <div class="flex flex-col items-center">
                                    <x-user-avatar :user="$master" size="2xl" class="border-4 border-white dark:border-gray-700" />
                                    <h3 class="mt-3 text-xl font-bold text-white text-center">{{ $master->name }}</h3>
                                    <p class="text-blue-100 text-sm">{{ $master->specialization }}</p>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center justify-center mb-4">
                                    @if($master->received_reviews_avg_rating > 0)
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= round($master->received_reviews_avg_rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                            <span class="ml-2 text-gray-600 dark:text-gray-400 font-semibold">
                                                {{ number_format($master->received_reviews_avg_rating, 1) }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400 text-sm">Немає відгуків</span>
                                    @endif
                                </div>

                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3 flex-1">
                                    {{ Str::limit($master->bio, 100) }}
                                </p>

                                <div class="grid grid-cols-2 gap-4 mb-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $master->received_reviews_count }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Відгуків</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $master->completed_count ?? 0 }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Виконано</p>
                                    </div>
                                </div>

                                @if($master->hourly_rate)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 mb-4">
                                        <p class="text-center">
                                            <span class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ number_format($master->hourly_rate, 0) }}</span>
                                            <span class="text-gray-600 dark:text-gray-400 text-sm">грн/год</span>
                                        </p>
                                    </div>
                                @endif

                                <a href="{{ route('masters.show', $master) }}"
                                   class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                    Переглянути профіль
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $masters->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Майстрів не знайдено</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Спробуйте змінити критерії пошуку</p>
                    <a href="{{ route('masters.index') }}"
                       class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition">
                        Скинути фільтри
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
