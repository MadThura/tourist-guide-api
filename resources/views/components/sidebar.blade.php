<!-- Sidebar -->
<aside class="w-64 bg-white dark:bg-gray-800 shadow-md dark:shadow-lg p-4 flex flex-col transition-colors duration-300">
    <div class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
        {{ $globalSetting->app_name }}
    </div>

    <nav class="flex-1 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.users.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.users.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Users
        </a>

        <a href="{{ route('admin.places.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.places.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Places
        </a>

        <a href="{{ route('admin.categories.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.categories.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Categories
        </a>

        <a href="{{ route('admin.reviews.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.reviews.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Reviews
        </a>

        <!-- Trash Section -->
        <div class="mt-6 text-sm text-gray-500 dark:text-gray-400 px-4 uppercase">Trash</div>

        <a href="{{ route('admin.places.trashed') }}"
            class="flex py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.places.trashed') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Trashed Places
            @if($trashedPlacesCount)
            <span class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs ml-3">
                {{ $trashedPlacesCount }}
            </span>
            @endif
        </a>

        <a href="{{ route('admin.categories.trashed') }}"
            class="flex py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.categories.trashed') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Trashed Categories
            @if($trashedCategoriesCount)
            <span class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs ml-3">
                {{ $trashedCategoriesCount }}
            </span>
            @endif
        </a>

        <a href="{{ route('admin.reviews.trashed') }}"
            class="flex py-2 px-4 roundeflex
                  hover:bg-gray-200 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.reviews.trashed') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Trashed Reviews
            @if($trashedReviewsCount)
            <span class="bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs ml-3">
                {{ $trashedReviewsCount }}
            </span>
            @endif
        </a>

        <!-- Settings Link -->
        <a href="{{ route('admin.settings.edit') }}"
            class="block py-2 px-4 rounded 
           hover:bg-gray-200 dark:hover:bg-gray-700 
           {{ request()->routeIs('admin.settings.edit') ? 'bg-gray-200 dark:bg-gray-700' : '' }} mt-4">
            Settings
        </a>

    </nav>

    <!-- Dark Mode Toggle -->
    <form method="POST" action="{{ route('admin.toggle.darkmode') }}" class="mt-4">
        @csrf
        <button type="submit"
            class="px-4 py-2 rounded 
               bg-gray-800 text-white 
               dark:bg-white dark:text-gray-800 
               hover:opacity-90 w-full transition-colors duration-300">
            @if(session('dark_mode'))
            Disable dark mode
            @else 
            Enable dark mode
            @endif
        </button>
    </form>

    <!-- Logout -->
    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
        @csrf
        <button type="submit"
            class="py-2 px-4 w-full bg-red-500 text-white rounded hover:bg-red-600 transition-colors duration-300">
            Logout
        </button>
    </form>

</aside>