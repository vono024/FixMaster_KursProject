@extends('layouts.app')

@section('title', 'Заявки на ремонт')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4 animate-slide-down">
        <div>
            <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Заявки на ремонт</h1>
            <p class="text-gray-600 dark:text-gray-400">Управління всіма заявками</p>
        </div>
        @if(auth()->user()->role === 'client')
            <a href="{{ route('repairs.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 dark:from-green-500 dark:to-green-600 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Створити заявку
            </a>
        @endif
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 mb-8 border border-gray-100 dark:border-gray-700">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Пошук</label>
                <div class="relative">
                    <input type="text" name="search" placeholder="Пошук за назвою, описом..." value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                    <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Статус</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                    <option value="">Всі статуси</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>Нові</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>В роботі</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Завершені</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Закриті</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Фільтрувати
                </button>
            </div>
        </form>
    </div>

    <!-- Repairs Grid -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($repairs as $repair)
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center flex-wrap gap-3 mb-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                                #{{ $repair->id }}
                            </span>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    {{ $repair->device_brand }} {{ $repair->device_model }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($repair->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif($repair->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($repair->status === 'new') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                @endif">
                                {{ $repair->status }}
                            </span>
                            </div>

                            <p class="text-gray-700 dark:text-gray-300 mb-4 line-clamp-2">
                                {{ $repair->problem_description }}
                            </p>

                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                                @if(auth()->user()->role !== 'client')
                                    <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $repair->client->name }}</span>
                                </span>
                                @endif

                                @if(auth()->user()->role !== 'master')
                                    <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $repair->master->name ?? 'Не призначено' }}</span>
                                </span>
                                @endif

                                <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span class="font-medium capitalize">{{ $repair->priority }}</span>
                            </span>

                                <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $repair->created_at->format('d.m.Y') }}</span>
                            </span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 lg:ml-6">
                            <a href="{{ route('repairs.show', $repair) }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Переглянути
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-12 text-center border border-gray-100 dark:border-gray-700">
                <svg class="mx-auto h-20 w-20 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-xl font-medium mb-4">Заявок не знайдено</p>
                @if(auth()->user()->role === 'client')
                    <a href="{{ route('repairs.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-200">
                        Створити першу заявку
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($repairs->hasPages())
        <div class="mt-8">
            {{ $repairs->links() }}
        </div>
    @endif
@endsection
