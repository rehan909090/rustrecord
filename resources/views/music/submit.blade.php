@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-semibold mb-6">Submit Your Music</h2>

        <!-- Success Message -->
        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Music Submit Form -->
        <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Song Title -->
            <div class="mb-4">
                <label for="song_title" class="block text-gray-700">Song Title:</label>
                <input type="text" name="song_title" id="song_title" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('song_title') }}" required>
            </div>

            <!-- Artist Name -->
            <div class="mb-4">
                <label for="artist_name" class="block text-gray-700">Artist Name:</label>
                <input type="text" name="artist_name" id="artist_name" class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('artist_name') }}" required>
            </div>

            <!-- Genre Selection -->
            <div class="mb-4">
                <label for="genre" class="block text-gray-700">Genre:</label>
                <select name="genre" id="genre" class="w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="" disabled selected>Select a genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Music File Upload -->
            <div class="mb-4">
                <label for="music_file" class="block text-gray-700">Music File:</label>
                <input type="file" name="music_file" id="music_file" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
                Submit Music
            </button>
        </form>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-md mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
