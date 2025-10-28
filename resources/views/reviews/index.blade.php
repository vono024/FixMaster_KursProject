<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Всі відгуки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @forelse($reviews as $review)
                    <div class="border-b border-gray-200 dark:border-gray-700 py-4 last:border-b-0">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center">
                                <x-user-avatar :user="$review->client" size="lg" class="mr-4" />
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $review->client->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        про майстра <a href="{{ route('masters.show', $review->master) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $review->master->name }}</a>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">{{ $review->created_at->format('d.m.Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-xl">{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                        </div>
                        @if($review->comment)
                            <p class="text-gray-600 dark:text-gray-400 mt-2 ml-16">{{ $review->comment }}</p>
                        @endif
                        <a href="{{ route('repairs.show', $review->repairRequest) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline ml-16 mt-2 inline-block">
                            Переглянути заявку →
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">Відгуків поки немає</p>
                @endforelse
                @if($reviews->hasPages())
                    <div class="mt-6">
                        {{ $reviews->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
