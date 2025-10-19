@extends('layouts.app')

@section('title', 'Створити заявку')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Створити заявку на ремонт</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="POST" action="{{ route('repairs.store') }}">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="device_type" class="block text-sm font-medium text-gray-700">Тип пристрою</label>
                        <input type="text" name="device_type" id="device_type" value="{{ old('device_type') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('device_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="device_brand" class="block text-sm font-medium text-gray-700">Бренд</label>
                        <input type="text" name="device_brand" id="device_brand" value="{{ old('device_brand') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('device_brand')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="device_model" class="block text-sm font-medium text-gray-700">Модель (необов'язково)</label>
                        <input type="text" name="device_model" id="device_model" value="{{ old('device_model') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('device_model')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="problem_description" class="block text-sm font-medium text-gray-700">Опис проблеми</label>
                        <textarea name="problem_description" id="problem_description" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('problem_description') }}</textarea>
                        @error('problem_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">Пріоритет</label>
                        <select name="priority" id="priority"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Низький</option>
                            <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }} selected>Середній</option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Високий</option>
                        </select>
                        @error('priority')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('repairs.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                        Скасувати
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Створити заявку
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
