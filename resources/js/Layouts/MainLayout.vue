<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <Sidebar
            :isSidebarOpen="isSidebarOpen"
            :isDarkMode="isDarkMode"
            :logoUrl="logoUrl"
            :logoUrlDarkMode="logoUrlDarkMode"
            @toggleSidebar="toggleSidebar"
            @toggleDarkMode="toggleDarkMode"
        />

        <!-- Overlay for mobile sidebar -->
        <div
            v-if="isSidebarOpen"
            @click="toggleSidebar"
            class="fixed inset-0 bg-black opacity-50 z-20 md:hidden"
        ></div>

        <!-- Burger Button (Mobile) -->
        <button
            @click="toggleSidebar"
            class="fixed top-4 left-4 z-40 bg-gray-200 dark:bg-gray-800 text-gray-600 dark:text-gray-300  p-2 md:hidden"
        >
            <i v-if="!isSidebarOpen" class="fas fa-bars text-lg"></i>
            <i v-else class="fas fa-times text-lg"></i>
        </button>

        <!-- Main Content -->
        <main
            :class="{'ml-0': !isSidebarOpen, 'md:ml-64': isSidebarOpen}"
            class="flex-grow p-4 transition-all duration-300"
        >
            <FlashMessage
                v-if="$page.props.flash && $page.props.flash.success"
                :message="$page.props.flash.success"
                type="success"
            />
            <FlashMessage
                v-if="$page.props.flash && $page.props.flash.error"
                :message="$page.props.flash.error"
                type="error"
            />
            <LoadingOverlay :logoUrl="logoUrl" />
            <slot :logoUrl="logoUrl" :googleIconUrl="googleIconUrl" :facebookIconUrl="facebookIconUrl"></slot>
        </main>
    </div>
</template>

<script setup>
import LoadingOverlay from '@/Components/LoadingOverlay.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import Sidebar from '@/Components/Sidebar.vue';
import { ref } from 'vue';

const logoUrl = '/images/logo.png';
const logoUrlDarkMode = '/images/logo-darkmode.png'; // Adjust the path to your logo
const googleIconUrl = '/images/google-icon.png'; // Set the path for Google icon
const facebookIconUrl = '/images/facebook-icon.png'; // Set the path for Facebook icon

// Dark mode toggle
const isDarkMode = ref(false);
const toggleDarkMode = () => {
    isDarkMode.value = !isDarkMode.value;
    const htmlElement = document.documentElement;
    if (isDarkMode.value) {
        htmlElement.classList.add('dark');
    } else {
        htmlElement.classList.remove('dark');
    }
};

// Sidebar toggle
const isSidebarOpen = ref(false);
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<style scoped>
/* Add any additional styles if needed */
</style>
