<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    @if($globalSetting->logo)
    <link rel="icon" href="{{ asset('storage/' . $globalSetting->logo) }}" type="image/png">
    @endif

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])


</head>

<body class="flex flex-col h-screen bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <div class="flex flex-1">

        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Area -->
        <div id="mainContent"
            class="ml-80 transition-[margin-left] duration-500 ease-in-out flex-1 flex flex-col overflow-y-auto">

            <x-alert />

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

            <x-footer />
        </div>

    </div>

    <script src="https://kit.fontawesome.com/6c05f0a96c.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</body>

</html>