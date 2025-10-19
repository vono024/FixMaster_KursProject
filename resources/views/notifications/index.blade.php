@extends('layouts.app')

@section('title', 'Повідомлення')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Повідомлення</h1>

        @if($notifications->where('is_read', false)->count() > 0)
            <form method="POST" action="{{ route('notifications.mark-all-read') }}">
                @csrf
                <button type="submit" class="text-blue-600 hover:text-blue-900">
                    Позначити всі як прочитані
                </button>
            </form>
        @endif
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        @forelse($notifications as $notification)
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }}">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            @if(!$notification->is_read)
                                <span class="h-2 w-2 bg-blue-600 rounded-full mr-2"></span>
                            @endif
                            <span class="text-sm font-medium text-gray-500">{{ $notification->type }}</span>
                        </div>

                        <p class="text-gray-900 mb-2">{{ $notification->message }}</p>

                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">{{ $notification->sent_at->format('d.m.Y H:i') }}</span>

                            @if($notification->repair_request_id)
                                <a href="{{ route('repairs.show', $notification->repair_request_id) }}" class="text-sm text-blue-600 hover:text-blue-900">
                                    Переглянути заявку
                                </a>
                            @endif
                        </div>
                    </div>

                    @if(!$notification->is_read)
                        <form method="POST" action="{{ route('notifications.mark-read', $notification) }}">
                            @csrf
                            <button type="submit" class="text-sm text-blue-600 hover:text-blue-900">
                                Прочитано
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="px-4 py-5 sm:px-6">
                <p class="text-gray-500">Повідомлень немає</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
@endsection
