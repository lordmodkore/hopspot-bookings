<template>
    <transition name="fade" mode="out-in">
        <div v-if="isLoading" key="loading" class="fixed inset-0 flex items-center justify-center bg-white z-50" role="alert">
            <img :src="logoUrl" alt="Loading..." class="w-80" />
        </div>
    </transition>
</template>

<script setup>
import {ref, onMounted, onBeforeUnmount} from 'vue';
import {router} from '@inertiajs/vue3';

const props = defineProps({
    logoUrl: {
        type: String,
        required: true,
    },
});

const isLoading = ref(false);

// Set loading state on navigation
const startLoading = () => {
    isLoading.value = true;
};

const stopLoading = (event) => {
    // Check if the navigation was successful
    if (event.detail.status >= 200 && event.detail.status < 400) {
        setTimeout(() => {
            isLoading.value = false;
        }, 200); // Adjust delay time as needed
    } else {
        isLoading.value = false; // Stop loading on error
    }
};

// Listen for Inertia navigation events
onMounted(() => {
    router.on('start', startLoading);
    router.on('finish', stopLoading);
});

onBeforeUnmount(() => {
    router.off('start', startLoading);
    router.off('finish', stopLoading);
});
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
