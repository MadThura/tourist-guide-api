<footer class="bg-gray-800 text-white py-10">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Logo & Name -->
        <div>
            <h2 class="text-2xl font-bold mb-2">{{$globalSetting->app_name}}</h2>
            <p class="text-sm text-gray-300">Bringing you closer to your destination.</p>
        </div>

        <!-- Contact Info -->
        <div>
            <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
            <ul class="text-gray-300 space-y-2 text-sm">
                <li>
                    <strong>Address:</strong> {{$globalSetting->contact_address}}
                </li>
                <li>
                    <strong>Phone:</strong> {{$globalSetting->contact_phone}}
                </li>
                <li>
                    <strong>Email:</strong> {{$globalSetting->contact_email}}
                </li>
            </ul>
        </div>

        <!-- Social Links (Optional) -->
        <!-- <div>
            <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-blue-400">Facebook</a>
                <a href="#" class="hover:text-sky-400">Twitter</a>
                <a href="#" class="hover:text-pink-400">Instagram</a>
            </div>
        </div> -->
    </div>

    <div class="text-center text-gray-400 text-sm mt-8 border-t border-gray-700 pt-4">
        &copy; 2025 {{$globalSetting->app_name}}. All rights reserved.
    </div>
</footer>