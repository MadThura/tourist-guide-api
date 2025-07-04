<x-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Places</h1>
        <a href="{{route('admin.places.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Place</a>
    </div>
    <!-- Filter & Search -->
    <form method="GET" action="/admin/places" class="flex flex-wrap gap-2 mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search name or location..."
            class="p-2 border border-gray-300 rounded w-full md:w-auto flex-1" />

        <select name="category" class="p-2 border border-gray-300 rounded">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
            @endforeach
        </select>

        <select name="sort" class="p-2 border border-gray-300 rounded">
            <option value="none" {{ request('sort') == 'none' ? 'selected' : '' }}>None</option>
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
        </select>

        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded">Filter</button>

        <a href="{{ route('admin.places.index') }}" class="bg-gray-300 text-gray-700 px-5 py-2 rounded hover:bg-gray-400">
            Clear
        </a>
    </form>

    <table class="w-full table-auto bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">No.</th>
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
            <tr class="border-t border-gray-300">
                <td class="p-3">{{ $place->id }}</td>
                <td class="p-3">
                    <img src="{{ asset('storage/' . $place->image) }}" alt="Main Image" class="max-h-200 rounded shadow">
                </td>
                <td class="p-3">{{ $place->name }}</td>
                <td class="relative group p-3">{{ strlen($place->description) > 100 ? substr($place->description, 0, 100) . '...' : $place->description }}
                    @if(strlen($place->description) > 100) 
                    <div class="absolute z-10 hidden group-hover:block w-100 bg-white text-black border border-gray-300 p-2 rounded shadow-lg top-0 left-5 mt-1">
                        {{ $place->description }}
                    </div>
                    @endif
                </td>
                <td class="p-3">{{ $place->location }}</td>
                <td class="p-3">{{ $place->latitude }}</td>
                <td class="p-3">{{ $place->longitude }}</td>
                <td class="p-3">{{ $place->category->name }}</td>
                <td class="p-3 space-x-2">
                    <a href="{{route('admin.places.edit', $place)}}" class="text-blue-500">Edit</a>
                    <form action="{{route('admin.places.destroy', $place)}}" method="POST" class="inline-block"
                        onsubmit="return confirm('Delete this place?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 cursor-pointer">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <td class="p-3 text-center text-gray-400">No such place!</td>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $places->appends(request()->query())->links() }}
    </div>
</x-layout>