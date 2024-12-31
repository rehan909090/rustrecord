<nav class="bg-gradient-to-r from-blue-400 to-purple-600 p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="{{ url('/dashboard') }}" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-13 h-12">
            <span class="text-white font-semibold text-xl">CATALYSM SOUND</span>
        </a>
        <div>

            <a href="{{ route('artists.index') }}" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Artist</a>
            <a href="{{ route('music.submissions') }}" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Music Submissions</a> 
            <a href="{{ route('concerts.index') }}" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Event</a>
            <a href="{{ route('music.submit') }}" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Submit Music</a>
            <a href="{{ route('profile.show') }}" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Profile</a>
      


            

            <!-- Logout Button as POST form -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Logout</button>
            </form>
        </div>
    </div>
</nav>
