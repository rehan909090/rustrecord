<!-- resources/views/auth/forgot-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-purple-500 to-blue-600 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <!-- Title -->
        <div class="grid place-items-center">
            <img src="{{ asset('images/logobl.png') }}" alt="Logo" class="w-24 h-23 filter">
        </div>

        <!-- Status Message -->
        @if (session('status'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                {{ session('status') }}
            </div>
        @endif

        <!-- Error Message -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Forgot Password Form -->
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
                <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}" required autofocus>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Send Password Reset Link
            </button>
        </form>

        <!-- Back to Login Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Remembered your password? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a></p>
        </div>
    </div>

</body>
</html>
