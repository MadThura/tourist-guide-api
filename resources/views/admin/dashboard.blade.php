<x-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white shadow rounded">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome, Admin 👋</h1>
        <p class="text-gray-600 mb-6">Here's a quick overview of what's happening in the system.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-4 bg-blue-100 rounded shadow">
                <h2 class="text-sm text-blue-600 uppercase font-semibold">Users</h2>
                <p class="text-2xl font-bold">1,245</p>
            </div>

            <div class="p-4 bg-green-100 rounded shadow">
                <h2 class="text-sm text-green-600 uppercase font-semibold">Support Tickets</h2>
                <p class="text-2xl font-bold">57</p>
            </div>

            <div class="p-4 bg-yellow-100 rounded shadow">
                <h2 class="text-sm text-yellow-600 uppercase font-semibold">Pending Reviews</h2>
                <p class="text-2xl font-bold">14</p>
            </div>

            <div class="p-4 bg-red-100 rounded shadow">
                <h2 class="text-sm text-red-600 uppercase font-semibold">System Alerts</h2>
                <p class="text-2xl font-bold">2</p>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-xl font-semibold mb-2">Quick Links</h3>
            <div class="space-x-3">
                <a href="{{ route('admin.places.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded">Manage Places</a>
                <a href="" class="inline-block bg-green-500 text-white px-4 py-2 rounded">Support Requests</a>
                <a href="#" class="inline-block bg-gray-700 text-white px-4 py-2 rounded">Settings</a>
            </div>
        </div>
    </div>
</x-layout>



   <!-- <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 shadow rounded">Total Users: 120</div>
        <div class="bg-white p-4 shadow rounded">New Orders: 45</div>
        <div class="bg-white p-4 shadow rounded">Revenue: $12,345</div>
    </div> -->
