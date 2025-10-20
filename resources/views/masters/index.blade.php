@extends('layouts.app')

@section('title', 'Наші майстри')

@section('content')
    <div class="mb-8 animate-slide-down">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Наші майстри</h1>
        <p class="text-gray-600 dark:text-gray-400">Професіонали своєї справи з високим рейтингом</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($masters as $master)
            <div class="group bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700 hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 h-32 relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-all duration-300"></div>
                    <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white text-4xl font-black shadow-2xl border-4 border-white dark:border-gray-800 group-hover:scale-110 transition-transform duration-300">
                            {{ substr($master->name, 0, 1) }}
                        </div>
                    </div>
                </div>

                <div class="pt-16 pb-6 px-6 text-center">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $master->name }}
                    </h3>

                    @if($master->masterProfile)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 font-medium">
                            {{ $master->masterProfile->specialization }}
                        </p>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-900 rounded-xl p-3">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Досвід
                            </span>
                                <span class="font-black text-gray-900 dark:text-white">{{ $master->masterProfile->experience_years }} років</span>
                            </div>

                            <div class="flex items-center justify-between bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 rounded-xl p-3 border border-yellow-200 dark:border-yellow-800">
                            <span class="text-sm font-semibold text-yellow-700 dark:text-yellow-400 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Рейтинг
                            </span>
                                <span class="font-black text-yellow-700 dark:text-yellow-400 text-lg">
                                {{ number_format($master->masterProfile->average_rating, 1) }} ⭐
                            </span>
                            </div>

                            <div class="flex items-center justify-between bg-gray-50 dark:bg-gray-900 rounded-xl p-3">
                            <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Робіт виконано
                            </span>
                                <span class="font-black text-gray-900 dark:text-white">{{ $master->masterProfile->total_repairs }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400 mb-6">
                        <p class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            {{ $master->email }}
                        </p>
                        <p class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ $master->phone }}
                        </p>
                    </div>

                    <a href="{{ route('masters.show', $master) }}" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-500 dark:to-purple-500 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        Детальніше →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-12 text-center border border-gray-100 dark:border-gray-700">
                <svg class="mx-auto h-20 w-20 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-500 dark:text-gray-400 text-xl font-medium">Майстрів не знайдено</p>
            </div>
        @endforelse
    </div>

    @if($masters->hasPages())
        <div class="mt-8">
            {{ $masters->links() }}
        </div>
    @endif
@endsection
