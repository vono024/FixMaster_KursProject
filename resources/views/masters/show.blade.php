<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Профіль майстра
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-center mb-4">
                            <img src="{{ $master->avatar_url }}" alt="{{ $master->name }}"
                                 class="w-32 h-32 rounded-full mx-auto mb-4">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $master->name }}</h3>
                            @if($master->specialization)
                                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $master->specialization }}</p>
                            @endif
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600 dark:text-gray-400">Рейтинг:</span>
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-xl mr-1">★</span>
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ number_format($averageRating, 1) }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600 dark:text-gray-400">Виконано робіт:</span>
                                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $completedCount }}</span>
                            </div>

                            @if($master->hourly_rate)
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-600 dark:text-gray-400">Ставка:</span>
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $master->hourly_rate }} грн/год</span>
                                </div>
                            @endif

                            @if($master->phone)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Телефон:</span>
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $master->phone }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    @if($master->bio)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Про майстра</h4>
                            <p class="text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $master->bio }}</p>
                        </div>
                    @endif

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Відгуки</h4>
                        @forelse($master->receivedReviews as $review)
                            <div class="border-b border-gray-200 dark:border-gray-700 py-4 last:border-b-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <img src="{{ $review->client->avatar_url }}" alt="{{ $review->client->name }}"
                                             class="w-10 h-10 rounded-full mr-3">
                                        <div>
                                            <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $review->client->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $review->created_at->format('d.m.Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->comment)
                                    <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4">Відгуків поки немає</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
