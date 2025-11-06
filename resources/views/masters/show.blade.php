<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Профіль майстра
            </h2>
            <a href="{{ route('masters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-8 sm:p-12">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start">
                        <div class="flex-shrink-0">
                            <x-user-avatar :user="$master" size="3xl" class="border-4 border-white shadow-2xl" />
                        </div>

                        <div class="mt-6 sm:mt-0 sm:ml-8 text-center sm:text-left flex-1">
                            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">{{ $master->name }}</h1>
                            <p class="text-xl text-blue-100 mb-4">{{ $master->specialization }}</p>

                            <div class="flex flex-col sm:flex-row items-center sm:items-center gap-4 sm:gap-8">
                                <div class="flex items-center bg-white/10 backdrop-blur rounded-lg px-4 py-2">
                                    @if($averageRating > 0)
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-6 h-6 {{ $i <= round($averageRating) ? 'text-yellow-300' : 'text-white/30' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                            <span class="ml-3 text-white text-xl font-bold">{{ number_format($averageRating, 1) }}</span>
                                        </div>
                                    @else
                                        <span class="text-white/70">Немає відгуків</span>
                                    @endif
                                </div>

                                <div class="flex gap-6">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-white">{{ $master->receivedReviews->count() }}</div>
                                        <div class="text-blue-100 text-sm">Відгуків</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-white">{{ $completedCount }}</div>
                                        <div class="text-blue-100 text-sm">Виконано</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-1 space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Контакти
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Email</p>
                                            <a href="mailto:{{ $master->email }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $master->email }}</a>
                                        </div>
                                    </div>
                                    @if($master->phone)
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Телефон</p>
                                                <a href="tel:{{ $master->phone }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $master->phone }}</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($master->hourly_rate)
                                <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg p-6 text-center border-2 border-green-200 dark:border-green-700">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Вартість послуг</p>
                                    <div class="flex items-baseline justify-center">
                                        <span class="text-4xl font-bold text-green-600 dark:text-green-400">{{ number_format($master->hourly_rate, 0) }}</span>
                                        <span class="text-lg text-gray-600 dark:text-gray-400 ml-2">грн/год</span>
                                    </div>
                                </div>
                            @endif

                            @if(auth()->check() && auth()->user()->role === 'client')
                                <a href="{{ route('repairs.create') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-6 rounded-lg transition shadow-lg hover:shadow-xl">
                                    Створити заявку
                                </a>
                            @endif
                        </div>

                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Про майстра
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $master->bio ?? 'Інформація не вказана' }}</p>
                            </div>

                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Відгуки клієнтів
                                </h3>

                                @if($master->receivedReviews->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($master->receivedReviews as $review)
                                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition p-6">
                                                <div class="flex items-start justify-between mb-4">
                                                    <div class="flex items-center">
                                                        <x-user-avatar :user="$review->client" size="md" />
                                                        <div class="ml-4">
                                                            <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $review->client->name }}</p>
                                                            <div class="flex items-center mt-1">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                    </svg>
                                                                @endfor
                                                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $review->rating }}/5</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $review->created_at->format('d.m.Y') }}</span>
                                                </div>
                                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $review->comment }}</p>
                                                @if($review->repairRequest)
                                                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            Заявка: <a href="{{ route('repairs.show', $review->repairRequest) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">{{ $review->repairRequest->title }}</a>
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                        <p class="mt-4 text-gray-500 dark:text-gray-400">Відгуків ще немає</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
