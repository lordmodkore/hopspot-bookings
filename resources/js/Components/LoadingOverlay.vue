<template>
    <transition name="fade" mode="out-in">
        <div v-if="isLoading" key="loading" class="fixed inset-0 flex items-center justify-center bg-white z-50">
            <img :src="logoUrl" alt="Loading..." class="w-80" />
        </div>
    </transition>
</template>

<script setup>
import {ref, onMounted, onBeforeUnmount} from 'vue';
import {Inertia} from '@inertiajs/inertia';

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

const stopLoading = () => {
    // Delay the loading overlay hide for a smoother transition
    setTimeout(() => {
        isLoading.value = false;
    }, 2000); // Adjust the delay time as needed (500ms in this case)
};

// Listen for Inertia navigation events
onMounted(() => {
    Inertia.on('start', startLoading);
    Inertia.on('finish', stopLoading);
});

onBeforeUnmount(() => {
    Inertia.off('start', startLoading);
    Inertia.off('finish', stopLoading);
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
