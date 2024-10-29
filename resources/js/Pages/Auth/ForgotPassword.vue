<template>
    <form @submit.prevent="submit">
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email Address</label>
            <input
                v-model="form.email"
                type="email"
                id="email"
                class="border border-gray-300 rounded-md w-full p-2 mt-1"
                placeholder="you@example.com"
                required
            />
            <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email[0] }}</p>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
            Send Password Reset Link
        </button>
        <div class="mt-4 text-center">
            <p class="text-gray-600">Remembered your password?</p>
            <a class="text-blue-600 ml-2" :href="route('login')">Sign In</a>
        </div>
    </form>
</template>

<script setup>
import { ref,defineOptions} from 'vue';
import {router, useForm} from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import AuthLayout from '@/Layouts/AuthLayout.vue';



defineOptions({
    layout: AuthLayout
});


// Define your own props for additional URLs
const props = defineProps({
    flash: { type: Object, default: () => ({}) },
});

const form = useForm({ email: '' });

const submit = () => {

    form.post(route('password.email'), {
        onError: (errors) => {

        },
        onFinish: () => {
            form.reset();  // Clear any lingering error messages
        },
    });
};
</script>
