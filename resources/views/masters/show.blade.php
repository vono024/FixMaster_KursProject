@extends('layouts.app')

@section('title', 'Майстер - ' . $master->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('masters.index') }}" class="text-blue-600 hover:text-blue-900">← Назад до списку</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex justify-center mb-4">
                        <div class="h-24 w-24 rounded-full bg-blue-500 flex items-center justify-center text-white text-4xl font-bold">
                            {{ substr($master->name, 0, 1) }}
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-2">{{ $master->name }}</h2>

                    @if($master->masterProfile)
                        <p class="text-center text-gray-600 mb-4">{{ $master->masterProfile->specialization }}</p>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600">Рейтинг</span>
                                <span class="text-lg font-bold text-yellow-500">
                                {{ number_format($master->masterProfile->average_rating, 1) }} ⭐
                            </span>
                            </div>

                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600">Досвід</span>
                                <span class="font-medium">{{ $master->masterProfile->experience_years }} років</span>
                            </div>

                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600">Виконано робіт</span>
                                <span class="font-medium">{{ $completedRepairs }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <p class="text-sm text-gray-600 mb-2">
                            <span class="font-medium">Email:</span> {{ $master->email }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Телефон:</span> {{ $master->phone }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Відгуки клієнтів</h3>
                </div>
                <div class="border-t border-gray-200">
                    @forelse($master->reviews as $review)
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span class="font-medium text-gray-900">{{ $review->client->name }}</span>
                                        <span class="ml-3 text-yellow-500">
                                        @for($i = 0; $i < $review->rating; $i++)
                                                ⭐
                                            @endfor
                                    </span>
                                    </div>
                                    <p class="text-gray-700">{{ $review->comment }}</p>
                                    <p class="text-sm text-gray-500 mt-2">{{ $review->created_at->format('d.m.Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-5 sm:px-6">
                            <p class="text-gray-500">Відгуків поки немає</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($master->masterProfile)
                <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Статистика</h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded">
                                <p class="text-sm text-gray-500">Середній час виконання</p>
                                <p class="text-2xl font-bold text-gray-900">3-5 днів</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded">
                                <p class="text-sm text-gray-500">Успішно завершено</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $completedRepairs }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
