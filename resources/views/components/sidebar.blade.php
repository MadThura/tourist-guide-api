<aside id="sidebar"
    class="fixed top-0 left-0 h-screen w-75 bg-white dark:bg-gray-800 shadow-md dark:shadow-lg
           p-4 flex flex-col transition-[width] duration-500 ease-in-out overflow-y-auto no-scrollbar">

    <!-- Toggle + App Name -->
    <div class="flex items-center p-4 rounded text-lg">
        <button onclick="toggleSidebar()"
            class="w-10 h-10 flex items-center justify-center text-gray-600 dark:text-gray-300">
            <i class="fa-solid fa-bars text-2xl"></i>
        </button>

        <div class="sidebar-text text-2xl font-normal text-gray-900 dark:text-white ml-5">
            {{ $globalSetting->app_name }}
        </div>
    </div>

    <nav class="flex-1 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
           {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-square-poll-vertical w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Dashboard</span>
        </a>

        <a href="{{ route('admin.users.index') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
           {{ request()->routeIs('admin.users.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-users w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Users</span>
        </a>

        <a href="{{ route('admin.places.index') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
           {{ request()->routeIs('admin.places.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-location-dot w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Tourist spots</span>
        </a>

        <a href="{{ route('admin.categories.index') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
           {{ request()->routeIs('admin.categories.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-list w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Categories</span>
        </a>

        <a href="{{ route('admin.reviews.index') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
           {{ request()->routeIs('admin.reviews.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-star-half-stroke w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Reviews</span>
        </a>

        <a href="{{ route('admin.emails.index') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
           {{ request()->routeIs('admin.emails.index') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-envelope w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Emails</span>
        </a>

        <a href="{{ route('admin.settings.edit') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg mt-4
           {{ request()->routeIs('admin.settings.edit') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-gear w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Settings</span>
        </a>

        <a href="{{ route('admin.profile.edit') }}"
            class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg
           {{ request()->routeIs('admin.profile.edit') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">
            <i class="fa-solid fa-address-card w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Profile</span>
        </a>
    </nav>

    <button onclick="toggleDarkMode()"
        class="sidebar-item sidebar-action flex items-center w-full py-2 px-4 rounded
           bg-gray-800 text-white dark:bg-white dark:text-gray-800 hover:opacity-90">

        <i id="themeIcon" class="fa-solid fa-moon w-10 text-center text-2xl"></i>

        <span id="themeText" class="sidebar-text ml-5">
            Enable dark mode
        </span>
    </button>


    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
        @csrf
        <button type="submit"
            class="sidebar-item sidebar-action flex items-center w-full py-2 px-4 rounded bg-red-500 text-white hover:bg-red-600">
            <i class="fa-solid fa-right-from-bracket w-10 text-center text-2xl"></i>
            <span class="sidebar-text ml-5">Logout</span>
        </button>
    </form>
</aside>