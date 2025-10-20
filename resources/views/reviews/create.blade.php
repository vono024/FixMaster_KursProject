@extends('layouts.app')

@section('title', 'Залишити відгук')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 animate-slide-down">
            <a href="{{ route('repairs.show', $repairRequest) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium mb-4 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Назад до заявки
            </a>
            <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Залишити відгук</h1>
            <p class="text-gray-600 dark:text-gray-400">Оцініть якість виконаної роботи</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Заявка #{{ $repairRequest->id }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $repairRequest->device_brand }} {{ $repairRequest->device_model }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Майстер</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $repairRequest->master->name }}</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('reviews.store', $repairRequest) }}" class="p-8">
                @csrf

                <div class="space-y-8">
                    <div>
                        <label class="block text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Оцінка роботи <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center justify-center gap-4 py-6">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="rating" value="{{ $i }}" required class="hidden peer">
                                    <div class="transition-all duration-200 transform peer-checked:scale-125">
                                        <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 peer-checked:text-yellow-500 group-hover:text-yellow-400 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-center text-xs font-semibold text-gray-600 dark:text-gray-400 mt-2 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 peer-checked:text-yellow-600 dark:peer-checked:text-yellow-400 transition-colors">
                                        @if($i == 1) Погано
                                        @elseif($i == 2) Задовільно
                                        @elseif($i == 3) Добре
                                        @elseif($i == 4) Дуже добре
                                        @else Чудово
                                        @endif
                                    </p>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="comment" class="block text-lg font-bold text-gray-900 dark:text-white mb-4">
                            Ваш коментар <span class="text-red-500">*</span>
                        </label>
                        <textarea name="comment" id="comment" rows="6" required
                                  placeholder="Розкажіть про якість виконаної роботи, професіоналізм майстра, дотримання термінів..."
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200 resize-none">{{ old('comment') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Мінімум 10 символів</p>
                        @error('comment')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('repairs.show', $repairRequest) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Скасувати
                        </button>
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-500 dark:to-pink-500 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Залишити відгук
                        </button>
                </div>
            </form>
        </div>
    </div>
@endsection
