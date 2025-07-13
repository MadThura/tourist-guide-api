<x-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Trashed Reviews</h1>

        @if ($reviews->count())
        <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-gray-700 uppercase text-xs text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Place</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Deleted At</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($reviews as $review)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $review->user->name ?? '—' }}</td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $review->place->name ?? '—' }}</td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ ucfirst($review->rating) }}</td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ ucfirst($review->status) }}</td>
                        <td class="px-4 py-2 text-gray-500 dark:text-gray-400 text-sm">{{ $review->deleted_at->diffForHumans() }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <form method="POST" action="{{ route('admin.reviews.restore', $review->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                                    Restore
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.reviews.forceDelete', $review->id) }}" class="inline" onsubmit="return confirm('Permanently delete this review?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500 dark:text-gray-400">No trashed reviews found.</p>
        @endif
    </div>
</x-layout>