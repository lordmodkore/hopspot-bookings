<template>
    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg">
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
                        <a href="#" class="block py-2 px-4 text-gray-800 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
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

        <!-- Main Content -->
        <main class="flex-grow p-4">
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
import {ZiggyVue} from "ziggy-js";
import {ref} from 'vue';

const logoUrl = '/images/logo.png';
const logoUrlDarkMode = '/images/logo-darkmode.png'// Adjust the path to your logo
const googleIconUrl = '/images/google-icon.png'; // Set the path for Google icon
const facebookIconUrl = '/images/facebook-icon.png';

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
</script>

<style scoped>
/* You can add any additional styles here */
</style>
