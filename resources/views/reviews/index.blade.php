@extends('layouts.app')

@section('title', 'Відгуки')

@section('content')
    <div class="mb-8 animate-slide-down">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Відгуки клієнтів</h1>
        <p class="text-gray-600 dark:text-gray-400">Що говорять наші клієнти про роботу майстрів</p>
    </div>

    <div class="space-y-6">
        @forelse($reviews as $review)
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-black text-2xl shadow-lg">
                                        {{ substr($review->client->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $review->client->name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">оцінив роботу майстра</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 mb-3">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-6 h-6 {{ $i < $review->rating ? 'text-yellow-500' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                        <span class="ml-2 text-lg font-bold text-gray-900 dark:text-white">{{ $review->rating }}.0</span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">{{ $review->comment }}</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium">Майстер:</span>
                                <a href="{{ route('masters.show', $review->master) }}" class="ml-1 text-blue-600 dark:text-blue-400 hover:underline">
                                    {{ $review->master->name }}
                                </a>
                            </span>
                                <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span class="font-medium">Заявка:</span>
                                <span class="ml-1">{{ $review->repairRequest->device_brand }} {{ $review->repairRequest->device_model }}</span>
                            </span>
                                <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $review->created_at->format('d.m.Y H:i') }}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-12 text-center border border-gray-100 dark:border-gray-700">
                <svg class="mx-auto h-20 w-20 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-xl font-medium">Відгуків поки немає</p>
            </div>
        @endforelse
    </div>

    @if($reviews->hasPages())
        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    @endif
@endsection
