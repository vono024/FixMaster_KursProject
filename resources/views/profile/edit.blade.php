@extends('layouts.app')

@section('title', 'Редагувати профіль')

@section('content')
    <div class="mb-8 animate-slide-down">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Мій профіль</h1>
        <p class="text-gray-600 dark:text-gray-400">Керуйте вашою інформацією</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Profile Info Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-7 h-7 mr-3 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Основна інформація
                </h3>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="p-6">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Ім'я <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Телефон
                        </label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                        @error('phone')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Роль</label>
                        <div class="px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700">
                            <p class="text-gray-900 dark:text-white font-semibold capitalize">{{ $user->role }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Зберегти зміни
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-7 h-7 mr-3 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Змінити пароль
                </h3>
            </div>

            <form method="POST" action="{{ route('profile.change-password') }}" class="p-6">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="current_password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Поточний пароль <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="current_password" id="current_password" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                        @error('current_password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Новий пароль <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Підтвердіть пароль <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-purple-500 dark:focus:border-purple-400 focus:ring-2 focus:ring-purple-500/20 transition-all duration-200">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 dark:from-purple-500 dark:to-purple-600 hover:from-purple-700 hover:to-purple-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Змінити пароль
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Master Profile (if applicable) -->
    @if($user->role === 'master' && $user->masterProfile)
        <div class="mt-8 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-900 dark:to-gray-800 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-7 h-7 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Профіль майстра
                </h3>
            </div>

            <form method="POST" action="{{ route('master.update-profile') }}" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="specialization" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Спеціалізація <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="specialization" id="specialization"
                               value="{{ old('specialization', $user->masterProfile->specialization) }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-2 focus:ring-green-500/20 transition-all duration-200">
                        @error('specialization')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="experience_years" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Років досвіду <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="experience_years" id="experience_years"
                               value="{{ old('experience_years', $user->masterProfile->experience_years) }}" required min="0"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:border-green-500 dark:focus:border-green-400 focus:ring-2 focus:ring-green-500/20 transition-all duration-200">
                        @error('experience_years')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 dark:from-green-500 dark:to-green-600 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Оновити профіль майстра
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection
