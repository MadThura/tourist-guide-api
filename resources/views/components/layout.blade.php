<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col h-screen bg-gray-100">

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