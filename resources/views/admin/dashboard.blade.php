<x-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-900 shadow rounded">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Welcome, {{$displayName}}👋</h1>
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
                <a href="{{route('admin.settings.edit')}}" class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">Settings</a>
            </div>
        </div>

        {{-- Top-Rated Places --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Top-Rated Places</h3>

            <div class="space-y-4">
                @forelse($topPlaces as $place)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $place->name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                👍 Good: <span class="font-medium text-green-600">{{ $place->good_count }}</span> |
                                👎 Bad: <span class="font-medium text-red-500">{{ $place->bad_count }}</span> |
                                📊 Total: <span class="font-medium">{{ $place->total_count }}</span>
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 text-sm font-semibold px-3 py-1 rounded">
                                {{ round(($place->good_count / max($place->total_count, 1)) * 100, 1) }}%
                            </span>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Good Rating</div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 dark:text-gray-400">No ratings available yet.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-layout>