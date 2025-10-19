@extends('layouts.app')

@section('title', 'Деталі заявки')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Заявка #{{ $repair->id }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Інформація про заявку</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Статус</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($repair->status === 'completed') bg-green-100 text-green-800
                                @elseif($repair->status === 'in_progress') bg-blue-100 text-blue-800
                                @elseif($repair->status === 'new') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $repair->status }}
                            </span>
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Тип пристрою</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->device_type }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Бренд</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->device_brand }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Модель</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->device_model ?? 'Не вказано' }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Опис проблеми</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->problem_description }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Пріоритет</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->priority }}</dd>
                        </div>
                        @if($repair->estimated_cost)
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Попередня вартість</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->estimated_cost }} грн</dd>
                            </div>
                        @endif
                        @if($repair->final_cost)
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Фінальна вартість</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->final_cost }} грн</dd>
                            </div>
                        @endif
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Дата створення</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->created_at->format('d.m.Y H:i') }}</dd>
                        </div>
                        @if($repair->completed_at)
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Дата завершення</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $repair->completed_at->format('d.m.Y H:i') }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            @if($repair->statuses && $repair->statuses->count() > 0)
                <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Історія статусів</h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <ul class="divide-y divide-gray-200">
                            @foreach($repair->statuses as $status)
                                <li class="px-4 py-4">
                                    <div class="flex justify-between">
                                        <p class="text-sm font-medium text-gray-900">{{ $status->status }}</p>
                                        <p class="text-sm text-gray-500">{{ $status->created_at->format('d.m.Y H:i') }}</p>
                                    </div>
                                    @if($status->comment)
                                        <p class="mt-1 text-sm text-gray-600">{{ $status->comment }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Учасники</h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500">Клієнт</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $repair->client->name }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ $repair->client->email }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ $repair->client->phone }}</p>
                    </div>

                    @if($repair->master)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Майстер</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $repair->master->name }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $repair->master->email }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $repair->master->phone }}</p>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Майстер ще не призначений</p>
                    @endif
                </div>
            </div>

            @if(auth()->user()->role === 'master' && !$repair->master_id && $repair->status === 'new')
                <div class="mt-6 bg-white shadow sm:rounded-lg p-4">
                    <form method="POST" action="{{ route('repairs.assign', $repair) }}">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Взяти в роботу
                        </button>
                    </form>
                </div>
            @endif

            @if(auth()->user()->role === 'master' && $repair->master_id === auth()->id())
                <div class="mt-6 bg-white shadow sm:rounded-lg p-4">
                    <form method="POST" action="{{ route('repairs.update-status', $repair) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Змінити статус</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="in_progress" {{ $repair->status === 'in_progress' ? 'selected' : '' }}>В роботі</option>
                                <option value="completed" {{ $repair->status === 'completed' ? 'selected' : '' }}>Завершено</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="final_cost" class="block text-sm font-medium text-gray-700">Вартість ремонту</label>
                            <input type="number" name="final_cost" id="final_cost" value="{{ $repair->final_cost }}" step="0.01"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Оновити
                        </button>
                    </form>
                </div>
            @endif

            @if(auth()->user()->role === 'admin')
                <div class="mt-6 bg-white shadow sm:rounded-lg p-4">
                    <a href="{{ route('repairs.edit', $repair) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Редагувати
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
