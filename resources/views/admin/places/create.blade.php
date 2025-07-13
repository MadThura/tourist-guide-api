<x-layout>
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">
        {{ isset($place) ? "Edit Place" : "Create Place" }}
    </h1>

    <form method="POST"
        action="{{ isset($place) ? route('admin.places.update', $place) : route('admin.places.store') }}"
        enctype="multipart/form-data"
        class="bg-white dark:bg-gray-800 p-6 rounded shadow max-w-5xl space-y-6">
        @csrf
        @if(isset($place)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Left Column --}}
            <div class="space-y-4">
                <div>
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" name="name" value="{{ old('name', $place->name ?? '') }}"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" name="location" value="{{ old('location', $place->location ?? '') }}"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">
                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">Latitude</label>
                    <input type="text" name="latitude" value="{{ old('latitude', $place->latitude ?? '') }}"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">
                    @error('latitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">Longitude</label>
                    <input type="text" name="longitude" value="{{ old('longitude', $place->longitude ?? '') }}"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">
                    @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">Category</label>
                    <select name="category_id"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">
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
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">Main Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    @if(isset($place) && $place->image)
                    <div class="relative mt-3 w-fit">
                        <img src="{{ asset('storage/' . $place->image) }}" alt="Main Image"
                            class="max-h-32 rounded shadow">
                        <button type="submit" form="delete-main-image"
                            onclick="return confirm('Delete this main image?')"
                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700 shadow z-10">
                            ✕
                        </button>
                    </div>
                    @endif
                </div>

                <div>
                    <label class="block mb-1 text-gray-700 dark:text-gray-300">Additional Images</label>
                    <input type="file" name="images[]" accept="image/*" multiple
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">
                    @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    @if(isset($place) && $place->images)
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach($place->images as $img)
                        <div class="relative mr-0.5">
                            <img src="{{ asset('storage/' . $img->path) }}" class="max-h-24 rounded shadow">
                            <button type="submit" form="delete-image-{{ $img->id }}"
                                onclick="return confirm('Delete this image?')"
                                class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-700 shadow">
                                ✕
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 text-gray-700 dark:text-gray-300">Description</label>
                <textarea name="description" rows="5"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white p-2 rounded">{{ old('description', $place->description ?? '') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <button class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                {{ isset($place) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>

    {{-- DELETE FORMS OUTSIDE MAIN FORM --}}
    @if(isset($place) && $place->image)
    <form method="POST" action="{{ route('admin.places.image.destroy', $place) }}" id="delete-main-image" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endif

    @if(isset($place) && $place->images)
    @foreach($place->images as $img)
    <form method="POST" action="{{ route('admin.places.images.destroy', [$place, $img]) }}" id="delete-image-{{ $img->id }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endforeach
    @endif
</x-layout>
