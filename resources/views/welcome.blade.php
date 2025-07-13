<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Tourist Guide Application Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/css/app.css') {{-- If you're using Vite --}}
</head>

<body class="bg-gray-900 text-gray-100 font-sans">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center bg-gray-800 p-10 shadow-lg shadow-black/40 rounded-lg max-w-lg w-full">
            <h1 class="text-3xl sm:text-4xl font-bold mb-4 text-blue-400">
                Tourist Guide Application Admin Panel
            </h1>
            <p class="text-gray-300 mb-6">
                Manage tourist spots, users, reviews, and more. Please log in to access the admin dashboard.
            </p>

            <div class="space-y-2 sm:space-x-4 sm:space-y-0 flex justify-center">
                <a href="{{ route('admin.login') }}"
                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded shadow">
                    Admin Login
                </a>
                <!-- <a href="{{ route('admin.register') }}"
                    class="inline-block bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded shadow">
                    Register
                </a> -->
            </div>
        </div>
    </div>

</body>

</html>