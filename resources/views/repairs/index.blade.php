@extends('layouts.app')

@section('title', 'Заявки на ремонт')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Заявки на ремонт</h1>
        @if(auth()->user()->role === 'client')
            <a href="{{ route('repairs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Створити заявку
            </a>
        @endif
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <form method="GET" class="flex gap-4">
                <input type="text" name="search" placeholder="Пошук..." value="{{ request('search') }}"
                       class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Всі статуси</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>Нові</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>В роботі</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Завершені</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Закриті</option>
                </select>

                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    Фільтрувати
                </button>
            </form>
        </div>

        <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    @if(auth()->user()->role !== 'client')
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Клієнт</th>
                    @endif
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Пристрій</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Проблема</th>
                    @if(auth()->user()->role !== 'master')
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Майстер</th>
                    @endif
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Пріоритет</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дії</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($repairs as $repair)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $repair->id }}</td>
                        @if(auth()->user()->role !== 'client')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $repair->client->name }}</td>
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $repair->device_brand }} {{ $repair->device_model }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ Str::limit($repair->problem_description, 50) }}
                        </td>
                        @if(auth()->user()->role !== 'master')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $repair->master->name ?? 'Не призначено' }}
                            </td>
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($repair->status === 'completed') bg-green-100 text-green-800
                                @elseif($repair->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($repair->status === 'new') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $repair->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $repair->priority }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $repair->created_at->format('d.m.Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('repairs.show', $repair) }}" class="text-blue-600 hover:text-blue-900">
                                Переглянути
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            Заявок не знайдено
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 border-t border-gray-200">
            {{ $repairs->links() }}
        </div>
    </div>
@endsection
