@extends('layouts.app')

@section('title', 'Панель клієнта')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Панель клієнта</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Активні заявки</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $activeRequests->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Завершені</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $completedRequests ?? 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <a href="{{ route('repairs.create') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-2 px-4 rounded">
                    Створити нову заявку
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Активні заявки</h3>
        </div>
        <div class="border-t border-gray-200">
            @forelse($activeRequests as $request)
                <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-600">
                                {{ $request->device_brand }} {{ $request->device_model }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">{{ $request->problem_description }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                Статус: <span class="font-medium">{{ $request->status }}</span>
                                @if($request->master)
                                    | Майстер: {{ $request->master->name }}
                                @endif
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

    <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Останні заявки</h3>
        </div>
        <div class="border-t border-gray-200">
            @forelse($recentRequests ?? [] as $request)
                <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $request->device_type }}</p>
                            <p class="text-sm text-gray-500">{{ $request->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                        {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $request->status }}
                    </span>
                    </div>
                </div>
            @empty
                <div class="px-4 py-4 sm:px-6">
                    <p class="text-gray-500">Історія порожня</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
