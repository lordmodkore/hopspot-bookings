<template>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center dark:text-white">Edit User</h1>
        <form @submit.prevent="updateUser" class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <!-- Name Input Field -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300">Name</label>
                <input
                    v-model="form.name"
                    type="text"
                    id="name"
                    class="border border-gray-300 rounded-md w-full p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    placeholder="Enter name"
                    :class="{ 'border-red-500': form.errors.name }"
                    required
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
                    class="border border-gray-300 rounded-md w-full p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    placeholder="you@example.com"
                    :class="{ 'border-red-500': form.errors.email }"
                    required
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
                    class="border border-gray-300 rounded-md w-full p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    placeholder="Leave blank to keep current password"
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
                    class="border border-gray-300 rounded-md w-full p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    placeholder="Leave blank to keep current password"
                />
                <p v-if="form.errors.password_confirmation" class="text-red-500 text-sm mt-1">{{ form.errors.password_confirmation[0] }}</p>
            </div>

            <!-- Roles Dropdown -->
            <div class="mb-4">
                <label for="roles" class="block text-gray-700 dark:text-gray-300">Roles</label>
                <select
                    v-model="form.roles"
                    id="roles"
                    class="border border-gray-300 rounded-md w-full p-2 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    required
                >
                    <option value="" disabled>Select a role</option> <!-- Default disabled option -->
                    <option v-for="role in roles" :key="role.id" :value="role.name">
                        {{ role.name.charAt(0).toUpperCase() + role.name.slice(1) }}
                    </option>
                </select>
                <p v-if="form.errors.roles" class="text-red-500 text-sm mt-1">{{ form.errors.roles[0] }}</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Update User</button>

            <div class="flex justify-center items-center mt-4">
                <a class="text-blue-600" href="/users">Back to User List</a>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps({
    errors: Object,
    user: Object,
    roles: Array,
    userRoles: Array, // Ensure this prop is being passed correctly
});

// Initialize the form with user data and ensure a valid initial role
const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: null,
    password_confirmation: null,
    roles: props.user.roles.length ? props.user.roles[0].name : 'staff' // Ensure the role is set or empty string
});

// Form submit handler
const updateUser = () => {
    form.put(route('users.update', props.user.id)); // Replace with your actual route for updating users
};
</script>
