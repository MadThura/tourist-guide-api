<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="flex h-screen bg-gray-100">

    <x-sidebar />
    <x-alert />

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
        {{$slot}}
    </main>

</body>

</html>