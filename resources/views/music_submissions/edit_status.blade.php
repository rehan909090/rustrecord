@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-semibold mb-6">Edit Status Submission</h2>

        <!-- Menampilkan pesan sukses -->
        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Edit Status -->
        <form action="{{ route('music.submissions.update-status', $submission->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="status" class="block text-gray-700">Pilih Status:</label>
                <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="pending" disabled selected>{{ ucfirst($submission->status) }}</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
                Update Status
            </button>
        </form>
    </div>
@endsection
