<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Залишити відгук
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('reviews.store', $repair) }}">
                    @csrf

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Заявка: {{ $repair->title }}</h3>
                        <p class="text-gray-600">Майстер: {{ $repair->master->name }}</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Оцінка
                        </label>
                        <div class="flex space-x-3">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" required class="hidden peer">
                                    <span class="text-5xl peer-checked:text-yellow-400 text-gray-300 hover:text-yellow-300 transition">★</span>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">
                            Ваш відгук
                        </label>
                        <textarea name="comment" id="comment" rows="6"
                                  placeholder="Розкажіть про вашу роботу з майстром..."
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('comment') border-red-500 @enderror">{{ old('comment') }}</textarea>
                        @error('comment')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Відправити відгук
                        </button>
                        <a href="{{ route('repairs.show', $repair) }}"
                           class="text-gray-600 hover:text-gray-800">
                            Скасувати
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
