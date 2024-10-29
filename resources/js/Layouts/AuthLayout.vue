<!-- AuthLayout.vue -->
<template>
    <LoadingOverlay :logoUrl="logoUrl" />
    <div class="relative overflow-hidden bg-gray-100 min-h-screen">
        <div class="relative z-5">
            <div class="flex flex-col lg:flex-row">
                <div class="hidden lg:flex lg:w-1/2 items-center justify-center h-screen">
                    <img :src="logoUrl" alt="Logo" class="img-fluid" width="500" />
                </div>
                <div class="lg:w-1/2 flex items-center justify-center min-h-screen bg-white p-4">
                    <div class="w-full max-w-md">
                        <!-- Flash Messages -->
                        <div v-if="flash.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <span class="block sm:inline">{{ flash.error }}</span>
                        </div>
                        <div v-if="flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            <span class="block sm:inline">{{ flash.success }}</span>
                        </div>
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { defineProps } from 'vue';
import LoadingOverlay from '@/Components/LoadingOverlay.vue';
import { route } from "ziggy-js";

// Props for the layout
const props = defineProps({
    flash: { type: Object, default: () => ({}) },
});

const logoUrl = '/images/logo.png'; // Adjust the path to your logo
</script>
