<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Система управління ремонтами' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-slide-down {
            animation: slideDown 0.4s ease-out;
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-slate-900 text-gray-900 dark:text-gray-100">
@include('layouts.navigation')

@if (isset($header))
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
@endif

<main class="animate-fade-in">
    {{ $slot }}
</main>

<footer class="bg-white dark:bg-gray-800 border-t dark:border-gray-700 py-8 shadow-inner mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Про систему</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Платформа для швидкого та зручного пошуку майстрів з ремонту техніки. Ми об'єднуємо клієнтів та професіоналів для ефективного вирішення технічних проблем.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Контакти</h3>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li>Email: support@repair-system.com</li>
                    <li>Телефон: +380 (50) 123-45-67</li>
                    <li>Адреса: Київ, вул. Хрещатик, 1</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Корисні посилання</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Правила користування</a></li>
                    <li><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Політика конфіденційності</a></li>
                    <li><a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Питання та відповіді</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 text-center">
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                © {{ date('Y') }} Система управління ремонтами. Розроблено для курсової роботи з конструювання програмного забезпечення.
            </p>
        </div>
    </div>
</footer>

<script>
    window.addEventListener('storage', function(e) {
        if (e.key === 'theme') {
            if (e.newValue === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    });
</script>
</body>
</html>
