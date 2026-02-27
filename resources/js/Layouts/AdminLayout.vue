<template>

    <Sidebar v-model:collapsed="sidebarCollapsed" />

    <main class="flex-1 ml-20">
        <slot />
        <Footer />
    </main>
</template>

<script setup>
import { ref } from 'vue';
import Sidebar from '@/Components/Sidebar.vue';
import Footer from '@/Components/Footer.vue';

const props = defineProps({

});

const sidebarCollapsed = ref(false);
</script>

<style scoped>
/* You could adjust padding for the main element if needed */
</style>
