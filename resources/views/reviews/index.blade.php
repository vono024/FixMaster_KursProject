@extends('layouts.app')

@section('title', 'Відгуки')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Відгуки клієнтів</h1>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        @forelse($reviews as $review)
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <span class="font-medium text-gray-900">{{ $review->client->name }}</span>
                            <span class="mx-2 text-gray-300">→</span>
                            <span class="text-gray-700">{{ $review->master->name }}</span>
                            <span class="ml-3 text-yellow-500">
                            @for($i = 0; $i < $review->rating; $i++)
                                    ⭐
                                @endfor
                        </span>
                        </div>

                        <p class="text-gray-700 mb-2">{{ $review->comment }}</p>

                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>Заявка #{{ $review->repairRequest->id }}</span>
                            <span>{{ $review->repairRequest->device_brand }} {{ $review->repairRequest->device_model }}</span>
                            <span>{{ $review->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="px-4 py-5 sm:px-6">
                <p class="text-gray-500">Відгуків поки немає</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $reviews->links() }}
    </div>
@endsection
