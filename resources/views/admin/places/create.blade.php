<x-layout>
    <h1 class="text-2xl font-bold mb-4">{{ isset($place) ? "Edit Place" : "Create Place" }}</h1>
    <form method="POST"
        action="{{ isset($place) ? route('admin.places.update', $place) : route('admin.places.store') }}"
        class="space-y-4 bg-white p-6 rounded shadow max-w-xl">
        @csrf
        @if(isset($place)) @method('PUT') @endif

        <div>
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $place->name ?? '') }}"
                class="w-full border border-gray-300 p-2 rounded">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Description</label>
            <textarea name="description" class="w-full border border-gray-300 p-2 rounded"
                rows="4">{{ old('description', $place->description ?? '') }}</textarea>
        </div>

        <div>
            <label class="block mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location', $place->location ?? '') }}"
                class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Latitude</label>
            <input type="text" name="latitude" value="{{ $place->latitude ?? '' }}"
                class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Longitude</label>
            <input type="text" name="longitude" value="{{ $place->longitude ?? '' }}"
                class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Category</label>
            <select name="category_id" class="w-full border border-gray-300 p-2 rounded">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $place->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <button class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($place) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>

</x-layout>