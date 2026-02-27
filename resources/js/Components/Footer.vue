<template>
    <footer
        class="w-full bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-200 py-10 transition-colors duration-300">
        <div class="w-full px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Logo & Name -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Tourist Guide</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Bla Bla Bla....
                </p>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li>
                        <strong>Address:</strong>
                    </li>
                    <li>
                        <strong>Phone:</strong>
                    </li>
                    <li>
                        <strong>Email:</strong>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
                <div class="flex space-x-4 text-gray-600 dark:text-gray-400">
                    <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400">Facebook</a>
                    <a href="#" class="hover:text-sky-600 dark:hover:text-sky-400">Twitter</a>
                    <a href="#" class="hover:text-pink-600 dark:hover:text-pink-400">Instagram</a>
                </div>
            </div>
        </div>
        <div
            class="text-center text-gray-500 dark:text-gray-400 text-sm mt-8 border-t border-gray-300 dark:border-gray-700 pt-4">
            &copy; {{ new Date().getFullYear() }} . All rights reserved.
        </div>
    </footer>
</template>

<script setup>
const props = defineProps({

});
</script>

<style scoped>
/* keep or add any footer-specific styles if needed */
</style>
