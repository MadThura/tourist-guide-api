<x-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-900 shadow rounded">
        <div class="flex gap-5">
            <!-- <img class="h-16" src="{{asset('storage/'.$globalSetting->logo)}}" alt=""> -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Welcome, {{$displayName}}👋</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">Here's a quick overview of what's happening in the system.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Active Users -->
            <a href="{{ route('admin.users.index') . '?status=active' }}"
                class="p-4 bg-green-200 dark:bg-green-800 rounded shadow hover:shadow-md transition">
                <h2 class="text-sm text-green-700 dark:text-green-300 uppercase font-semibold"><i class="fa-solid fa-users mr-1"></i>Active Users</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numOfActiveUsers }}</p>
            </a>

            <!-- Suspended Users -->
            <a href="{{ route('admin.users.index') . '?status=suspended' }}"
                class="p-4 bg-red-200 dark:bg-red-800 rounded shadow hover:shadow-md transition">
                <h2 class="text-sm text-red-700 dark:text-red-300 uppercase font-semibold"><i class="fa-solid fa-users-slash mr-1"></i>Suspended Users</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numOfSusUsers }}</p>
            </a>

            <!-- Tourist Spots -->
            <div class="p-4 bg-sky-200 dark:bg-sky-800 rounded shadow hover:shadow-md transition">
                <h2 class="text-sm text-sky-700 dark:text-sky-300 uppercase font-semibold"><i class="fa-solid fa-location-dot mr-1"></i>Tourist Spots</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numOfPlaces }}</p>
            </div>

            <!-- Categories -->
            <div class="p-4 bg-indigo-200 dark:bg-indigo-800 rounded shadow hover:shadow-md transition">
                <h2 class="text-sm text-indigo-700 dark:text-indigo-300 uppercase font-semibold"><i class="fa-solid fa-list mr-1"></i>Categories</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numOfCategory }}</p>
            </div>

            <!-- Pending Reviews -->
            <a href="{{ route('admin.reviews.index') . '?status=pending' }}"
                class="p-4 bg-yellow-200 dark:bg-yellow-800 rounded shadow hover:shadow-md transition">
                <h2 class="text-sm text-yellow-700 dark:text-yellow-300 uppercase font-semibold"><i class="fa-solid fa-spinner mr-1"></i>Pending Reviews</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $numOfPendingReviews }}</p>
            </a>
        </div>

        <div class="mb-10">
            <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Quick Links</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.users.index') }}"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Manage Users</a>
                <a href="{{ route('admin.places.index') }}"
                    class="inline-block bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded">Manage Places</a>
                <a href="{{ route('admin.categories.index') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Manage Categories</a>
                <a href="{{ route('admin.reviews.index') }}"
                    class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Manage Reviews</a>
                <a href="{{ route('admin.settings.edit') }}"
                    class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">Settings</a>
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
                                📊 Total reviews: <span class="font-medium">{{ $place->reviews->count() }}</span>
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 text-sm font-semibold px-3 py-1 rounded">
                            {{$place->rating}}        
                        </span>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Rating</div>
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