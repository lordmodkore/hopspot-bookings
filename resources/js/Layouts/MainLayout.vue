<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside
            :class="{'translate-x-0 left-10': isSidebarOpen, '-translate-x-full': !isSidebarOpen}"
            class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-300 z-30 md:relative md:left-0 md:translate-x-0 md:block"
        >
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                <img
                    :src="isDarkMode ? logoUrlDarkMode : logoUrl"
                    alt="Admin Logo"
                    class="h-10"
                />
                <button @click="toggleDarkMode" class="text-gray-600 dark:text-gray-300">
                    <span v-if="isDarkMode">🌙</span>
                    <span v-else>☀️</span>
                </button>
            </div>

            <nav class="mt-4">
                <ul>
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a :href="route('users.index')" class="block py-2 px-4 text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                            Reports
                        </a>
                    </li>
                    <li>
                        <a :href="route('logout')" class="block py-2 px-4 text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div v-if="isSidebarOpen" @click="toggleSidebar" class="fixed inset-0 bg-black opacity-50 z-20 md:hidden"></div>

        <!-- Sidebar Toggle Bar (Visible only on mobile) -->
        <div
            class="fixed left-0 top-0 z-40 h-full bg-gray-200 dark:bg-gray-800 flex items-center cursor-pointer md:hidden"
            @click="toggleSidebar"
            style="padding: 15px;"
        >
        <div class="flex justify-center items-center h-full">
            <i v-if="!isSidebarOpen" class="fas fa-chevron-right text-gray-600 dark:text-gray-300" style="font-size: 1.5rem;"></i>
            <i v-else class="fas fa-chevron-left text-gray-600 dark:text-gray-300" style="font-size: 1.5rem;"></i>
        </div>
    </div>

    <!-- Main Content -->
    <main :class="{'ml-0': isSidebarOpen, 'ml-8': !isSidebarOpen}" class="flex-grow p-4">
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
/* You can add any additional styles here */
</style>
