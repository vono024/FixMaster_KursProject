@extends('layouts.app')

@section('title', 'Залишити відгук')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Залишити відгук</h1>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">Заявка #{{ $repairRequest->id }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $repairRequest->device_brand }} {{ $repairRequest->device_model }}</p>
                <p class="text-sm text-gray-600">Майстер: {{ $repairRequest->master->name }}</p>
            </div>

            <form method="POST" action="{{ route('reviews.store', $repairRequest) }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Оцінка</label>
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" required class="hidden peer">
                                <span class="text-3xl peer-checked:text-yellow-500 text-gray-300 hover:text-yellow-400">⭐</span>
                            </label>
                        @endfor
                    </div>
                    @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Коментар</label>
                    <textarea name="comment" id="comment" rows="5" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Розкажіть про якість виконаної роботи...">{{ old('comment') }}</textarea>
                    @error('comment')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('repairs.show', $repairRequest) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                        Скасувати
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Залишити відгук
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
