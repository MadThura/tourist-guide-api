<x-layout>
    <h1 class="text-2xl font-bold mb-6">User Management</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-xs uppercase text-gray-700">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>

                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.users.changeRole', $user) }}">
                            @csrf
                            @method('PATCH')
                            <select name="role" onchange="this.form.submit()" class="border-gray-300 rounded px-2 py-1">
                                @foreach (['admin', 'moderator', 'user'] as $role)
                                <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                    </td>

                    <td class="px-4 py-3">
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                            {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Active' : 'Suspended' }}
                        </span>
                    </td>

                    <td class="px-4 py-3 text-center">
                        <form method="POST" action="{{route('admin.users.toogle', $user)}}">
                            @csrf
                            @method('PATCH')
                            <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-xs">
                                {{ $user->is_active ? 'Suspend' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>