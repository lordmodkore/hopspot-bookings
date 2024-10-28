<template>
    <div v-if="visible" :class="notificationClass">
        <div class="flex items-center">
            <span class="ml-2">{{ message }}</span>
        </div>
        <button @click="clear" :class="buttonClass">
            &times; <!-- Close icon -->
        </button>
    </div>
</template>

<script setup>
import { defineProps, ref, computed } from 'vue';

const props = defineProps({
    message: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'success', // default type can be success
    },
});

// Define a visible state
const visible = ref(true);

// Function to clear the message
const clear = () => {
    visible.value = false;
};

// Computed property for notification classes
const notificationClass = computed(() => {
    const baseClasses = 'border-l-4 p-4 flex justify-between items-center';
    const colorClasses = props.type === 'error'
        ? 'bg-red-100 border-red-500 text-red-700'
        : 'bg-green-100 border-green-500 text-green-700';
    return `${baseClasses} ${colorClasses}`;
});

// Computed property for button classes
const buttonClass = computed(() => {
    return `text-${props.type === 'error' ? 'red' : 'green'}-700 hover:text-${props.type === 'error' ? 'red' : 'green'}-900 ml-4`;
});
</script>

<style scoped>
/* Optional: add any additional styles here if needed */
</style>
