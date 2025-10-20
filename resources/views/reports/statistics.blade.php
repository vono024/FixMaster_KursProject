@extends('layouts.app')

@section('title', 'Статистика та звіти')

@section('content')
    <div class="mb-8 animate-slide-down">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Статистика та звіти</h1>
        <p class="text-gray-600 dark:text-gray-400">Аналітика роботи системи</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-white/80 text-sm font-medium mb-1">Всього заявок</p>
            <p class="text-5xl font-black text-white">{{ $totalRequests }}</p>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-white/80 text-sm font-medium mb-1">Завершено</p>
            <p class="text-5xl font-black text-white">{{ $completedRequests }}</p>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 dark:from-yellow-600 dark:to-yellow-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-white/80 text-sm font-medium mb-1">В роботі</p>
            <p class="text-5xl font-black text-white">{{ $inProgressRequests }}</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
            </div>
            <p class="text-white/80 text-sm font-medium mb-1">Нові</p>
            <p class="text-5xl font-black text-white">{{ $newRequests }}</p>
        </div>
    </div>

    <!-- Revenue & Performance -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center mb-4">
                <div class="bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl p-3 mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Загальний дохід</p>
                    <p class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($totalRevenue, 2) }} грн</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center mb-4">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl p-3 mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Середній час виконання</p>
                    <p class="text-3xl font-black text-gray-900 dark:text-white">{{ number_format($avgCompletionTime ?? 0, 1) }} год</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Masters -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                <svg class="w-7 h-7 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Топ майстрів за кількістю виконаних робіт
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Місце</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Майстер</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Виконано робіт</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Рейтинг</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($topMasters as $index => $master)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full font-black text-white
                                {{ $index === 0 ? 'bg-gradient-to-br from-yellow-400 to-yellow-500' : '' }}
                                {{ $index === 1 ? 'bg-gradient-to-br from-gray-400 to-gray-500' : '' }}
                                {{ $index === 2 ? 'bg-gradient-to-br from-orange-400 to-orange-500' : '' }}
                                {{ $index > 2 ? 'bg-gradient-to-br from-blue-400 to-blue-500' : '' }}">
                                {{ $index + 1 }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold mr-3">
                                    {{ substr($master->name, 0, 1) }}
                                </div>
                                <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $master->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-lg font-black text-gray-900 dark:text-white">{{ $master->completed_count }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-yellow-600 dark:text-yellow-400 mr-1">
                                    {{ number_format($master->masterProfile->average_rating ?? 0, 1) }}
                                </span>
                                <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
