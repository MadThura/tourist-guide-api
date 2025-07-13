<x-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Places</h1>
        <a href="{{route('admin.places.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Add Place
        </a>
    </div>

    <!-- Filter & Search -->
    <form method="GET" action="/admin/places" class="flex flex-wrap gap-2 mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search name or location..."
            class="p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white rounded w-full md:w-auto flex-1" />

        <select name="category"
            class="p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white rounded">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
            @endforeach
        </select>

        <select name="sort"
            class="p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white rounded">
            <option value="none" {{ request('sort') == 'none' ? 'selected' : '' }}>None</option>
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
        </select>

        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">Filter</button>

        <a href="{{ route('admin.places.index') }}"
            class="bg-gray-300 text-gray-700 px-5 py-2 rounded hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
            Clear
        </a>
    </form>

    <table class="w-full table-auto bg-white dark:bg-gray-800 rounded shadow">
        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase text-gray-700 dark:text-gray-300">
            <tr>
                <th class="p-3 text-left">Main Image</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-left">Latitude</th>
                <th class="p-3 text-left">Longitude</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($places as $place)
            <tr class="border-t border-gray-300 dark:border-gray-700">
                <td class="p-3">
                    <img src="{{ asset('storage/' . $place->image) }}" alt="Main Image" class="max-h-100 rounded shadow">
                </td>
                <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->name }}</td>
                <td class="relative group p-3 text-gray-700 dark:text-gray-300">
                    {{ strlen($place->description) > 100 ? substr($place->description, 0, 100) . '...' : $place->description }}
                    @if(strlen($place->description) > 100)
                    <div
                        class="absolute z-10 hidden group-hover:block w-100 bg-white dark:bg-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 p-2 rounded shadow-lg top-0 left-5 mt-1 whitespace-normal break-words">
                        {{ $place->description }}
                    </div>
                    @endif
                </td>
                <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->location }}</td>
                <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->latitude }}</td>
                <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->longitude }}</td>
                <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->category->name }}</td>
                <td class="p-3 space-x-2">
                    <a href="{{route('admin.places.edit', $place)}}" class="text-blue-500 hover:underline dark:text-blue-400">Edit</a>
                    <form action="{{route('admin.places.destroy', $place)}}" method="POST" class="inline-block"
                        onsubmit="return confirm('Delete this place?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 cursor-pointer hover:underline dark:text-red-400">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <td class="p-3 text-center text-gray-400 dark:text-gray-500" colspan="8">No such place!</td>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $places->appends(request()->query())->links() }}
    </div>
</x-layout>
