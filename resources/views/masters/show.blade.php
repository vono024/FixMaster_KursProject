@extends('layouts.app')

@section('title', 'Майстер - ' . $master->name)

@section('content')
    <div class="mb-8 animate-slide-down">
        <a href="{{ route('masters.index') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium mb-4 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Назад до списку
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 sticky top-24">
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 h-32 relative">
                    <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-5xl font-black shadow-2xl border-4 border-white dark:border-gray-800">
                            {{ substr($master->name, 0, 1) }}
                        </div>
                    </div>
                </div>

                <div class="pt-20 pb-6 px-6">
                    <h2 class="text-3xl font-black text-center text-gray-900 dark:text-white mb-2">{{ $master->name }}</h2>

                    @if($master->masterProfile)
                        <p class="text-center text-gray-600 dark:text-gray-400 font-medium mb-6">{{ $master->masterProfile->specialization }}</p>

                        <div class="space-y-4 mb-6">
                            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-xl p-4 border-2 border-yellow-200 dark:border-yellow-800">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-bold text-yellow-700 dark:text-yellow-400">Рейтинг</span>
                                    <div class="flex items-center">
                                    <span class="text-3xl font-black text-yellow-600 dark:text-yellow-400 mr-2">
                                        {{ number_format($master->masterProfile->average_rating, 1) }}
                                    </span>
                                        <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-900 rounded-xl p-4">
                                <span class="text-gray-600 dark:text-gray-400 font-semibold">Досвід</span>
                                <span class="text-xl font-black text-gray-900 dark:text-white">{{ $master->masterProfile->experience_years }} років</span>
                            </div>

                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-900 rounded-xl p-4">
                                <span class="text-gray-600 dark:text-gray-400 font-semibold">Виконано робіт</span>
                                <span class="text-xl font-black text-gray-900 dark:text-white">{{ $completedRepairs }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6 space-y-3">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm">{{ $master->email }}</span>
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-sm">{{ $master->phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews & Stats -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Reviews Section -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-7 h-7 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        Відгуки клієнтів
                    </h3>
                </div>
                <div class="p-6">
                    @forelse($master->reviews as $review)
                        <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700 last:border-0 last:mb-0 last:pb-0 hover:bg-gray-50 dark:hover:bg-gray-900 p-4 rounded-xl transition-colors duration-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-black text-xl mr-3">
                                        {{ substr($review->client->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $review->client->name }}</p>
                                        <div class="flex items-center mt-1">
                                            @for($i = 0; $i < 5; $i++)
                                                <svg class="w-5 h-5 {{ $i < $review->rating ? 'text-yellow-500' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $review->created_at->format('d.m.Y') }}</span>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Відгуків поки немає</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Statistics -->
            @if($master->masterProfile)
                <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-7 h-7 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Статистика
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-2xl border border-blue-200 dark:border-blue-800">
                                <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 mb-2">Середній час</p>
                                <p class="text-3xl font-black text-blue-900 dark:text-blue-300">3-5 днів</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-2xl border border-green-200 dark:border-green-800">
                                <p class="text-sm font-semibold text-green-600 dark:text-green-400 mb-2">Завершено</p>
                                <p class="text-3xl font-black text-green-900 dark:text-green-300">{{ $completedRepairs }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
