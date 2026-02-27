<template>
    <aside @mouseenter="onMouseEnter" @mouseleave="onMouseLeave" :class="[
        'fixed top-0 left-0 h-screen bg-white dark:bg-gray-800 shadow-md dark:shadow-lg p-4 flex flex-col transition-[width] duration-300 ease-in-out overflow-y-auto no-scrollbar',
        { 'w-20': effectiveCollapsed, 'w-64': !effectiveCollapsed }
    ]">
        <!-- Toggle + App Name -->
        <div class="flex items-center p-4 rounded text-lg">
            <button @click="toggleSidebar"
                class="w-10 h-10 flex items-center justify-center text-gray-600 dark:text-gray-300">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>

            <div class="sidebar-text text-2xl font-normal text-gray-900 dark:text-white ml-5" v-if="!effectiveCollapsed">
                {{ globalSetting?.app_name }}
            </div>
        </div>

        <nav class="flex-1 space-y-2">
            <Link href="/admin/dashboard"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/dashboard') }">
                <i class="fa-solid fa-square-poll-vertical w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Dashboard</span>
            </Link>

            <Link href="/admin/users"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/users') }">
                <i class="fa-solid fa-users w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Users</span>
            </Link>

            <Link href="/admin/places"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/places') }">
                <i class="fa-solid fa-location-dot w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Tourist spots</span>
            </Link>

            <Link href="/admin/categories"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/categories') }">
                <i class="fa-solid fa-list w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Categories</span>
            </Link>

            <Link href="/admin/reviews"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/reviews') }">
                <i class="fa-solid fa-star-half-stroke w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Reviews</span>
            </Link>

            <Link href="/admin/emails"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/emails') }">
                <i class="fa-solid fa-envelope w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Emails</span>
            </Link>

            <Link href="/admin/settings"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg mt-4"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/settings') }">
                <i class="fa-solid fa-gear w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Settings</span>
            </Link>

            <Link href="/admin/profile"
                class="sidebar-item flex items-center py-2 px-4 rounded hover:bg-gray-200 dark:hover:bg-gray-700 text-lg"
                :class="{ 'bg-gray-200 dark:bg-gray-700': isActive('/admin/profile') }">
                <i class="fa-solid fa-address-card w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Profile</span>
            </Link>
        </nav>

        <button @click="toggleDarkMode"
            class="sidebar-item sidebar-action flex items-center w-full py-2 px-4 rounded bg-gray-800 text-white dark:bg-white dark:text-gray-800 hover:opacity-90">
            <i id="themeIcon" class="fa-solid fa-moon w-10 text-center text-2xl"></i>
            <span id="themeText" class="sidebar-text ml-5" v-if="!effectiveCollapsed">
                Enable dark mode
            </span>
        </button>

        <form method="POST" action="/admin/logout" class="mt-4">
            <button type="submit"
                class="sidebar-item sidebar-action flex items-center w-full py-2 px-4 rounded bg-red-500 text-white hover:bg-red-600">
                <i class="fa-solid fa-right-from-bracket w-10 text-center text-2xl"></i>
                <span class="sidebar-text ml-5" v-if="!effectiveCollapsed">Logout</span>
            </button>
        </form>
    </aside>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    globalSetting: Object,
    modelValue: { type: Boolean, default: false }, // v-model for collapsed
});

// internal collapsed state mirrors prop
const collapsed = ref(props.modelValue);
const hovering = ref(false); // for temporary expansion similar to YouTube
const darkMode = ref(false);

// expose collapsed for parent if needed
const emit = defineEmits(['update:modelValue']);

// sync prop changes
watch(
  () => props.modelValue,
  (val) => {
    collapsed.value = val;
  }
);

// when collapsed and not hovered, keep narrow; otherwise expanded
const effectiveCollapsed = computed(() => collapsed.value && !hovering.value);

function toggleSidebar() {
  collapsed.value = !collapsed.value;
  // notify parent
  emit('update:modelValue', collapsed.value);
}

function onMouseEnter() {
  if (collapsed.value) {
    hovering.value = true;
  }
}

function onMouseLeave() {
  hovering.value = false;
}

function toggleDarkMode() {
    darkMode.value = !darkMode.value;
    document.documentElement.classList.toggle('dark', darkMode.value);
}

const page = usePage();
const currentUrl = computed(() => {
    // page.url may be a reactive object or function; coerce to string
    const u = page.url;
    return u != null ? u.toString() : '';
});

function isActive(path) {
    const url = currentUrl.value || '';
    return url.startsWith(path);
}

</script>

<style scoped>
/* you can keep any existing classes from blade */
</style>
