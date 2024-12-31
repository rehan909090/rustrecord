<!-- resources/views/profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-4">Edit Your Profile</h1>

        <!-- Display success message -->
        @if (session('status'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form to Edit Profile -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Bio -->
            <div class="mb-4">
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded">{{ old('bio', Auth::user()->bio) }}</textarea>
            </div>

            <!-- Profile Image -->
            <div class="mb-4">
                <label for="profile_image" class="block text-sm font-medium text-gray-700">Profile Image</label>
                <input type="file" id="profile_image" name="profile_image" class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save Changes</button>
            </div>
        </form>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
