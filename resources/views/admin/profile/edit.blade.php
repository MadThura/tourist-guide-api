<x-layout>
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Edit Your Profile</h2>

        <!-- Update Profile Info -->
        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4 mb-10">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Save Changes
                </button>
            </div>
        </form>

        <hr class="my-8 border-gray-300 dark:border-gray-600" />

        <!-- Change Password -->
        <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Change Password</h3>
        <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Current Password</label>
                <input type="password" name="current_password" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
                @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">New Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300">Confirm New Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full mt-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
            </div>

            <div class="text-right">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</x-layout>