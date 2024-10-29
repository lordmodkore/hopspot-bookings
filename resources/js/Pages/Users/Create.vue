<template>
    <h2 class="text-2xl font-bold mb-3 text-center dark:text-gray-300">Create New User</h2>

    <form @submit.prevent="createUser" class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <!-- Name Input Field -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-300">Name</label>
            <input
                v-model="form.name"
                type="text"
                id="name"
                class="border border-gray-300 dark:border-gray-600 rounded-md w-full p-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                placeholder="Enter name"
                :class="{ 'border-red-500': form.errors.name }"
            />
            <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name[0] }}</p>
        </div>

        <!-- Email Input Field -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
            <input
                v-model="form.email"
                type="email"
                id="email"
                class="border border-gray-300 dark:border-gray-600 rounded-md w-full p-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                placeholder="you@example.com"
                :class="{ 'border-red-500': form.errors.email }"
            />
            <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email[0] }}</p>
        </div>

        <!-- Password Input Field -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 dark:text-gray-300">Password</label>
            <input
                v-model="form.password"
                type="password"
                id="password"
                class="border border-gray-300 dark:border-gray-600 rounded-md w-full p-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :class="{ 'border-red-500': form.errors.password }"
                placeholder="********"
            />
            <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password[0] }}</p>
        </div>

        <!-- Password Confirmation Input Field -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300">Confirm Password</label>
            <input
                v-model="form.password_confirmation"
                type="password"
                id="password_confirmation"
                class="border border-gray-300 dark:border-gray-600 rounded-md w-full p-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                :class="{ 'border-red-500': form.errors.password_confirmation }"
                placeholder="********"
            />
            <p v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">{{ form.errors.password_confirmation[0] }}</p>
        </div>

        <!-- Roles Dropdown -->
        <div class="mb-4">
            <label for="roles" class="block text-gray-700 dark:text-gray-300">Role</label>
            <select v-model="form.roles" id="roles" class="border border-gray-300 dark:border-gray-600 rounded-md w-full p-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                <option value="" disabled>Select role</option>
                <option v-for="role in roles" :key="role.id" :value="role.name">
                    {{ role.name.charAt(0).toUpperCase() + role.name.slice(1) }}
                </option>
            </select>
            <p v-if="form.errors.roles" class="text-red-500 text-sm mt-1">{{ form.errors.roles[0] }}</p>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Create User</button>

        <div class="flex justify-center items-center mt-4">
            <p class="text-gray-600 dark:text-gray-300">Already have an account?</p>
            <a class="text-blue-600 ml-2" href="{{ route('login') }}">Sign In</a>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { route } from "ziggy-js";

const props = defineProps({
    roles: Array, // Pass roles from the controller to the component
});

// Initialize the form
const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    roles: 'staff', // To store selected role
});

// Form submit handler
const createUser = () => {
    form.post(route('users.store')); // Replace with your actual route for creating users
};
</script>

<style scoped>
/* You can add additional styles here */
</style>
