<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css') {{-- if using Vite --}}
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center p-8 bg-white shadow rounded max-w-xl">
            <h1 class="text-4xl font-bold mb-4">Welcome to Our Platform</h1>
            <p class="text-gray-600 mb-6">
                We're glad you're here. Explore our services or log in to manage your account.
            </p>

            <div class="space-x-4">
                <a href="{{ route('admin.login') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Admin Login</a>
            </div>
        </div>
    </div>

</body>
</html>
