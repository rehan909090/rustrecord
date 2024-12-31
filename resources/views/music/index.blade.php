<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music List</title>
</head>
<body>
    <h1>Music List</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Genre</th>
                <th>Tempo</th>
                <th>Play Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($musics as $music)
                <tr>
                    <td>{{ $music->title }}</td>
                    <td>{{ $music->artist }}</td>
                    <td>{{ $music->genre }}</td>
                    <td>{{ $music->tempo }}</td>
                    <td>{{ $music->play_count }}</td>
                    <td>
                        <!-- Add Play Button -->
                        <form action="{{ route('music.destroy', $music->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('music.create') }}">Add New Music</a>
</body>
</html>
