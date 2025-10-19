@extends('layouts.app')

@section('title', 'Статистика та звіти')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Статистика та звіти</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Всього заявок</dt>
                    <dd class="text-3xl font-bold text-gray-900">{{ $totalRequests }}</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Завершено</dt>
                    <dd class="text-3xl font-bold text-green-600">{{ $completedRequests }}</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">В роботі</dt>
                    <dd class="text-3xl font-bold text-blue-600">{{ $inProgressRequests }}</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Нові</dt>
                    <dd class="text-3xl font-bold text-yellow-600">{{ $newRequests }}</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Загальний дохід</dt>
                    <dd class="text-3xl font-bold text-gray-900">{{ number_format($totalRevenue, 2) }} грн</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Середній час виконання</dt>
                    <dd class="text-3xl font-bold text-gray-900">{{ number_format($avgCompletionTime ?? 0, 1) }} год</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Топ майстрів за кількістю виконаних робіт</h3>
        </div>
        <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Місце</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Майстер</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Виконано робіт</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Рейтинг</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($topMasters as $index => $master)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $master->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $master->completed_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($master->masterProfile->average_rating ?? 0, 1) }} ⭐
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
