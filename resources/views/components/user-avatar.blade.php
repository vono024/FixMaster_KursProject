@props(['user', 'size' => 'md'])

@php
    $sizeClasses = [
        'sm' => 'h-8 w-8 text-sm',
        'md' => 'h-10 w-10 text-lg',
        'lg' => 'h-12 w-12 text-xl',
        'xl' => 'h-16 w-16 text-2xl',
        '2xl' => 'h-24 w-24 text-4xl',
        '3xl' => 'h-32 w-32 text-5xl',
    ];
    $classes = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

@if($user->avatar_url)
    <img {{ $attributes->merge(['class' => $classes . ' rounded-full object-cover border-2 border-gray-200 dark:border-gray-600']) }}
         src="{{ $user->avatar_url }}"
         alt="{{ $user->name }}">
@else
    <div {{ $attributes->merge(['class' => $classes . ' rounded-full bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 flex items-center justify-center border-2 border-gray-200 dark:border-gray-600']) }}>
        <span class="text-white font-bold">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</span>
    </div>
@endif
