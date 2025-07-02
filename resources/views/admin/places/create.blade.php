<x-layout>
    <h1 class="text-2xl font-bold mb-4">{{ isset($place) ? "Edit Place" : "Create Place" }}</h1>

    <form method="POST"
        action="{{ isset($place) ? route('admin.places.update', $place) : route('admin.places.store') }}"
        enctype="multipart/form-data"
        class="bg-white p-6 rounded shadow max-w-5xl space-y-6">
        @csrf
        @if(isset($place)) @method('PUT') @endif

        {{-- Two-Column Grid Layout --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Left Column --}}
            <div class="space-y-4">
                <div>
                    <label class="block mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $place->name ?? '') }}"
                        class="w-full border border-gray-300 p-2 rounded">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
            </div>

            {{-- Right Column --}}
            <div class="space-y-4">
                <div>
                    <label class="block mb-1">Main Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 p-2 rounded">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    @if(isset($place) && $place->image)
                    <div class="relative mt-2 w-fit">
                        <img src="{{ asset('storage/' . $place->image) }}" alt="Main Image"
                            class="max-h-32 rounded shadow">

                        <form method="POST" action="" onsubmit="return confirm('Delete this main image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700 shadow z-10">
                                ✕
                            </button>
                        </form>
                    </div>
                    @endif
                </div>

                <div>
                    <label class="block mb-1">Additional Images</label>
                    <input type="file" name="images[]" accept="image/*" multiple
                        class="w-full border border-gray-300 p-2 rounded">
                    @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    @if(isset($place) && $place->images)
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($place->images as $img)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $img->path) }}" class="max-h-24 rounded shadow">

                            <form method="POST" action="" class="absolute -top-2 -right-2"
                                onsubmit="return confirm('Delete this image?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-700 shadow">
                                    ✕
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- Description (Full Width) --}}
            <div class="md:col-span-2">
                <label class="block mb-1">Description</label>
                <textarea name="description" rows="5"
                    class="w-full border border-gray-300 p-2 rounded">{{ old('description', $place->description ?? '') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Submit Button --}}
        <div>
            <button class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                {{ isset($place) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</x-layout>