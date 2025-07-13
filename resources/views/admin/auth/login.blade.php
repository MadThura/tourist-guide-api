<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    @vite('resources/css/app.css') {{-- if using Vite --}}
</head>

<body class="bg-gray-900 text-gray-100 font-sans">
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded shadow shadow-black/50 mt-8">
        <h1 class="text-2xl font-bold mb-4 text-blue-400">Admin Login</h1>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-gray-100 focus:outline-none focus:border-blue-500" />
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-gray-100 focus:outline-none focus:border-blue-500" />
            </div>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full transition duration-200">
                Login
            </button>
        </form>

        <!--
        <p class="mt-4 text-sm text-center text-gray-400">
            Don't have an account?
            <a href="{{ route('admin.register') }}" class="text-blue-400 underline hover:text-blue-500">Register</a>
        </p>
        -->
    </div>
</body>

</html>