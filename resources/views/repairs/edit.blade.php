@extends('layouts.app')

@section('title', 'Редагувати заявку')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Редагувати заявку #{{ $repair->id }}</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form method="POST" action="{{ route('repairs.update', $repair) }}">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="device_type" class="block text-sm font-medium text-gray-700">Тип пристрою</label>
                        <input type="text" name="device_type" id="device_type" value="{{ old('device_type', $repair->device_type) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="device_brand" class="block text-sm font-medium text-gray-700">Бренд</label>
                        <input type="text" name="device_brand" id="device_brand" value="{{ old('device_brand', $repair->device_brand) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="device_model" class="block text-sm font-medium text-gray-700">Модель</label>
                        <input type="text" name="device_model" id="device_model" value="{{ old('device_model', $repair->device_model) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="problem_description" class="block text-sm font-medium text-gray-700">Опис проблеми</label>
                        <textarea name="problem_description" id="problem_description" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('problem_description', $repair->problem_description) }}</textarea>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Статус</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="new" {{ $repair->status === 'new' ? 'selected' : '' }}>Новий</option>
                            <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>В роботі</option>
                            <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }}>Завершено</option>
                            <option value="closed" {{ $repair->status === 'closed' ? 'selected' : '' }}>Закрито</option>
                        </select>
                    </div>

                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700">Пріоритет</label>
                        <select name="priority" id="priority"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="low" {{ $repair->priority === 'low' ? 'selected' : '' }}>Низький</option>
                            <option value="medium" {{ $repair->priority === 'medium' ? 'selected' : '' }}>Середній</option>
                            <option value="high" {{ $repair->priority === 'high' ? 'selected' : '' }}>Високий</option>
                        </select>
                    </div>

                    <div>
                        <label for="estimated_cost" class="block text-sm font-medium text-gray-700">Попередня вартість</label>
                        <input type="number" name="estimated_cost" id="estimated_cost" value="{{ old('estimated_cost', $repair->estimated_cost) }}" step="0.01"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="final_cost" class="block text-sm font-medium text-gray-700">Фінальна вартість</label>
                        <input type="number" name="final_cost" id="final_cost" value="{{ old('final_cost', $repair->final_cost) }}" step="0.01"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('repairs.show', $repair) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                        Скасувати
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Зберегти зміни
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
