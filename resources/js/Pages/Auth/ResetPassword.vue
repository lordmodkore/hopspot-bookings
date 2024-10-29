<template>
        <h2 class="text-2xl font-semibold text-center mb-4">Reset Password</h2>

        <form @submit.prevent="resetPassword">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input
                    type="email"
                    v-model="form.email"
                    id="email"
                    required
                    class="border border-gray-300 rounded-md w-full p-2"
                />
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">New Password</label>
                <input
                    type="password"
                    v-model="form.password"
                    id="password"
                    required
                    class="border border-gray-300 rounded-md w-full p-2"
                />
                <p v-if="form.errors.password" class="text-red-500 text-sm mt-1 mb-2">{{ form.errors.password[0] }}</p>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input
                    type="password"
                    v-model="form.password_confirmation"
                    id="password_confirmation"
                    required
                    class="border border-gray-300 rounded-md w-full p-2"
                />
            </div>
            <input type="hidden" v-model="form.token" />
            <p v-if="form.errors.email" class="text-red-500 text-sm mt-1 mb-2">{{ form.errors.email[0] }}</p>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Reset Password
            </button>
        </form>
</template>

<script setup>
import { ref,defineProps} from 'vue';
import { useForm,usePage } from '@inertiajs/vue3';
import { route } from "ziggy-js";

import AuthLayout from '@/Layouts/AuthLayout.vue';



defineOptions({
    layout: AuthLayout
});


// Define props to receive the token and email
const props = defineProps(['token', 'email']);

// Initialize the form with reactive properties
const form = useForm({
    email: props.email || '',
    password: '',
    password_confirmation: '',
    token: props.token || '',
});

// Submit the form
const resetPassword = () => {
    form.post(route('password.update'), {
        onSuccess: () => {
            // Handle successful reset, e.g., redirect to login or show a message

        },
        onError: (errors) => {

        },
    });
};
</script>

<style scoped>
/* Add any styles here if needed */
</style>
