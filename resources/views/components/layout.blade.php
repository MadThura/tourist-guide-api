<!DOCTYPE html>
<html lang="en" class="{{ session('dark_mode', false) ? 'dark' : '' }}">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col h-screen bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Area -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            <!-- Alert or Notifications -->
            <x-alert />

            <!-- Main Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <x-footer />
        </div>
    </div>

</body>

</html>