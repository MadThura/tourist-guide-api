<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tourist Guide Application Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css') {{-- If you're using Vite --}}
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center bg-white p-10 shadow-lg rounded-lg max-w-lg w-full">
            <h1 class="text-3xl sm:text-4xl font-bold mb-4 text-blue-700">Tourist Guide Application Admin Panel</h1>
            <p class="text-gray-600 mb-6">
                Manage tourist spots, users, reviews, and more. Please log in to access the admin dashboard.
            </p>

            <div class="space-y-2 sm:space-x-4 sm:space-y-0">
                <a href="{{ route('admin.login') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    Admin Login
                </a>
                <!-- <a href="{{ route('admin.register') }}"
                    class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded shadow">
                    Register
                </a> -->
            </div>
        </div>
    </div>

</body>

</html>