<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Music</title>
</head>
<body>
    <h1>Add New Music</h1>
    <form action="{{ route('music.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="artist">Artist:</label>
        <input type="text" name="artist" id="artist" required><br>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" id="genre" required><br>

        <label for="tempo">Tempo:</label>
        <input type="text" name="tempo" id="tempo" required><br>

        <label for="file_path">File Path:</label>
        <input type="text" name="file_path" id="file_path" required><br>

        <button type="submit">Save</button>
    </form>
    <a href="{{ route('music.index') }}">Back to Music List</a>
</body>
</html>
