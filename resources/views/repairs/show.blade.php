@extends('layouts.app')

@section('title', 'Деталі заявки')

@section('content')
    <div class="mb-8 animate-slide-down">
        <a href="{{ route('repairs.index') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium mb-4 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Назад до заявок
        </a>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Заявка #{{ $repair->id }}</h1>
                <p class="text-gray-600 dark:text-gray-400">Детальна інформація про заявку</p>
            </div>
            <span class="px-6 py-3 rounded-xl text-sm font-bold inline-flex items-center shadow-lg
            @if($repair->status === 'completed') bg-gradient-to-r from-green-500 to-green-600 text-white
            @elseif($repair->status === 'in_progress') bg-gradient-to-r from-blue-500 to-blue-600 text-white
            @elseif($repair->status === 'new') bg-gradient-to-r from-yellow-500 to-yellow-600 text-white
            @else bg-gradient-to-r from-gray-500 to-gray-600 text-white
            @endif">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ strtoupper($repair->status) }}
        </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Device Info Card -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-7 h-7 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Інформація про пристрій
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Тип пристрою</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $repair->device_type }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Бренд</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $repair->device_brand }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Модель</p>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $repair->device_model ?? 'Не вказано' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Пріоритет</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold
                            {{ $repair->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}
                            {{ $repair->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                            {{ $repair->priority === 'low' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}">
                            {{ ucfirst($repair->priority) }}
                        </span>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Опис проблеми</p>
                        <p class="text-gray-900 dark:text-white leading-relaxed">{{ $repair->problem_description }}</p>
                    </div>

                    @if($repair->estimated_cost || $repair->final_cost)
                        <div class="grid grid-cols-2 gap-4">
                            @if($repair->estimated_cost)
                                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border-2 border-blue-200 dark:border-blue-800">
                                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400 mb-1">Попередня вартість</p>
                                    <p class="text-2xl font-black text-blue-900 dark:text-blue-300">{{ number_format($repair->estimated_cost, 2) }} грн</p>
                                </div>
                            @endif
                            @if($repair->final_cost)
                                <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-xl border-2 border-green-200 dark:border-green-800">
                                    <p class="text-sm font-medium text-green-600 dark:text-green-400 mb-1">Фінальна вартість</p>
                                    <p class="text-2xl font-black text-green-900 dark:text-green-300">{{ number_format($repair->final_cost, 2) }} грн</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Створено</p>
                            <p class="text-gray-900 dark:text-white font-semibold">{{ $repair->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        @if($repair->completed_at)
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Завершено</p>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $repair->completed_at->format('d.m.Y H:i') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status History -->
            @if($repair->statuses && $repair->statuses->count() > 0)
                <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-7 h-7 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Історія статусів
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($repair->statuses as $status)
                                <div class="flex items-start group">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-base font-bold text-gray-900 dark:text-white">{{ $status->status }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $status->created_at->format('d.m.Y H:i') }}</p>
                                        </div>
                                        @if($status->comment)
                                            <p class="text-gray-700 dark:text-gray-300 text-sm">{{ $status->comment }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Participants Card -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Учасники
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-200 dark:border-blue-800">
                        <p class="text-sm font-semibold text-blue-600 dark:text-blue-400 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Клієнт
                        </p>
                        <p class="text-base font-bold text-gray-900 dark:text-white">{{ $repair->client->name }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $repair->client->email }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $repair->client->phone }}</p>
                    </div>

                    @if($repair->master)
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-xl border border-green-200 dark:border-green-800">
                            <p class="text-sm font-semibold text-green-600 dark:text-green-400 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Майстер
                            </p>
                            <p class="text-base font-bold text-gray-900 dark:text-white">{{ $repair->master->name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $repair->master->email }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $repair->master->phone }}</p>
                        </div>
                    @else
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-xl border border-yellow-200 dark:border-yellow-800 text-center">
                            <svg class="w-12 h-12 mx-auto text-yellow-500 dark:text-yellow-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Майстер ще не призначений</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            @if(auth()->user()->role === 'master' && !$repair->master_id && $repair->status === 'new')
                <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 shadow-2xl rounded-2xl p-6">
                    <form method="POST" action="{{ route('repairs.assign', $repair) }}">
                        @csrf
                        <button type="submit" class="w-full bg-white hover:bg-gray-100 text-green-700 dark:text-green-600 font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Взяти в роботу
                        </button>
                    </form>
                </div>
            @endif

            @if(auth()->user()->role === 'master' && $repair->master_id === auth()->id())
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Оновити статус</h3>
                    <form method="POST" action="{{ route('repairs.update-status', $repair) }}" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Статус</label>
                            <select name="status" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 transition-all">
                                <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>В роботі</option>
                                <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }}>Завершено</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Вартість (грн)</label>
                            <input type="number" name="final_cost" value="{{ $repair->final_cost }}" step="0.01" min="0"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 transition-all">
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                            Оновити
                        </button>
                    </form>
                </div>
            @endif

            @if(auth()->user()->role === 'admin')
                <div class="space-y-3">
                    <a href="{{ route('repairs.edit', $repair) }}" class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        Редагувати
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
