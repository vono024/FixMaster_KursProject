@extends('layouts.app')

@section('title', 'Панель клієнта')

@section('content')
    <div class="mb-8 animate-slide-down">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Панель клієнта</h1>
        <p class="text-gray-600 dark:text-gray-400">Керуйте своїми заявками на ремонт</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 overflow-hidden shadow-2xl rounded-2xl transform hover:scale-105 transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-xl p-4">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-white/80 truncate">Активні заявки</dt>
                            <dd class="text-4xl font-black text-white">{{ $activeRequests->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-white/10 px-6 py-3">
                <a href="{{ route('repairs.index') }}" class="text-sm font-medium text-white hover:text-blue-100 transition-colors">
                    Переглянути всі →
                </a>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 overflow-hidden shadow-2xl rounded-2xl transform hover:scale-105 transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-xl p-4">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-white/80 truncate">Завершені</dt>
                            <dd class="text-4xl font-black text-white">{{ $completedRequests ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-white/10 px-6 py-3">
                <span class="text-sm font-medium text-white">Всього виконано</span>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 overflow-hidden shadow-2xl rounded-2xl transform hover:scale-105 transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-center h-full">
                    <a href="{{ route('repairs.create') }}" class="text-center group">
                        <svg class="h-16 w-16 text-white mx-auto mb-2 group-hover:scale-110 group-hover:rotate-90 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="text-white font-bold text-lg">Створити нову заявку</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Requests -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl mb-8 border border-gray-100 dark:border-gray-700">
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900">
            <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-white flex items-center">
                <svg class="w-7 h-7 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Активні заявки
            </h3>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($activeRequests as $request)
                <div class="px-6 py-5 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200 group">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center mb-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 mr-3">
                                #{{ $request->id }}
                            </span>
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors">
                                    {{ $request->device_brand }} {{ $request->device_model }}
                                </p>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 mb-2">{{ Str::limit($request->problem_description, 100) }}</p>
                            <div class="flex flex-wrap items-center gap-3 text-sm">
                            <span class="inline-flex items-center px-3 py-1 rounded-full font-medium
                                {{ $request->status === 'new' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                {{ $request->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                {{ $request->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}">
                                {{ $request->status }}
                            </span>
                                @if($request->master)
                                    <span class="text-gray-600 dark:text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $request->master->name }}
                                </span>
                                @endif
                                <span class="text-gray-500 dark:text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $request->created_at->diffForHumans() }}
                            </span>
                            </div>
                        </div>
                        <div class="ml-6">
                            <a href="{{ route('repairs.show', $request) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                Переглянути
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Немає активних заявок</p>
                    <a href="{{ route('repairs.create') }}" class="mt-4 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-200">
                        Створити першу заявку
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Requests -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-800 dark:to-gray-900">
            <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-white flex items-center">
                <svg class="w-7 h-7 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Останні заявки
            </h3>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($recentRequests ?? [] as $request)
                <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-1">
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $request->device_type }}</p>
                                <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $request->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                {{ $request->status }}
                            </span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $request->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        <a href="{{ route('repairs.show', $request) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                            Деталі →
                        </a>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center">
                    <p class="text-gray-500 dark:text-gray-400">Історія порожня</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
