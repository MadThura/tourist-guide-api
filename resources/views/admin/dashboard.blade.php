<x-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-900 shadow rounded">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Welcome, Admin 👋</h1>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Here's a quick overview of what's happening in the system.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="p-4 bg-blue-100 dark:bg-blue-900 rounded shadow">
                <h2 class="text-sm text-blue-600 dark:text-blue-400 uppercase font-semibold">Users</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $numOfUsers }}</p>
            </div>

            <div class="p-4 bg-green-100 dark:bg-green-900 rounded shadow">
                <h2 class="text-sm text-green-600 dark:text-green-400 uppercase font-semibold">Tourist Spots</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $numOfPlaces }}</p>
            </div>

            <div class="p-4 bg-green-100 dark:bg-green-900 rounded shadow">
                <h2 class="text-sm text-green-600 dark:text-green-400 uppercase font-semibold">Category</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{$numOfCategory}}</p>
            </div>

            <a href="{{route('admin.reviews.index').'?status=pending'}}"
                class="p-4 bg-yellow-100 dark:bg-yellow-900 rounded shadow block">
                <h2 class="text-sm text-yellow-600 dark:text-yellow-400 uppercase font-semibold">Pending Reviews</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{$numOfPendingReviews}}</p>
            </a>
        </div>

        <div class="mb-10">
            <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Quick Links</h3>
            <div class="space-x-3 flex flex-wrap gap-3">
                <a href="{{ route('admin.users.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Manage Users</a>
                <a href="{{ route('admin.places.index') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Manage Places</a>
                <a href="{{ route('admin.categories.index') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Manage Category</a>
                <a href="{{ route('admin.reviews.index') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Manage Reviews</a>
                <a href="#" class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">Settings</a>
            </div>
        </div>

        {{-- Top-Rated Places --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Top-Rated Places</h3>

            <div class="space-y-4">
                @forelse ($topPlaces as $place)
                @php
                $barWidth = min(($place->avg_rating ?? 0) * 20, 100);
                @endphp
                <div class="flex items-center">
                    <span class="w-40 truncate font-medium text-gray-700 dark:text-gray-300">{{ $place->name }}</span>
                    <div class="flex-1 mx-2 bg-gray-200 dark:bg-gray-700 h-4 rounded overflow-hidden">
                        <div class="bg-green-500 h-4 rounded" style="width: {{$barWidth}}%;"></div>
                    </div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $place->avg_rating ? number_format($place->avg_rating, 1) . '/5' : 'No rating' }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500 dark:text-gray-400">No ratings available yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>