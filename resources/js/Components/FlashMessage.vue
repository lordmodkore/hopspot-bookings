<template>
    <div v-if="visible" :class="`bg-${type === 'error' ? 'red' : 'green'}-100 border-l-4 border-${type === 'error' ? 'red' : 'green'}-500 text-${type === 'error' ? 'red' : 'green'}-700 p-4 rounded-lg flex justify-between items-center`">
        <div class="flex items-center">
            <span class="ml-2">{{ message }}</span>
        </div>
        <button @click="clear" class="text-${type === 'error' ? 'red' : 'green'}-700 hover:text-${type === 'error' ? 'red' : 'green'}-900 ml-4">
            &times; <!-- Close icon -->
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';

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
</script>

