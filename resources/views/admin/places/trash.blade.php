<x-layout>
    <div class="max-w-6xl mx-auto p-6 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Trashed Places</h1>

        @if ($places->count())
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm text-left text-gray-700">
                <thead class="bg-gray-100 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Location</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Deleted At</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($places as $place)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $place->name }}</td>
                        <td class="px-4 py-2">{{ $place->location }}</td>
                        <td class="px-4 py-2">{{ $place->category->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $place->deleted_at->diffForHumans() }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <form method="POST" action="{{ route('admin.places.restore', $place->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">
                                    Restore
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.places.forceDelete', $place->id) }}" class="inline" onsubmit="return confirm('Permanently delete this place?')">
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
        <p class="text-gray-500">No trashed places found.</p>
        @endif
    </div>
</x-layout>