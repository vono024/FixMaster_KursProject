@extends('layouts.app')

@section('title', 'Панель майстра')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Панель майстра</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">В роботі</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $assignedRequests->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Нові заявки</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $newRequests->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Завершено сьогодні</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $completedToday }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Середній рейтинг</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($avgRating ?? 0, 1) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Мої поточні заявки</h3>
        </div>
        <div class="border-t border-gray-200">
            @forelse($assignedRequests as $request)
                <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-600">
                                {{ $request->device_brand }} {{ $request->device_model }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">{{ $request->problem_description }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                Клієнт: {{ $request->client->name }} | Телефон: {{ $request->client->phone }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('repairs.show', $request) }}" class="text-blue-600 hover:text-blue-900">
                                Переглянути
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-4 sm:px-6">
                    <p class="text-gray-500">Немає активних заявок</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Доступні заявки</h3>
        </div>
        <div class="border-t border-gray-200">
            @forelse($newRequests as $request)
                <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-600">
                                {{ $request->device_brand }} {{ $request->device_model }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">{{ $request->problem_description }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                Пріоритет: <span class="font-medium">{{ $request->priority }}</span>
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('repairs.show', $request) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                Взяти в роботу
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-4 sm:px-6">
                    <p class="text-gray-500">Немає доступних заявок</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
