<!-- Sidebar -->
<aside class="fixed top-0 left-0 h-screen w-75 bg-white dark:bg-gray-800 shadow-md dark:shadow-lg p-4 flex flex-col transition-colors duration-300 overflow-y-auto no-scrollbar">

    <div class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
        {{ $globalSetting->app_name }}
    </div>

    <nav class="flex-1 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
                  {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-square-poll-vertical mr-5"></i>Dashboard
        </a>

        <a href="{{ route('admin.users.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg 
                  {{ request()->routeIs('admin.users.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-users mr-5"></i>Users
        </a>

        <a href="{{ route('admin.places.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg 
                  {{ request()->routeIs('admin.places.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-location-dot mr-5"></i>Tourist spots
        </a>

        <a href="{{ route('admin.categories.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg 
                  {{ request()->routeIs('admin.categories.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-list mr-5"></i>Categories
        </a>

        <a href="{{ route('admin.reviews.index') }}"
            class="block py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg 
                  {{ request()->routeIs('admin.reviews.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-star-half-stroke mr-5"></i>Reviews
        </a>

        <!-- Trash Section -->
        <div class="mt-6 text-sm text-gray-500 dark:text-gray-400 px-4 uppercase">
            <i class="fa-solid fa-trash mr-5"></i>Trash
        </div>

        <a href="{{ route('admin.places.trashed') }}"
            class="flex py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg text-gray-400
                  {{ request()->routeIs('admin.places.trashed') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Tourist spots
            @if($trashedPlacesCount)
            <span class="bg-red-500 text-white rounded-full w-6 h-6 mt-0.5 flex items-center justify-center text-xs ml-3">
                {{ $trashedPlacesCount }}
            </span>
            @endif
        </a>

        <a href="{{ route('admin.categories.trashed') }}"
            class="flex py-2 px-4 rounded 
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg text-gray-400 
                  {{ request()->routeIs('admin.categories.trashed') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Categories
            @if($trashedCategoriesCount)
            <span class="bg-red-500 text-white rounded-full w-6 h-6 mt-0.5 flex items-center justify-center text-xs ml-3">
                {{ $trashedCategoriesCount }}
            </span>
            @endif
        </a>

        <a href="{{ route('admin.reviews.trashed') }}"
            class="flex py-2 px-4 roundeflex
                  hover:bg-gray-200 dark:hover:bg-gray-700 text-lg text-gray-400 
                  {{ request()->routeIs('admin.reviews.trashed') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            Reviews
            @if($trashedReviewsCount)
            <span class="bg-red-500 text-white rounded-full w-6 h-6 mt-0.5 flex items-center justify-center text-xs ml-3">
                {{ $trashedReviewsCount }}
            </span>
            @endif
        </a>

        <!-- Settings Link -->
        <a href="{{ route('admin.settings.edit') }}"
            class="block py-2 px-4 rounded 
           hover:bg-gray-200 dark:hover:bg-gray-700 text-lg 
           {{ request()->routeIs('admin.settings.edit') ? 'bg-gray-200 dark:bg-gray-700' : '' }} mt-4">
            <i class="fa-solid fa-gear mr-5"></i>Settings
        </a>

        <!-- Profile Link -->
        <a href="{{ route('admin.profile.edit') }}"
            class="block py-2 px-4 rounded 
           hover:bg-gray-200 dark:hover:bg-gray-700 text-lg 
           {{ request()->routeIs('admin.profile.edit') ? 'bg-gray-200 dark:bg-gray-700' : '' }} mt-4">
            <i class="fa-solid fa-address-card mr-5"></i>Profile
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