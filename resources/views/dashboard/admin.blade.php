@extends('layouts.app')

@section('title', 'Панель адміністратора')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Панель адміністратора</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Всього заявок</dt>
                    <dd class="text-lg font-medium text-gray-900">{{ $totalRequests }}</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Активні</dt>
                    <dd class="text-lg font-medium text-gray-900">{{ $activeRequests }}</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Завершені</dt>
                    <dd class="text-lg font-medium text-gray-900">{{ $completedRequests }}</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Майстрів</dt>
                    <dd class="text-lg font-medium text-gray-900">{{ $totalMasters }}</dd>
                </dl>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Клієнтів</dt>
                    <dd class="text-lg font-medium text-gray-900">{{ $totalClients }}</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Останні заявки</h3>
            <a href="{{ route('reports.statistics') }}" class="text-blue-600 hover:text-blue-900">
                Переглянути звіти
            </a>
        </div>
        <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Клієнт</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Пристрій</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Майстер</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дії</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($recentRequests as $request)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $request->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $request->client->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $request->device_brand }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $request->master->name ?? 'Не призначено' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $request->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $request->created_at->format('d.m.Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('repairs.show', $request) }}" class="text-blue-600 hover:text-blue-900">
                                Переглянути
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
