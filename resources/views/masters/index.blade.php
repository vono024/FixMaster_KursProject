@extends('layouts.app')

@section('title', 'Наші майстри')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Наші майстри</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($masters as $master)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold">
                                {{ substr($master->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-medium text-gray-900">{{ $master->name }}</h3>
                            @if($master->masterProfile)
                                <p class="text-sm text-gray-500">{{ $master->masterProfile->specialization }}</p>
                            @endif
                        </div>
                    </div>

                    @if($master->masterProfile)
                        <div class="mt-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Досвід:</span>
                                <span class="font-medium text-gray-900">{{ $master->masterProfile->experience_years }} років</span>
                            </div>
                            <div class="flex items-center justify-between text-sm mt-2">
                                <span class="text-gray-500">Рейтинг:</span>
                                <span class="font-medium text-gray-900">
                                {{ number_format($master->masterProfile->average_rating, 1) }} ⭐
                            </span>
                            </div>
                            <div class="flex items-center justify-between text-sm mt-2">
                                <span class="text-gray-500">Виконано робіт:</span>
                                <span class="font-medium text-gray-900">{{ $master->masterProfile->total_repairs }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <p class="text-sm text-gray-500">{{ $master->email }}</p>
                        <p class="text-sm text-gray-500">{{ $master->phone }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('masters.show', $master) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Детальніше
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3">
                <p class="text-center text-gray-500">Майстрів не знайдено</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $masters->links() }}
    </div>
@endsection
