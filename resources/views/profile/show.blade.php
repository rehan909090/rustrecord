<!-- resources/views/profile.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <!-- Profile Section -->
            <div class="flex items-center space-x-6">
                <!-- Profile Image -->
                <div class="w-32 h-32 rounded-full overflow-hidden">
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="w-full h-full object-cover">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-gray-600 mt-2">{{ $user->bio ?? 'No bio available' }}</p>
                    <p class="text-sm text-gray-500 mt-2">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Edit Profile Link -->
            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:text-blue-700 font-semibold">Edit Profile</a>
            </div>

            <!-- Other Profile Details -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-gray-800">Additional Information</h3>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Joined</span>
                        <span class="text-gray-600">{{ $user->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
