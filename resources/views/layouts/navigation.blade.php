<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                        Ремонт Сервіс
                    </a>
                </div>

                @auth
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                            Головна
                        </a>

                        @if(auth()->user()->role === 'client')
                            <a href="{{ route('repairs.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Мої заявки
                            </a>
                            <a href="{{ route('repairs.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Створити заявку
                            </a>
                            <a href="{{ route('masters.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Майстри
                            </a>
                        @endif

                        @if(auth()->user()->role === 'master')
                            <a href="{{ route('repairs.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Заявки
                            </a>
                            <a href="{{ route('reviews.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Відгуки
                            </a>
                        @endif

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('repairs.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Всі заявки
                            </a>
                            <a href="{{ route('masters.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Майстри
                            </a>
                            <a href="{{ route('reports.statistics') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                                Звіти
                            </a>
                        @endif

                        <a href="{{ route('notifications.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-gray-900">
                            Повідомлення
                        </a>
                    </div>
                @endauth
            </div>

            <div class="flex items-center">
                @auth
                    <div class="ml-3 relative">
                        <span class="text-gray-700 mr-4">{{ auth()->user()->name }}</span>
                        <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-gray-900 mr-4">
                            Профіль
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-gray-900">
                                Вийти
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 mr-4">Вхід</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">Реєстрація</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
