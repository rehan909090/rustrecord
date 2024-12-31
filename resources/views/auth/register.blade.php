<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-purple-500 to-blue-600 flex items-center justify-center min-h-screen">
<div class="bg-white p-2 rounded-lg shadow-lg w-full max-w-sm">
        <!-- Title -->
    <div class="bg-white p-2 rounded-lg shadow-md w-full max-w-sm">
    <div class="grid place-items-center">
    <img src="{{ asset('images/logobl.png') }}" alt="Logo" class="w-24 h-23 filter">
</div>

        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control" required>
        <option value="user" selected>User</option>
        <option value="admin">Admin</option>
    </select>
</div>


            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Register</button>
        </form>
        <div class="mt-4 text-center">
            <p>Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a></p>
        </div>
    </div>
</body>
</html>
