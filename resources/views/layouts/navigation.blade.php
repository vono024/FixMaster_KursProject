<nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg shadow-xl sticky top-0 z-50 border-b-4 border-blue-500 dark:border-blue-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <div class="relative">
                        <svg class="w-10 h-10 text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-all duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-2xl font-black bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 dark:from-blue-400 dark:via-blue-500 dark:to-indigo-400 bg-clip-text text-transparent">
                        Ремонт Сервіс
                    </span>
                </a>

                @auth
                    <div class="hidden lg:ml-10 lg:flex lg:space-x-2">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                            Головна
                        </a>

                        @if(auth()->user()->role === 'client')
                            <a href="{{ route('repairs.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                Мої заявки
                            </a>
                            <a href="{{ route('repairs.create') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-green-500 hover:to-green-600 dark:hover:from-green-600 dark:hover:to-green-700 transition-all duration-200 transform hover:scale-105">
                                + Створити
                            </a>
                            <a href="{{ route('masters.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                Майстри
                            </a>
                        @endif

                        @if(auth()->user()->role === 'master')
                            <a href="{{ route('repairs.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                Заявки
                            </a>
                            <a href="{{ route('reviews.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                Відгуки
                            </a>
                        @endif

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('repairs.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                Заявки
                            </a>
                            <a href="{{ route('masters.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                Майстри
                            </a>
                            <a href="{{ route('reports.statistics') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-purple-500 hover:to-purple-600 dark:hover:from-purple-600 dark:hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                                Звіти
                            </a>
                        @endif

                        <a href="{{ route('notifications.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-600 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-200 transform hover:scale-105 relative">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                Повідомлення
                            </span>
                        </a>
                    </div>
                @endauth
            </div>

            <div class="flex items-center space-x-3">
                <!-- Theme Toggle -->
                <button onclick="toggleTheme()" class="p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                    <svg class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                @auth
                    <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded-full">
                        {{ auth()->user()->name }}
                    </span>
                    <a href="{{ route('profile.show') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-200 transform hover:scale-110">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200 transform hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 font-semibold transition-all duration-200">
                        Вхід
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 text-white font-semibold py-2 px-6 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        Реєстрація
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }
</script>
