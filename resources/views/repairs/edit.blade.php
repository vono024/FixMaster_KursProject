<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Редагувати заявку
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('repairs.update', $repair) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Назва заявки
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $repair->title) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror">
                        @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="device_type" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Тип пристрою
                        </label>
                        <textarea name="device_type" id="device_type" rows="2"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('device_type') border-red-500 @enderror">{{ old('device_type', $repair->device_type) }}</textarea>
                        @error('device_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Опис проблеми
                        </label>
                        <textarea name="description" id="description" rows="6"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror">{{ old('description', $repair->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="scheduled_date" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Бажана дата
                        </label>
                        <input type="datetime-local" name="scheduled_date" id="scheduled_date"
                               value="{{ old('scheduled_date', $repair->scheduled_date ? $repair->scheduled_date->format('Y-m-d\TH:i') : '') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('scheduled_date') border-red-500 @enderror">
                        @error('scheduled_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Зберегти зміни
                        </button>
                        <a href="{{ route('repairs.show', $repair) }}"
                           class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                            Скасувати
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
