<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Налаштування профілю
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Фото профілю
                        </label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img class="h-24 w-24 object-cover rounded-full"
                                     src="{{ $user->avatar_url }}"
                                     alt="Аватар">
                            </div>
                            <div>
                                <input type="file" name="avatar" id="avatar" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-300">
                                @if($user->avatar)
                                    <form method="POST" action="{{ route('profile.delete-avatar') }}" class="mt-2" onsubmit="return confirm('Видалити фото?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 text-sm hover:text-red-800 dark:hover:text-red-300">
                                            Видалити фото
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @error('avatar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Ім'я
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Телефон
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror">
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($user->role === 'master')
                        <div class="mb-4">
                            <label for="specialization" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                Спеціалізація
                            </label>
                            <input type="text" name="specialization" id="specialization" value="{{ old('specialization', $user->specialization) }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('specialization') border-red-500 @enderror">
                            @error('specialization')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                Про себе
                            </label>
                            <textarea name="bio" id="bio" rows="4"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('bio') border-red-500 @enderror">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="hourly_rate" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                Ставка (грн/год)
                            </label>
                            <input type="number" step="0.01" name="hourly_rate" id="hourly_rate" value="{{ old('hourly_rate', $user->hourly_rate) }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline @error('hourly_rate') border-red-500 @enderror">
                            @error('hourly_rate')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Зберегти зміни
                        </button>
                        <a href="{{ route('profile.change-password-form') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Змінити пароль
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
