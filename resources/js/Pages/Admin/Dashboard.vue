<template>
    <AdminLayout>
        <div class="w-full p-5 bg-white dark:bg-gray-900 shadow rounded">
            <div class="flex gap-5">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Welcome, {{ displayName }}👋
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">Here's a quick overview of what's happening in the
                        system.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <Link href="/admin/users?status=active"
                    class="p-4 bg-green-200 dark:bg-green-800 rounded shadow hover:shadow-md transition">
                    <h2 class="text-sm text-green-700 dark:text-green-300 uppercase font-semibold">Active Users</h2>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ numOfActiveUsers }}</p>
                </Link>

                <Link href="/admin/users?status=suspended"
                    class="p-4 bg-red-200 dark:bg-red-800 rounded shadow hover:shadow-md transition">
                    <h2 class="text-sm text-red-700 dark:text-red-300 uppercase font-semibold">Suspended Users</h2>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ numOfSusUsers }}</p>
                </Link>

                <div class="p-4 bg-sky-200 dark:bg-sky-800 rounded shadow hover:shadow-md transition">
                    <h2 class="text-sm text-sky-700 dark:text-sky-300 uppercase font-semibold">Tourist Spots</h2>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ numOfPlaces }}</p>
                </div>

                <div class="p-4 bg-indigo-200 dark:bg-indigo-800 rounded shadow hover:shadow-md transition">
                    <h2 class="text-sm text-indigo-700 dark:text-indigo-300 uppercase font-semibold">Categories</h2>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ numOfCategory }}</p>
                </div>
            </div>

            <div class="mb-10">
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Quick Links</h3>
                <div class="flex flex-wrap gap-3">
                    <Link href="/admin/users"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Manage Users
                    </Link>
                    <Link href="/admin/places"
                        class="inline-block bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded">Manage Places
                    </Link>
                    <Link href="/admin/categories"
                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Manage
                        Categories</Link>
                    <Link href="/admin/reviews"
                        class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Manage
                        Reviews
                    </Link>
                    <Link href="/admin/settings"
                        class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">Settings</Link>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Top-Rated Places</h3>

                <div class="space-y-4">
                    <div v-if="topPlaces && topPlaces.length">
                        <div v-for="place in topPlaces" :key="place.id"
                            class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ place.name }}
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">📊 Total reviews: <span
                                            class="font-medium">{{ place.reviews ? place.reviews.length : 0 }}</span>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="inline-block bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 text-sm font-semibold px-3 py-1 rounded">{{
                                            place.rating }}</span>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Rating</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p v-else class="text-gray-500 dark:text-gray-400">No ratings available yet.</p>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    displayName: String,
    numOfActiveUsers: Number,
    numOfSusUsers: Number,
    numOfPlaces: Number,
    numOfCategory: Number,
    numOfPendingReviews: Number,
    topPlaces: Array,
});

const { props: pageProps } = usePage();

const displayName = pageProps.displayName || props.displayName;
const numOfActiveUsers = pageProps.numOfActiveUsers ?? props.numOfActiveUsers;
const numOfSusUsers = pageProps.numOfSusUsers ?? props.numOfSusUsers;
const numOfPlaces = pageProps.numOfPlaces ?? props.numOfPlaces;
const numOfCategory = pageProps.numOfCategory ?? props.numOfCategory;
const topPlaces = pageProps.topPlaces ?? props.topPlaces ?? [];

</script>

<style scoped></style>
