<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css') {{-- if using Vite --}}
</head>

<body>
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-8">
        <h1 class="text-2xl font-bold mb-4">Admin Login</h1>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-2 border rounded">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required class="w-full p-2 border rounded">
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Login</button>
        </form>

        <!-- <p class="mt-4 text-sm text-center">
            Don't have an account?
            <a href="{{ route('admin.register') }}" class="text-blue-600 underline">Register</a>
        </p> -->
    </div>

</body>

</html>