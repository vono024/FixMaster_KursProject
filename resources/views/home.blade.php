@extends('layouts.app')

@section('title', 'Головна')

@section('content')
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Система управління ремонтами побутової техніки</h1>
        <p class="text-xl text-gray-600">Швидко, надійно, професійно</p>
    </div>

    @guest
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Для клієнтів</h2>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Швидке створення заявок на ремонт</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Відстеження статусу ремонту</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Перегляд профілів майстрів та відгуків</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Сповіщення про зміни статусу</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded">
                    Зареєструватися як клієнт
                </a>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Для майстрів</h2>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Перегляд та прийняття заявок</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Оновлення статусу робіт</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Збір відгуків та рейтингу</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Статистика виконаних робіт</span>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded">
                    Зареєструватися як майстер
                </a>
            </div>
        </div>

        <div class="text-center">
            <p class="text-gray-600 mb-4">Вже маєте акаунт?</p>
            <a href="{{ route('login') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-8 rounded">
                Увійти
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Ваша роль</p>
                        <p class="text-lg font-semibold text-gray-900">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>

            @if(auth()->user()->role === 'client')
                <div class="bg-white shadow rounded-lg p-6">
                    <a href="{{ route('repairs.create') }}" class="flex items-center justify-center h-full text-blue-600 hover:text-blue-800">
                        <svg class="h-8 w-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium">Створити нову заявку</span>
                    </a>
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center h-full text-green-600 hover:text-green-800">
                    <svg class="h-8 w-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Перейти до панелі</span>
                </a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Швидкі посилання</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('repairs.index') }}" class="text-center p-4 border border-gray-200 rounded hover:bg-gray-50">
                    <span class="block text-gray-900 font-medium">Заявки</span>
                </a>
                <a href="{{ route('masters.index') }}" class="text-center p-4 border border-gray-200 rounded hover:bg-gray-50">
                    <span class="block text-gray-900 font-medium">Майстри</span>
                </a>
                <a href="{{ route('notifications.index') }}" class="text-center p-4 border border-gray-200 rounded hover:bg-gray-50">
                    <span class="block text-gray-900 font-medium">Повідомлення</span>
                </a>
                <a href="{{ route('profile.show') }}" class="text-center p-4 border border-gray-200 rounded hover:bg-gray-50">
                    <span class="block text-gray-900 font-medium">Профіль</span>
                </a>
            </div>
        </div>
    @endguest

    <div class="mt-12 bg-gray-50 rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 text-center">Чому обирають нас?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Швидко</h3>
                <p class="text-gray-600">Оперативна обробка заявок та призначення майстрів</p>
            </div>
            <div class="text-center">
                <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Надійно</h3>
                <p class="text-gray-600">Перевірені майстри з високим рейтингом</p>
            </div>
            <div class="text-center">
                <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Зручно</h3>
                <p class="text-gray-600">Контроль усіх етапів ремонту в одному місці</p>
            </div>
        </div>
    </div>
@endsection
