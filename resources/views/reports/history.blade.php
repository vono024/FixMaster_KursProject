@extends('layouts.app')

@section('title', 'Історія ремонтів')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Історія ремонтів - {{ $client->name }}</h1>
    </div>

    <div class="mb-6 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Всього заявок</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $repairs->count() }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Витрачено</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalSpent, 2) }} грн</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-sm text-gray-900">{{ $client->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Пристрій</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Майстер</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Вартість</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($repairs as $repair)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $repair->created_at->format('d.m.Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $repair->device_brand }} {{ $repair->device_model }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $repair->master->name ?? 'Не призначено' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $repair->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $repair->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $repair->final_cost ? number_format($repair->final_cost, 2) . ' грн' : '-' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
