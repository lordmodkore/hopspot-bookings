<template>
    <transition name="fade" mode="out-in">
        <div v-if="isLoading" key="loading" class="fixed inset-0 flex items-center justify-center bg-white z-50" role="alert">
            <div class="loading-container">
                <img v-if="props.logoUrl" :src="props.logoUrl" alt="Loading..." class="loading-logo" />
                <p class="loading-text">Loading, please wait...</p>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    logoUrl: {
        type: String,
        required: true,
        default: ''
    },
});


const isLoading = ref(false);

// Function to manually start loading
const startLoading = () => {
    isLoading.value = true;
};

// Function to manually stop loading
const stopLoading = () => {
    isLoading.value = false;
};

// Example functions to simulate a network request
const fetchData = async () => {
    startLoading();
    try {
        // Simulate a network request with a timeout
        await new Promise((resolve) => setTimeout(resolve, 1000));
        // Here you can handle your data after fetching
    } catch (error) {
        console.error("An error occurred:", error);
    } finally {
        stopLoading();
    }
};

// Call fetchData to simulate loading when the component is mounted
onMounted(() => {
    fetchData();
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
    transform: scale(1.05); /* Slightly scale up for entrance */
}

.loading-container {
    text-align: center;
}

.loading-logo {
    width: 400px; /* Adjust size as needed */
}

.loading-text {
    margin-top: 1rem;
    font-size: 1.2rem;
    color: #333; /* Change text color as needed */
    opacity: 0; /* Start with hidden text */
    animation: fadeIn 1s forwards; /* Fade in effect for text */
    animation-delay: 0.5s; /* Delay text appearance */
}

/* Fade In Animation for the text */
@keyframes fadeIn {
    to { opacity: 1; }
}
</style>
