<x-layout>
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">
        {{ isset($category) ? "Edit Category" : "Create Category" }}
    </h1>

    <form method="POST"
          action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
          class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded shadow max-w-xl">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-200">Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name ?? '') }}"
                class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            >
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                {{ isset($category) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</x-layout>
