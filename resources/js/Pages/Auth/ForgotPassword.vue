<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>
            <p class="text-gray-600 text-center mb-4">
                Please enter your email address. We will send you a link to reset your password.
            </p>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input
                        v-model="email"
                        type="email"
                        id="email"
                        class="border border-gray-300 rounded-md w-full p-2 mt-1"
                        placeholder="you@example.com"
                        required
                    />
                    <p v-if="errorMessage" class="text-red-500 text-sm mt-1">{{ errorMessage }}</p>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                    Send Password Reset Link
                </button>
                <div class="mt-4 text-center">
                    <p class="text-gray-600">Remembered your password?</p>
                    <router-link to="/login" class="text-blue-600">Sign In</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import {router, useForm} from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const email = ref('');
const errorMessage = ref('');

const submit = () => {
    errorMessage.value = ''; // Reset error message
    // Add your form submission logic here
    // For example:
    const form = useForm({ email: email.value });

    form.post(route('password.email'), {
        onError: (errors) => {
            errorMessage.value = errors.email ? errors.email[0] : 'Something went wrong!';
        },
        onFinish: () => {
            // Handle success, e.g., redirect or show a success message
        },
    });
};
</script>

<style scoped>
/* Additional custom styles can go here */
</style>
