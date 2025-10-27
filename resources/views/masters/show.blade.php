<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex items-center mb-6">
                <x-user-avatar :user="$master" size="3xl" />
                <div class="ml-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $master->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $master->specialization }}</p>

                    <div class="flex items-center mt-2">
                        @if($averageRating > 0)
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ number_format($averageRating, 1) }} ({{ $master->received_reviews_count }} відгуків)</span>
                            </div>
                        @else
                            <span class="text-gray-500 dark:text-gray-400">Немає відгуків</span>
                        @endif
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                        Виконано заявок: <span class="font-semibold">{{ $completedCount }}</span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Про майстра</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $master->bio ?? 'Інформація не вказана' }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Контактна інформація</h3>
                    <div class="space-y-2">
                        <p class="text-gray-600 dark:text-gray-400">
                            <span class="font-semibold">Email:</span> {{ $master->email }}
                        </p>
                        @if($master->phone)
                            <p class="text-gray-600 dark:text-gray-400">
                                <span class="font-semibold">Телефон:</span> {{ $master->phone }}
                            </p>
                        @endif
                        @if($master->hourly_rate)
                            <p class="text-gray-600 dark:text-gray-400">
                                <span class="font-semibold">Ставка:</span> {{ number_format($master->hourly_rate, 2) }} грн/год
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Відгуки клієнтів</h3>

                @if($master->receivedReviews->count() > 0)
                    <div class="space-y-4">
                        @foreach($master->receivedReviews as $review)
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <x-user-avatar :user="$review->client" size="sm" />
                                        <div class="ml-3">
                                            <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $review->client->name }}</p>
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $review->created_at->format('d.m.Y') }}</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $review->comment }}</p>
                                @if($review->repairRequest)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                        Заявка: <a href="{{ route('repairs.show', $review->repairRequest) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $review->repairRequest->title }}</a>
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Відгуків ще немає</p>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('masters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white font-bold rounded focus:outline-none focus:shadow-outline transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Назад до списку майстрів
                </a>
            </div>
        </div>
    </div>
</div>
