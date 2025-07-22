<x-layout>
    <div
        x-data="{ 
            showModal: false, 
            selectedReview: { id: null, comment: '' } 
        }">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Reviews</h1>
        </div>

        <!-- Filter & Search -->
        <form method="GET" action="{{ route('admin.reviews.index') }}" class="mb-4 flex flex-col md:flex-row items-start md:items-center gap-4">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by User name or place"
                class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full md:w-1/3 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">

            <select name="rating" class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full md:w-1/4 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                <option value="">All rating</option>
                <option value="good" {{ request('rating') === 'good' ? 'selected' : '' }}>Good</option>
                <option value="bad" {{ request('rating') === 'bad' ? 'selected' : '' }}>Bad</option>
            </select>

            <select name="status" class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full md:w-1/4 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                <option value="">All status</option>
                @foreach (['pending', 'approved', 'rejected'] as $status)
                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded">
                    Filter
                </button>

                <a href="{{ route('admin.reviews.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2 rounded dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    Clear
                </a>
            </div>
        </form>

        <!-- Reviews Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="w-full table-auto bg-white dark:bg-gray-800 rounded shadow">
                <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="p-3 text-left">User name</th>
                        <th class="p-3 text-left">Tourist spot</th>
                        <th class="p-3 text-left">Rating</th>
                        <th class="p-3 text-left">Comment</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr class="border-t border-gray-300 dark:border-gray-700">
                        <td class="p-3 text-gray-900 dark:text-gray-100">{{ $review->user->name }}</td>
                        <td class="p-3 text-gray-900 dark:text-gray-100">{{ $review->place->name }}</td>
                        <td class="p-3 text-gray-900 dark:text-gray-100">{{ $review->rating }}</td>
                        <td
                            @click="showModal = true; selectedReview = {{ $review->toJson() }}"
                            class="relative group p-3 text-gray-900 dark:text-gray-100 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            {{ strlen($review->comment) > 60 ? substr($review->comment, 0, 60) . ' .......' : $review->comment }}
                        </td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-1 rounded
                                {{ $review->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' : '' }}
                                {{ $review->status == 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : '' }}
                                {{ $review->status == 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' : '' }}">
                                {{ ucfirst($review->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-5 space-x-4 flex justify-center">
                            @if ($review->status === 'pending')
                            <form method="POST" action="{{ route('admin.reviews.approve', $review) }}" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs cursor-pointer">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.reviews.reject', $review) }}" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs cursor-pointer" onclick="return confirm('Reject this review?')">Reject</button>
                            </form>
                            @elseif ($review->status === 'approved')
                            <form method="POST" action="{{ route('admin.reviews.reject', $review) }}" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs cursor-pointer" onclick="return confirm('Reject this review?')">Reject</button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.reviews.approve', $review) }}" class="inline">
                                @csrf @method('PATCH')
                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs cursor-pointer">Approve</button>
                            </form>
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this review?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 dark:text-red-400 cursor-pointer">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="p-3 text-center text-gray-400 dark:text-gray-500" colspan="7">No reviews found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $reviews->appends(request()->query())->links() }}
        </div>

        <!-- Review Modal -->
        <div
            x-show="showModal"
            x-transition
            class="fixed inset-0 flex items-center justify-center z-50"
            style="backdrop-filter: blur(4px); background-color: rgba(0, 0, 0, 0.3);">

            <div
                @click.away="showModal = false"
                class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-6 rounded-xl shadow-2xl w-full max-w-xl relative max-h-[90vh] overflow-y-auto space-y-6">

                <!-- Review Content -->
                <div>
                    <h2 class="text-lg font-semibold mb-3 text-gray-800 dark:text-white">User Review</h2>
                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded text-gray-800 dark:text-gray-100 leading-relaxed">
                        <p x-text="selectedReview.comment"></p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-2 border-t border-gray-200 dark:border-gray-700">
                    <button
                        @click="showModal = false"
                        type="button"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>