<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Мої повідомлення
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($conversations as $repairId => $messages)
                        @php
                            $repair = $messages->first()->repairRequest;
                            $lastMessage = $messages->last();
                            $otherUser = $lastMessage->sender_id === auth()->id() ? $lastMessage->receiver : $lastMessage->sender;
                            $unreadCount = $messages->where('receiver_id', auth()->id())->where('is_read', false)->count();
                        @endphp
                        <a href="{{ route('messages.show', $repair) }}"
                           class="block border-b border-gray-200 dark:border-gray-700 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition last:border-b-0">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center flex-1">
                                    <img src="{{ $otherUser->avatar_url }}" alt="{{ $otherUser->name }}"
                                         class="w-12 h-12 rounded-full mr-4">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ $otherUser->name }}</h3>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $lastMessage->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">{{ $repair->title }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-500">{{ Str::limit($lastMessage->message, 50) }}</p>
                                    </div>
                                </div>
                                @if($unreadCount > 0)
                                    <span class="ml-4 bg-blue-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">Повідомлень поки немає</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
