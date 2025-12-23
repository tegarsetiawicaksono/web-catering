@props(['title', 'subtitle', 'icon' => 'user'])

@php
$icons = [
'user' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
'calendar' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
'cash' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'
];
$iconPath = $icons[$icon] ?? $icons['user'];
@endphp

<div class="bg-gradient-to-r from-orange-500 via-orange-400 to-amber-500 px-8 py-6">
    <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl shadow-lg">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}" />
            </svg>
        </div>
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-white drop-shadow-md">{{ $title }}</h2>
            <p class="text-white/90 text-sm mt-1">{{ $subtitle }}</p>
        </div>
    </div>
</div>