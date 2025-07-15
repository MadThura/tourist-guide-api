<footer class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-200 py-10 transition-colors duration-300">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Logo & Name -->
        <div>
            <h2 class="text-2xl font-bold mb-2">{{ $globalSetting->app_name }}</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $globalSetting->footer_text }}
            </p>
        </div>

        <!-- Contact Info -->
        <div>
            <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
            <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <strong>Address:</strong> {{ $globalSetting->contact_address }}
                </li>
                <li>
                    <strong>Phone:</strong> {{ $globalSetting->contact_phone }}
                </li>
                <li>
                    <strong>Email:</strong> {{ $globalSetting->contact_email }}
                </li>
            </ul>
        </div>

        <!-- Optional Social Links (Dark Mode Ready) -->
        <!--
        <div>
            <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
            <div class="flex space-x-4 text-gray-600 dark:text-gray-400">
                <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400">Facebook</a>
                <a href="#" class="hover:text-sky-600 dark:hover:text-sky-400">Twitter</a>
                <a href="#" class="hover:text-pink-600 dark:hover:text-pink-400">Instagram</a>
            </div>
        </div>
        -->
    </div>

    <div class="text-center text-gray-500 dark:text-gray-400 text-sm mt-8 border-t border-gray-300 dark:border-gray-700 pt-4">
        &copy; {{ now()->year }} {{ $globalSetting->app_name }}. All rights reserved.
    </div>
</footer>