<x-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Category</h1>
        <a href="{{route('admin.categories.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Category</a>
    </div>
    <!-- Filter & Search -->
    <form method="GET" action="/admin/places" class="flex flex-wrap gap-2 mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search name..."
            class="p-2 border border-gray-300 rounded w-full md:w-auto flex-1" />
        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <table class="w-full table-auto bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">No.</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr class="border-t">
                <td class="p-3">{{ $category->id }}</td>
                <td class="p-3">{{ $category->name }}</td>
                <td class="p-3 space-x-2">
                    <a href="{{route('admin.categories.edit', $category)}}" class="text-blue-500">Edit</a>
                    <form action="{{route('admin.categories.destroy', $category)}}" method="POST" class="inline-block"
                        onsubmit="return confirm('Delete this place?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <td class="p-3 text-center text-gray-400">No such place!</td>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->appends(request()->query())->links() }}
    </div>
</x-layout>