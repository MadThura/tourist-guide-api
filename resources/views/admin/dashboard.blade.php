<x-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white shadow rounded">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome, Admin 👋</h1>
        <p class="text-gray-600 mb-6">Here's a quick overview of what's happening in the system.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="p-4 bg-blue-100 rounded shadow">
                <h2 class="text-sm text-blue-600 uppercase font-semibold">Users</h2>
                <p class="text-2xl font-bold">{{ $numOfUsers }}</p>
            </div>

            <div class="p-4 bg-green-100 rounded shadow">
                <h2 class="text-sm text-green-600 uppercase font-semibold">Tourist Spots</h2>
                <p class="text-2xl font-bold">{{ $numOfPlaces }}</p>
            </div>

            <div class="p-4 bg-green-100 rounded shadow">
                <h2 class="text-sm text-green-600 uppercase font-semibold">Category</h2>
                <p class="text-2xl font-bold">{{$numOfCategory}}</p>
            </div>

            <div class="p-4 bg-yellow-100 rounded shadow">
                <h2 class="text-sm text-yellow-600 uppercase font-semibold">Pending Reviews</h2>
                <p class="text-2xl font-bold">{{$numOfReviews}}</p>
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-xl font-semibold mb-2">Quick Links</h3>
            <div class="space-x-3">
                <a href="{{ route('admin.users.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded">Manage Users</a>
                <a href="{{ route('admin.places.index') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded">Manage Places</a>
                <a href="{{ route('admin.categories.index') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded">Manage Category</a>
                <a href="{{ route('admin.reviews.index') }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded">Manage Reviews</a>
                <a href="#" class="inline-block bg-gray-700 text-white px-4 py-2 rounded">Settings</a>
            </div>
        </div>

        {{-- Top-Rated Places --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Top-Rated Places</h3>

            <div class="space-y-4">
                @forelse ($topPlaces as $place)
                <div class="flex items-center">
                    <span class="w-40 truncate font-medium text-gray-700">{{ $place->name }}</span>
                    <div class="flex-1 mx-2 bg-gray-200 h-4 rounded">
                        <div class="bg-green-500 h-4 rounded" style="width: {{ $place->avg_rating * 20 }}%"></div>
                    </div>
                    <span class="text-sm text-gray-600">{{ number_format($place->avg_rating, 1) }}/5</span>
                </div>
                @empty
                <p class="text-gray-500">No ratings available yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>