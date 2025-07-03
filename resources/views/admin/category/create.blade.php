<x-layout>
    <h1 class="text-2xl font-bold mb-4">{{ isset($category) ? "Edit Category" : "Create Category" }}</h1>
    <form method="POST"
        action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
        class="space-y-4 bg-white p-6 rounded shadow max-w-xl">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        <div>
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                class="w-full border border-gray-300 p-2 rounded">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <button class="bg-green-500 text-white px-4 py-2 rounded">
                {{ isset($category) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>

</x-layout>