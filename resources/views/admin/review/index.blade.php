<x-layout>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Reviews</h1>
    </div>
    <!-- Filter & Search -->
    <form method="GET" action="{{ route('admin.reviews.index') }}" class="mb-4 flex flex-col md:flex-row items-start md:items-center gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search by User name or place"
            class="border border-gray-300 rounded px-3 py-2 w-full md:w-1/3">

        <select name="rating" class="border border-gray-300 rounded px-3 py-2 w-full md:w-1/4">
            <option value="">All rating</option>
            <option value="good" {{ request('rating') === 'good' ? 'selected' : '' }}>Good</option>
            <option value="bad" {{ request('rating') === 'bad' ? 'selected' : '' }}>Bad</option>
        </select>

        <select name="status" class="border border-gray-300 rounded px-3 py-2 w-full md:w-1/4">
            <option value="">All status</option>
            @foreach (['pending', 'approved', 'rejected'] as $status)
            <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
            @endforeach
        </select>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600">
                Filter
            </button>

            <a href="{{ route('admin.reviews.index') }}" class="bg-gray-300 text-gray-700 px-5 py-2 rounded hover:bg-gray-400">
                Clear
            </a>
        </div>
    </form>

    <table class="w-full table-auto bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">No.</th>
                <th class="p-3 text-left">User name</th>
                <th class="p-3 text-left">Place name</th>
                <th class="p-3 text-left">Rating</th>
                <th class="p-3 text-left">Comment</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
            <tr class="border-t">
                <td class="p-3">{{ $review->id }}</td>
                <td class="p-3">{{ $review->user->name }}</td>
                <td class="p-3">{{ $review->place->name }}</td>
                <td class="p-3">{{ $review->rating }}</td>
                <td class="p-3">{{ $review->comment }}</td>
                <td class="p-3">
                    <span class="text-xs px-2 py-1 rounded 
        {{ $review->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($review->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($review->status) }}
                    </span>
                </td>
                <td class="px-4 py-6 space-x-4 flex justify-center">
                    @if ($review->status === 'pending' || $review->status === 'rejected')
                    <form method="POST" action="{{route('admin.reviews.approve', $review)}}" class="inline">
                        @csrf @method('PATCH')
                        <button class="bg-green-500 text-white px-3 py-1 rounded text-xs cursor-pointer">Approve</button>
                    </form>
                    @else
                    <form method="POST" action="{{route('admin.reviews.reject', $review)}}" class="inline">
                        @csrf @method('PATCH')
                        <button class="bg-red-500 text-white px-3 py-1 rounded text-xs cursor-pointer"
                            onclick="return confirm('Reject this review?')">Reject</button>
                    </form>
                    @endif
                    <form action="{{route('admin.reviews.destroy', $review)}}" method="POST" class="inline-block"
                        onsubmit="return confirm('Delete this review?')">
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
        {{ $reviews->appends(request()->query())->links() }}
    </div>
</x-layout>