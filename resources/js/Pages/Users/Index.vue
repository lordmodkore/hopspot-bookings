<template>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">User Management</h1>
        <div class="mb-4">
            <a :href="route('users.create')" class="bg-blue-600 text-white py-2 px-4 rounded shadow hover:bg-blue-700 transition">Create New User</a>
        </div>
        <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <thead>
            <tr class="w-full bg-gray-200 dark:bg-gray-700 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Role</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id" class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                <td class="py-3 px-6 text-left text-gray-800 dark:text-white">{{ user.name }}</td>
                <td class="py-3 px-6 text-left text-gray-800 dark:text-white">{{ user.email }}</td>
                <td class="py-3 px-6 text-left text-gray-800 dark:text-white">{{ user.roles.map(role => role.name).join(', ') }}</td>
                <td class="py-3 px-6 text-left flex items-center">
                    <a :href="route('users.edit', user.id)" class="text-blue-600 hover:text-blue-800 transition mr-4">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button @click="deleteUser(user.id)" class="text-red-600 hover:text-red-800 transition">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            <tr v-if="users.length === 0">
                <td colspan="4" class="py-3 px-6 text-center text-gray-500 dark:text-gray-400">No users found.</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import {ZiggyVue} from "ziggy-js";

const { users } = usePage().props; // Get users from Inertia page props

const deleteUser = async (id) => {
    if (confirm("Are you sure you want to delete this user?")) {
        // Use Inertia to delete user
        await axios.delete(`/users/${id}`).then(() => {
            // Reload the page to reflect changes
            window.location.reload();
        }).catch(error => {
            console.error("Error deleting user:", error);
            alert("Failed to delete user. Please try again.");
        });
    }
};
</script>

