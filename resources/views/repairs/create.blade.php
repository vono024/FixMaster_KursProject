@extends('layouts.app')

@section('title', 'Створити заявку')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 animate-slide-down">
            <a href="{{ route('repairs.index') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium mb-4 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад до заявок
            </a>
            <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Створити заявку на ремонт</h1>
            <p class="text-gray-600 dark:text-gray-400">Заповніть форму нижче для створення заявки</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-7 h-7 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Інформація про пристрій
                </h2>
            </div>

            <form method="POST" action="{{ route('repairs.store') }}" class="p-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="device_type" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Тип пристрою <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="device_type" id="device_type" value="{{ old('device_type') }}" required
                               placeholder="Наприклад: Пральна машина, Холодильник..."
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                        @error('device_type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="device_brand" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Бренд <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="device_brand" id="device_brand" value="{{ old('device_brand') }}" required
                                   placeholder="Samsung, LG, Bosch..."
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                            @error('device_brand')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="device_model" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Модель (необов'язково)
                            </label>
                            <input type="text" name="device_model" id="device_model" value="{{ old('device_model') }}"
                                   placeholder="Наприклад: WW60J3263LW"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
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
                                  placeholder="Детально опишіть проблему з вашим пристроєм..."
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 resize-none">{{ old('problem_description') }}</textarea>
                        @error('problem_description')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Пріоритет
                        </label>
                        <select name="priority" id="priority"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Низький</option>
                            <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }} selected>Середній</option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Високий</option>
                        </select>
                        @error('priority')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('repairs.index') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Скасувати
                    </a>
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Створити заявку
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
