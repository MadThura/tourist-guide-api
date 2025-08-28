<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    @vite('resources/css/app.css') {{-- if using Vite --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-900 text-gray-100 font-sans min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-gray-800 p-6 rounded shadow shadow-black/50">
        <h1 class="text-2xl font-bold mb-4 text-blue-400 text-center">Admin Login</h1>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-gray-100 focus:outline-none focus:border-blue-500" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div x-data="{ show: false }" class="relative">
                <label class="block mb-1">Password</label>
                <input :type="show ? 'text' : 'password'" name="password" required
                    class="w-full p-2 pr-10 border border-gray-600 rounded bg-gray-700 text-gray-100 focus:outline-none focus:border-blue-500" />

                <!-- Eye Icon -->
                <button type="button" @click="show = !show"
                    class="absolute right-2 top-[70%] transform -translate-y-1/2 text-gray-400 hover:text-gray-100">
                    <template x-if="!show">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </template>
                    <template x-if="show">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.155-3.292m3.32-2.635A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.958 9.958 0 01-1.5 2.55M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </template>
                </button>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full transition duration-200">
                Login
            </button>
        </form>

    </div>

</body>


</html>
