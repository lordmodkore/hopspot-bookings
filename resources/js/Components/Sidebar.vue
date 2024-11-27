<template>
    <aside
        :class="{'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen}"
        class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-300 z-30 md:relative md:translate-x-0 md:block"
    >
        <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <button
                    @click="$emit('toggleSidebar')"
                    class="block md:hidden bg-gray-200 dark:bg-gray-800 text-gray-600 dark:text-gray-300 rounded-full p-2"
                >
                    <i v-if="!isSidebarOpen" class="fas fa-bars text-lg"></i>
                    <i v-else class="fas fa-times text-lg"></i>
                </button>
                <img
                    :src="isDarkMode ? logoUrlDarkMode : logoUrl"
                    alt="Admin Logo"
                    class="h-10"
                />
            </div>
            <button @click="$emit('toggleDarkMode')" class="text-gray-600 dark:text-gray-300">
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
</template>

<script setup>
const props = defineProps({
    isSidebarOpen: Boolean,
    isDarkMode: Boolean,
    logoUrl: String,
    logoUrlDarkMode: String,
});
</script>

<style scoped>
/* Add any sidebar-specific styles if needed */
</style>
