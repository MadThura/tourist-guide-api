<x-layout>
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">User Management</h1>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 flex flex-col md:flex-row items-start md:items-center gap-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Search by name or email"
            class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full md:w-1/3 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">

        <select name="role" class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full md:w-1/4 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
            <option value="">All Roles</option>
            @foreach (['admin', 'moderator', 'user'] as $role)
            <option value="{{ $role }}" {{ request('role') === $role ? 'selected' : '' }}>
                {{ ucfirst($role) }}
            </option>
            @endforeach
        </select>

        <select name="status" class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 w-full md:w-1/4 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded">
            Filter
        </button>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-5 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-500">
            Clear
        </a>
    </form>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="min-w-full table-auto text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @forelse ($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-300 dark:border-gray-600 shadow-sm">
                                <img src="{{ asset('storage/' . $user->profile_img) }}" alt="Profile Image" class="w-full h-full object-cover">
                            </div>
                            <div class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                {{ $user->name }}
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    @can('changeRole', $user)
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.users.changeRole', $user) }}">
                            @csrf
                            @method('PATCH')
                            <select name="role" onchange="this.form.submit()" class="border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                @foreach (['admin', 'moderator', 'user'] as $role)
                                <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    @else
                    <td colspan="3" class="px-4 py-3">
                        @if(auth()->user()->id !== $user->id)
                        <span class="text-xs text-red-400 block">No permission to make actions on this user.</span>
                        @else
                        <span class="text-blue-500 italic">It's you</span>
                        <span class="text-gray-600 dark:text-gray-300">{{ ucfirst($user->role) }}</span>
                        @endif
                    </td>
                    @endcan
                    @can('toggleStatus', $user)
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                            {{ $user->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-400' }}">
                            {{ $user->is_active ? 'Active' : 'Suspended' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <form method="POST" action="{{ route('admin.users.toggle', $user) }}">
                            @csrf
                            @method('PATCH')
                            <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-xs">
                                {{ $user->is_active ? 'Suspend' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                    @endcan
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center px-4 py-6 text-gray-400 dark:text-gray-500">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>