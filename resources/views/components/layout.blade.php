<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="flex h-screen bg-gray-100">

    <x-sidebar />
    @if (session()->has('success'))
    <div
        class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 bg-green-500 text-white px-6 py-3 rounded shadow-lg"
        role="alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
        {{$slot}}
    </main>

</body>

</html>