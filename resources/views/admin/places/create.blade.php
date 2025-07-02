<x-layout>
    <h1 class="text-2xl font-bold mb-4">{{ isset($place) ? "Edit Place" : "Create Place" }}</h1>
    <form method="POST"
        action="{{ isset($place) ? route('admin.places.update', $place) : route('admin.places.store') }}"
        enctype="multipart/form-data" {{-- IMPORTANT for file uploads --}}
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
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Single Image Upload --}}
        <div>
            <label class="block mb-1">Main Image</label>
            <input type="file" name="image" accept="image/*" class="w-50 border border-gray-300 p-1">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if(isset($place) && $place->image)
            <img src="{{asset('storage/' . $place->image)}}" alt="Main Image" class="mt-2 max-h-40">
            @endif
        </div>

        {{-- Multiple Images Upload --}}
        <div>
            <label class="block mb-1">Additional Images</label>
            <input type="file" name="images[]" accept="image/*" multiple class="w-55 border border-gray-300 p-1">
            @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            {{-- Optionally show existing additional images --}}
            @if(isset($place) && $place->images)
            <div class="flex flex-wrap gap-2 mt-2">
                @foreach($place->images as $img)
                <img src="{{ asset('storage/' . $img->path) }}" alt="Image" class="max-h-24 rounded">
                @endforeach
                <!-- <img src="https://cdn.pixabay.com/photo/2024/05/26/10/15/bird-8788491_1280.jpg" alt="Main Image" class="mt-2 max-h-40">
                <img src="https://cdn.pixabay.com/photo/2024/05/26/10/15/bird-8788491_1280.jpg" alt="Main Image" class="mt-2 max-h-40"> -->
            </div>
            @endif
        </div>

        <div>
            <label class="block mb-1">Location</label>
            <input type="text" name="location" value="{{ old('location', $place->location ?? '') }}"
                class="w-full border border-gray-300 p-2 rounded">
            @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Latitude</label>
            <input type="text" name="latitude" value="{{ old('latitude', $place->latitude ?? '') }}"
                class="w-full border border-gray-300 p-2 rounded">
            @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Longitude</label>
            <input type="text" name="longitude" value="{{ old('longitude', $place->longitude ?? '') }}"
                class="w-full border border-gray-300 p-2 rounded">
            @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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