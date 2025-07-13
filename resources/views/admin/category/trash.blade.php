<x-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Trashed Categories</h1>

        @if ($categories->count())
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-100 dark:bg-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Deleted At</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $category->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                            {{ $category->deleted_at->diffForHumans() }}
                        </td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <form method="POST" action="{{ route('admin.categories.restore', $category->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">
                                    Restore
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.categories.forceDelete', $category->id) }}" class="inline" onsubmit="return confirm('Permanently delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
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
        <p class="text-gray-500 dark:text-gray-400">No trashed categories found.</p>
        @endif
    </div>
</x-layout>
