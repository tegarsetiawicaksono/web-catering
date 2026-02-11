@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gradient-to-br from-orange-50 via-white to-orange-50 sm:py-12">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8 text-center sm:text-left">
            <div class="flex items-center justify-center mb-4 sm:justify-start">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-orange-500 to-orange-600">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Profil Saya</h1>
                    <p class="mt-1 text-sm text-gray-600">Kelola informasi profil dan keamanan akun Anda</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Update Profile Information -->
            <div class="transition-all duration-300 bg-white shadow-lg hover:shadow-xl rounded-xl">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="transition-all duration-300 bg-white shadow-lg hover:shadow-xl rounded-xl">
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
