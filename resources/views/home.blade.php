@extends('layouts.app')

@section('title', 'Головна')

@section('content')
    <!-- Hero Section -->
    <div class="text-center mb-16 animate-scale-in">
        <h1 class="text-5xl md:text-6xl font-black text-gray-900 dark:text-white mb-6 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 dark:from-blue-400 dark:via-purple-400 dark:to-indigo-400 bg-clip-text text-transparent">
            Система управління ремонтами
        </h1>
        <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Швидко, надійно, професійно – ваш надійний партнер у сфері ремонту побутової техніки
        </p>
    </div>

    @guest
        <!-- Features Grid for Guests -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            <!-- Client Card -->
            <div class="group bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-8 hover:shadow-blue-500/20 dark:hover:shadow-blue-400/20 transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white ml-4">Для клієнтів</h2>
                </div>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Швидке створення заявок на ремонт</span>
                    </li>
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Відстеження статусу ремонту в реальному часі</span>
                    </li>
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Перегляд профілів майстрів та відгуків</span>
                    </li>
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Миттєві сповіщення про зміни статусу</span>
                    </li>
                </ul>

                <a href="{{ route('register') }}" class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    Зареєструватися як клієнт
                </a>
            </div>

            <!-- Master Card -->
            <div class="group bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-8 hover:shadow-green-500/20 dark:hover:shadow-green-400/20 transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white ml-4">Для майстрів</h2>
                </div>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Перегляд та прийняття заявок</span>
                    </li>
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Зручне оновлення статусу робіт</span>
                    </li>
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Збір відгуків та формування рейтингу</span>
                    </li>
                    <li class="flex items-start group/item">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-green-500 dark:text-green-400 group-hover/item:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700 dark:text-gray-300 font-medium">Детальна статистика виконаних робіт</span>
                    </li>
                </ul>

                <a href="{{ route('register') }}" class="block w-full text-center bg-gradient-to-r from-green-600 to-green-700 dark:from-green-500 dark:to-green-600 hover:from-green-700 hover:to-green-800 dark:hover:from-green-600 dark:hover:to-green-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    Зареєструватися як майстер
                </a>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 dark:from-blue-700 dark:via-purple-700 dark:to-indigo-700 rounded-3xl p-12 shadow-2xl">
            <p class="text-white text-xl font-semibold mb-6">Вже маєте акаунт?</p>
            <a href="{{ route('login') }}" class="inline-block bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 font-bold py-4 px-10 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-110">
                Увійти в систему
            </a>
        </div>
    @else
        <!-- Dashboard for Authenticated Users -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- User Info Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 shadow-2xl rounded-2xl p-6 text-white transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-xl p-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-white/80">Ваша роль</p>
                        <p class="text-2xl font-bold">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>

            @if(auth()->user()->role === 'client')
                <!-- Create Request Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 shadow-2xl rounded-2xl p-6 hover:shadow-green-500/50 dark:hover:shadow-green-400/50 transform hover:scale-105 transition-all duration-300">
                    <a href="{{ route('repairs.create') }}" class="flex items-center justify-center h-full text-white group">
                        <svg class="h-10 w-10 mr-3 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="text-xl font-bold">Створити нову заявку</span>
                    </a>
                </div>
            @endif

            <!-- Dashboard Link Card -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 shadow-2xl rounded-2xl p-6 hover:shadow-purple-500/50 dark:hover:shadow-purple-400/50 transform hover:scale-105 transition-all duration-300">
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center h-full text-white group">
                    <svg class="h-10 w-10 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xl font-bold">Перейти до панелі</span>
                </a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-8 border border-gray-100 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Швидкі посилання</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('repairs.index') }}" class="group text-center p-6 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-400 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-10 h-10 mx-auto mb-3 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="block text-gray-900 dark:text-white font-semibold group-hover:text-blue-600 dark:group-hover:text-blue-400">Заявки</span>
                </a>
                <a href="{{ route('masters.index') }}" class="group text-center p-6 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-400 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-10 h-10 mx-auto mb-3 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="block text-gray-900 dark:text-white font-semibold group-hover:text-blue-600 dark:group-hover:text-blue-400">Майстри</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="group text-center p-6 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-400 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-10 h-10 mx-auto mb-3 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="block text-gray-900 dark:text-white font-semibold group-hover:text-blue-600 dark:group-hover:text-blue-400">Повідомлення</span>
                </a>
                <a href="{{ route('profile.show') }}" class="group text-center p-6 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-400 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-10 h-10 mx-auto mb-3 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block text-gray-900 dark:text-white font-semibold group-hover:text-blue-600 dark:group-hover:text-blue-400">Профіль</span>
                </a>
            </div>
        </div>
    @endguest

    <!-- Why Choose Us Section -->
    <div class="mt-16 bg-white dark:bg-gray-800 rounded-3xl p-12 shadow-2xl border border-gray-100 dark:border-gray-700">
        <h2 class="text-4xl font-black text-center text-gray-900 dark:text-white mb-12">Чому обирають нас?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Швидко</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Оперативна обробка заявок та призначення майстрів протягом години</p>
            </div>
            <div class="text-center group">
                <div class="bg-gradient-to-br from-green-500 to-green-600 dark:from-green-600 dark:to-green-700 rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Надійно</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Перевірені майстри з високим рейтингом та реальними відгуками клієнтів</p>
            </div>
            <div class="text-center group">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Зручно</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">Контроль усіх етапів ремонту в одному місці з будь-якого пристрою</p>
            </div>
        </div>
    </div>
@endsection
