<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
            <p class="text-gray-600">Are you sure you want to delete this user? This action cannot be undone.</p>
            <div class="mt-6 flex justify-end">
                <button @click="handleCancel" class="px-4 py-2 mr-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded">Cancel</button>
                <button @click="handleConfirm" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Delete</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props
const props = defineProps({
    show: Boolean,

});

// Define emit events
const emit = defineEmits(['onConfirm', 'onCancel']);

// Method to handle cancel button click
function handleCancel() {
    emit('onCancel');
}

// Method to handle confirm button click
function handleConfirm() {
    emit('onConfirm');
}
</script>
