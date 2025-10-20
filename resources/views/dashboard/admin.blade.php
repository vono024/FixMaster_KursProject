@extends('layouts.app')

@section('title', 'Панель адміністратора')

@section('content')
    <div class="mb-8 animate-slide-down">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Панель адміністратора</h1>
        <p class="text-gray-600 dark:text-gray-400">Повний контроль над системою</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="text-center">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 inline-flex mb-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-white/80">Всього заявок</p>
                <p class="text-4xl font-black text-white mt-2">{{ $totalRequests }}</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 dark:from-yellow-600 dark:to-yellow-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="text-center">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 inline-flex mb-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-white/80">Активні</p>
                <p class="text-4xl font-black text-white mt-2">{{ $activeRequests }}</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="text-center">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 inline-flex mb-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-white/80">Завершені</p>
                <p class="text-4xl font-black text-white mt-2">{{ $completedRequests }}</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="text-center">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 inline-flex mb-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-white/80">Майстрів</p>
                <p class="text-4xl font-black text-white mt-2">{{ $totalMasters }}</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 dark:from-indigo-600 dark:to-indigo-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-300">
            <div class="text-center">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 inline-flex mb-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <p class="text-sm font-medium text-white/80">Клієнтів</p>
                <p class="text-4xl font-black text-white mt-2">{{ $totalClients }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Requests Table -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900 flex justify-between items-center">
            <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-white flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Останні заявки
            </h3>
            <a href="{{ route('reports.statistics') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 dark:from-purple-500 dark:to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Переглянути звіти
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Клієнт</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Пристрій</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Майстер</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Статус</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Дата</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Дії</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($recentRequests as $request)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                #{{ $request->id }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $request->client->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $request->client->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $request->device_brand }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $request->device_model }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $request->master->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $request->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                {{ $request->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                {{ $request->status === 'new' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                {{ $request->status === 'closed' ? 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200' : '' }}">
                                {{ $request->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $request->created_at->format('d.m.Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('repairs.show', $request) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium transition-colors">
                                Переглянути →
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
