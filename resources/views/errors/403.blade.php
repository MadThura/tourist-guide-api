<x-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-red-500 mb-4">403</h1>
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Unauthorized Access</h2>
            <p class="text-gray-600 mb-6">You don’t have permission to access this page.</p>

            @auth
            <a href="{{ route('admin.dashboard') }}"
                class="inline-block bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600">
                Go to Dashboard
            </a>
            @else
            <a href="{{ route('admin.login') }}"
                class="inline-block bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600">
                Login as Admin
            </a>
            @endauth
        </div>
    </div>
</x-layout>