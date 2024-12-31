@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Music Submissions</h1>

        <!-- Menampilkan pesan sukses -->
        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ session('status') }}
            </div>
        @endif

        <!-- Tabel Daftar Music Submissions -->
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Judul Lagu</th>
                    <th class="py-3 px-6 text-left">Nama Artis</th>
                    <th class="py-3 px-6 text-left">Genre</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($musicSubmissions as $submission)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $submission->song_title }}</td>
                        <td class="py-3 px-6 text-left">{{ $submission->artist_name }}</td>
                        <td class="py-3 px-6 text-left">{{ $submission->genre->name ?? 'Tidak Ada Genre' }}</td>
                        <td class="py-3 px-6 text-left">
                            <span class="px-3 py-1 rounded-full 
                                {{ $submission->status === 'pending' ? 'bg-yellow-400 text-white' : 
                                   ($submission->status === 'approved' ? 'bg-green-500 text-white' : 'bg-red-500 text-white') }}">
                                {{ ucfirst($submission->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <!-- Edit Status -->
                            <a href="{{ route('music.submissions.edit-status', $submission->id) }}" class="text-yellow-500 hover:underline">Edit Status</a> |
                            <!-- Unduh File -->
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-500 hover:underline">Unduh File</a> |
                            <!-- Hapus Submission -->
                            <form action="{{ route('music.submissions.destroy', $submission->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus submission ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6">Belum ada music submissions</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
