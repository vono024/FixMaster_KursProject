@extends('layouts.app')

@section('title', 'Історія ремонтів')

@section('content')
    <div class="mb-8 animate-slide-down">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Історія ремонтів</h1>
        <p class="text-gray-600 dark:text-gray-400">{{ $client->name }}</p>
    </div>

    <!-- Client Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium mb-1">Всього заявок</p>
                    <p class="text-4xl font-black text-white">{{ $repairs->count() }}</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium mb-1">Витрачено</p>
                    <p class="text-4xl font-black text-white">{{ number_format($totalSpent, 0) }} грн</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm font-medium mb-1">Email</p>
                    <p class="text-lg font-bold text-white truncate">{{ $client->email }}</p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Repairs Table -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Історія заявок
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Дата</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Пристрій</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Майстер</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Статус</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Вартість</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($repairs as $repair)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $repair->created_at->format('d.m.Y') }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $repair->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900 dark:text-white">
                                {{ $repair->device_brand }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $repair->device_model }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-medium">
                            {{ $repair->master->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $repair->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                {{ $repair->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                {{ $repair->status === 'new' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                {{ $repair->status === 'closed' ? 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200' : '' }}">
                                {{ $repair->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-white">
                            {{ $repair->final_cost ? number_format($repair->final_cost, 2) . ' грн' : '—' }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
