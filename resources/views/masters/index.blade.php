<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Майстри
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($masters as $master)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <x-user-avatar :user="$master" size="xl" />
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $master->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $master->specialization }}</p>
                            </div>
                        </div>

                        @if($master->bio)
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ Str::limit($master->bio, 100) }}</p>
                        @endif

                        <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-4">
                            <div class="flex items-center">
                                <span class="text-yellow-400 mr-1">★</span>
                                <span>{{ number_format($master->received_reviews_avg_rating ?? 0, 1) }}</span>
                            </div>
                            <span>{{ $master->completed_count ?? 0 }} робіт</span>
                            @if($master->hourly_rate)
                                <span>{{ $master->hourly_rate }} грн/год</span>
                            @endif
                        </div>

                        <a href="{{ route('masters.show', $master) }}"
                           class="block text-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Переглянути профіль
                        </a>
                    </div>
                @empty
                    <div class="col-span-full">
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">Майстрів поки немає</p>
                    </div>
                @endforelse
            </div>

            @if($masters->hasPages())
                <div class="mt-6">
                    {{ $masters->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
