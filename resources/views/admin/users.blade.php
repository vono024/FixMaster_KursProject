<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Управління користувачами
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('admin.users') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Пошук</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Ім'я, email або телефон"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Роль</label>
                            <select name="role" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Всі ролі</option>
                                <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Клієнти</option>
                                <option value="master" {{ request('role') == 'master' ? 'selected' : '' }}>Майстри</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Адміністратори</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Статус</label>
                            <select name="status" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Всі статуси</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Активні</option>
                                <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Заблоковані</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                Фільтрувати
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-gray-600 dark:text-gray-400">Знайдено користувачів: <span class="font-semibold">{{ $users->total() }}</span></p>
                    </div>

                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Користувач</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Роль</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Статистика</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Статус</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Дії</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <x-user-avatar :user="$user" size="md" class="mr-4" />
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                                    @if($user->phone)
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->phone }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    @if($user->role === 'admin') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                    @elseif($user->role === 'master') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @endif">
                                                    @if($user->role === 'admin') Адміністратор
                                                    @elseif($user->role === 'master') Майстер
                                                    @else Клієнт
                                                    @endif
                                                </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @if($user->role === 'client')
                                                {{ $user->repair_requests_count }} заявок
                                            @elseif($user->role === 'master')
                                                {{ $user->master_repairs_count }} робіт<br>
                                                {{ $user->received_reviews_count }} відгуків
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($user->isBlocked())
                                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                        Заблокований
                                                    </span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        Активний
                                                    </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($user->role !== 'admin')
                                                @if($user->isBlocked())
                                                    <form method="POST" action="{{ route('admin.users.unblock', $user) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" onclick="return confirm('Розблокувати користувача?')">
                                                            Розблокувати
                                                        </button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('admin.users.block', $user) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Заблокувати користувача?')">
                                                            Заблокувати
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">Користувачів не знайдено</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
