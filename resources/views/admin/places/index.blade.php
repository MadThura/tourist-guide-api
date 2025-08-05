<x-layout>
    <!-- AlpineJS state -->
    <div x-data="{ showModal: false, selectedPlace: {} }">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tourist spots</h1>
            <a href="{{ route('admin.places.create') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Add new
            </a>
        </div>

        <!-- Filter & Search -->
        <form method="GET" action="/admin/places" class="flex flex-wrap gap-2 mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or location..."
                class="p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white rounded w-full md:w-auto flex-1" />

            <select name="category" onchange="this.form.submit()"
                class="p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white rounded">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="sort" onchange="this.form.submit()"
                class="p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white rounded">
                <option value="none" {{ request('sort') == 'none' ? 'selected' : '' }}>None</option>
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>

            <a href="{{ route('admin.places.index') }}"
                class="bg-gray-300 text-gray-700 px-5 py-2 rounded hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                Clear
            </a>
        </form>
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
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
                        <tr @click="showModal = true; selectedPlace = {{ $place->toJson() }}"
                            class="cursor-pointer border-t border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <td class="p-3">
                                <img src="{{ asset('storage/' . $place->image) }}" alt="Main Image"
                                    class="max-h-20 rounded shadow">
                            </td>
                            <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->name }}</td>
                            <td class="p-3 text-gray-700 dark:text-gray-300">
                                {{ Str::limit($place->description, 100) }}
                            </td>
                            <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->location }}</td>
                            <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->latitude }}</td>
                            <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->longitude }}</td>
                            <td class="p-3 text-gray-900 dark:text-gray-100">{{ $place->category->name }}</td>
                            <td class="p-3 space-x-2">
                                <a href="{{ route('admin.places.edit', $place) }}"
                                    class="text-blue-500 hover:underline dark:text-blue-400">Edit</a>
                                <form action="{{ route('admin.places.destroy', $place) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Delete this place?')">
                                    @csrf @method('DELETE')
                                    <button
                                        class="text-red-500 cursor-pointer hover:underline dark:text-red-400">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-3 text-center text-gray-400 dark:text-gray-500">No such place!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $places->appends(request()->query())->links() }}
        </div>

        <!-- Modal -->
        <div x-show="showModal" x-transition class="fixed inset-0 flex items-center justify-center z-50"
            style="backdrop-filter: blur(4px); background-color: rgba(0, 0, 0, 0.2);">
            <div @click.away="showModal = false"
                class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-6 rounded-lg shadow-lg w-full max-w-3xl relative max-h-[90vh] overflow-y-auto">

                <button @click="showModal = false"
                    class="absolute top-2 right-2 text-gray-500 hover:text-red-500 dark:text-gray-300 text-xl">
                    ✕
                </button>

                <!-- Main Image -->
                <h2 class="text-2xl font-bold mb-4" x-text="selectedPlace.name"></h2>
                <div class="aspect-w-3 aspect-h-2 rounded overflow-hidden border dark:border-gray-700 mb-4">
                    <img :src="'/storage/' + selectedPlace.image" alt="Main Image" class="w-full h-full object-cover" />
                </div>


                <!-- Gallery -->
                <template x-if="selectedPlace.images && selectedPlace.images.length">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Gallery</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            <template x-for="img in selectedPlace.images" :key="img.id">
                                <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded border dark:border-gray-700">
                                    <img :src="'/storage/' + img.path" alt="Additional Image"
                                        class="w-full h-full object-cover" />
                                </div>
                            </template>
                        </div>
                    </div>
                </template>


                <!-- Details -->
                <p class="mb-2">
                    <strong>Description:</strong><br>
                    <span x-html="selectedPlace.description.replace(/\n/g, '<br>')"></span>
                </p>
                <p class="mb-2"><strong>Location:</strong> <span x-text="selectedPlace.location"></span></p>
                <p class="mb-2"><strong>Latitude:</strong> <span x-text="selectedPlace.latitude"></span></p>
                <p class="mb-2"><strong>Longitude:</strong> <span x-text="selectedPlace.longitude"></span></p>
                <p class="mb-2"><strong>Category ID:</strong> <span x-text="selectedPlace.category.name"></span></p>

                <!-- Close Button -->
                <div class="mt-4 flex justify-between">
                    <a :href="`{{ url('admin/places') }}/${selectedPlace.id}/edit`"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Edit
                    </a>
                    <button @click="showModal = false" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Close
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-layout>
