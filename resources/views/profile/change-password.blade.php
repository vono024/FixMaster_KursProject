<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Зміна пароля
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('profile.change-password') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="current_password" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Поточний пароль
                        </label>
                        <input type="password" name="current_password" id="current_password"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('current_password') border-red-500 @enderror">
                        @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Новий пароль
                        </label>
                        <input type="password" name="password" id="password"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Підтвердження нового пароля
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Змінити пароль
                        </button>
                        <a href="{{ route('profile.show') }}"
                           class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                            Скасувати
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
