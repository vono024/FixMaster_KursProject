<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Налаштування профілю майстра
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">
                        Заповніть інформацію про себе
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                        Ця інформація буде відображатися клієнтам. Будь ласка, заповніть всі поля.
                    </p>
                </div>

                <form method="POST" action="{{ route('master.update-profile') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="specialization" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Спеціалізація
                        </label>
                        <input type="text" name="specialization" id="specialization" value="{{ old('specialization') }}"
                               placeholder="Наприклад: Ремонт комп'ютерів та ноутбуків"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('specialization') border-red-500 @enderror">
                        @error('specialization')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bio" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Про себе (мінімум 50 символів)
                        </label>
                        <textarea name="bio" id="bio" rows="6"
                                  placeholder="Розкажіть про свій досвід, навички та чому клієнти повинні вибрати саме вас..."
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                        @error('bio')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="hourly_rate" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Ставка (грн/год)
                        </label>
                        <input type="number" step="0.01" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate') }}"
                               placeholder="150.00"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('hourly_rate') border-red-500 @enderror">
                        @error('hourly_rate')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="phone" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Телефон
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                               placeholder="+380501234567"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror">
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Зберегти та продовжити
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
