@extends('layouts.app')

@section('title', 'Повідомлення')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4 animate-slide-down">
        <div>
            <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Повідомлення</h1>
            <p class="text-gray-600 dark:text-gray-400">Всі ваші сповіщення</p>
        </div>

        @if($notifications->where('is_read', false)->count() > 0)
            <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                @csrf
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Позначити всі як прочитані
                </button>
            </form>
        @endif
    </div>

    <div class="space-y-4">
        @forelse($notifications as $notification)
            <div class="group bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-2xl transition-all duration-300 {{ !$notification->is_read ? 'ring-2 ring-blue-500 dark:ring-blue-400' : '' }}">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            @if(!$notification->is_read)
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg animate-pulse">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    @if(!$notification->is_read)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        НОВЕ
                                    </span>
                                    @endif
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                    {{ $notification->type }}
                                </span>
                                </div>
                            </div>

                            <p class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                {{ $notification->message }}
                            </p>

                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $notification->sent_at->diffForHumans() }}
                            </span>

                                @if($notification->repair_request_id)
                                    <a href="{{ route('repairs.show', $notification->repair_request_id) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                        Переглянути заявку
                                    </a>
                                @endif

                                @if(!$notification->is_read)
                                    <form method="POST" action="{{ route('notifications.mark-read', $notification) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Позначити як прочитане
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-12 text-center border border-gray-100 dark:border-gray-700">
                <svg class="mx-auto h-20 w-20 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-xl font-medium">Повідомлень немає</p>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    @endif
@endsection
