@extends('layouts.app')

@section('title', 'Редагувати заявку')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 animate-slide-down">
            <a href="{{ route('repairs.show', $repair) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium mb-4 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад до заявки
            </a>
            <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Редагувати заявку #{{ $repair->id }}</h1>
            <p class="text-gray-600 dark:text-gray-400">Оновіть інформацію про заявку</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-7 h-7 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Редагування заявки
                </h2>
            </div>

            <form method="POST" action="{{ route('repairs.update', $repair) }}" class="p-8">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <div>
                        <label for="device_type" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Тип пристрою <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="device_type" id="device_type" value="{{ old('device_type', $repair->device_type) }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                        @error('device_type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="device_brand" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Бренд <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="device_brand" id="device_brand" value="{{ old('device_brand', $repair->device_brand) }}" required
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                            @error('device_brand')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="device_model" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Модель
                            </label>
                            <input type="text" name="device_model" id="device_model" value="{{ old('device_model', $repair->device_model) }}"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                            @error('device_model')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="problem_description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Опис проблеми <span class="text-red-500">*</span>
                        </label>
                        <textarea name="problem_description" id="problem_description" rows="5" required
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200 resize-none">{{ old('problem_description', $repair->problem_description) }}</textarea>
                        @error('problem_description')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Статус
                            </label>
                            <select name="status" id="status"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                                <option value="new" {{ $repair->status === 'new' ? 'selected' : '' }}>Новий</option>
                                <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>В роботі</option>
                                <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }}>Завершено</option>
                                <option value="closed" {{ $repair->status === 'closed' ? 'selected' : '' }}>Закрито</option>
                            </select>
                            @error('status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="priority" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Пріоритет
                            </label>
                            <select name="priority" id="priority"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                                <option value="low" {{ $repair->priority === 'low' ? 'selected' : '' }}>Низький</option>
                                <option value="medium" {{ $repair->priority === 'medium' ? 'selected' : '' }}>Середній</option>
                                <option value="high" {{ $repair->priority === 'high' ? 'selected' : '' }}>Високий</option>
                            </select>
                            @error('priority')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="estimated_cost" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Попередня вартість (грн)
                            </label>
                            <input type="number" name="estimated_cost" id="estimated_cost" value="{{ old('estimated_cost', $repair->estimated_cost) }}" step="0.01" min="0"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                            @error('estimated_cost')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="final_cost" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Фінальна вартість (грн)
                            </label>
                            <input type="number" name="final_cost" id="final_cost" value="{{ old('final_cost', $repair->final_cost) }}" step="0.01" min="0"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                            @error('final_cost')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('repairs.show', $repair) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Скасувати
                    </a>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 dark:from-purple-500 dark:to-purple-600 hover:from-purple-700 hover:to-purple-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Зберегти зміни
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
