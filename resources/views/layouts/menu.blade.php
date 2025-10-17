@extends('layouts.app')

<x-slot>
<div class="min-h-screen bg-gray-50 pt-16">
    <!-- Header Section -->
    <div class="bg-[#86765a] text-white py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-4">{{ $title }}</h1>
            <p class="text-lg opacity-90">{{ $description }}</p>
        </div>
    </div>

    <!-- Menu Content -->
    <div class="container mx-auto px-4 py-12">
        {{ $slot }}
    </div>
</div>
</x-slot>