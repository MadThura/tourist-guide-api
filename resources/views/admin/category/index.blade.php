<?php

use App\Models\Place;

?>
<x-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Category</h1>
        <a href="{{ route('admin.categories.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Add Category
        </a>
    </div>

    <!-- Filter & Search -->
    <form method="GET" action="/admin/places" class="flex flex-wrap gap-2 mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search name..."
            class="p-2 border border-gray-300 dark:border-gray-600 rounded w-full md:w-auto flex-1
                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
            Filter
        </button>
    </form>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="w-full table-auto bg-white dark:bg-gray-800 rounded shadow">
            <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <td class="p-3 text-left">Count</td>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <td class="p-3 text-gray-800 dark:text-gray-100">{{ $category->name }}</td>
                    <td class="p-3 text-gray-800 dark:text-gray-100"><?php $count = Place::where('category_id', $category->id)->count() ?>{{$count}}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-500 hover:underline">
                            Edit
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block"
                            onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-3 text-center text-gray-400 dark:text-gray-500">
                        No such category!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 text-gray-700 dark:text-gray-300">
        {{ $categories->appends(request()->query())->links() }}
    </div>
</x-layout>