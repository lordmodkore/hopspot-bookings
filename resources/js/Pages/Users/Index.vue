<template>
    <div class="container mx-auto p-6 mt-6">
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
                    <button @click="confirmDelete(user.id)" class="text-red-600 hover:text-red-800 transition">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
            <tr v-if="users.length === 0">
                <td colspan="4" class="py-3 px-6 text-center text-gray-500 dark:text-gray-400">No users found.</td>
            </tr>
            </tbody>
        </table>
        <DeleteModal :show="showDeleteModal" @onConfirm="handleRemove" @onCancel="cancelDelete" />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import DeleteModal from '@/Components/DeleteModal.vue';
import { route } from 'ziggy-js';

const { users: initialUsers } = usePage().props;
const users = ref(initialUsers); // Create a reactive users array
const showDeleteModal = ref(false);
const userToDelete = ref(null);

// Function to confirm delete action
const confirmDelete = (id) => {
    userToDelete.value = id;
    showDeleteModal.value = true;
    console.log(`Confirm delete for user ID: ${id}`); // Debugging line
};

// Function to handle user removal
const handleRemove = () => {
    if (!userToDelete.value) {
        console.warn("No user ID specified for deletion.");
        return;
    }

    console.log(`Attempting to delete user with ID: ${userToDelete.value}`); // Debugging line

    // Use `delete` to perform delete action
    useForm({}).delete(route('users.destroy', userToDelete.value), {
        preserveScroll: true,
        onSuccess: () => {
            // Update the users array to remove the deleted user
            users.value = users.value.filter(user => user.id !== userToDelete.value);
            console.log('User deleted successfully'); // Debugging line
            showDeleteModal.value = false;
            userToDelete.value = null;
        },
        onError: (error) => {
            console.error("Error deleting user:", error);
            alert("Failed to delete user. Please try again.");
        }
    });
};

// Function to cancel delete action
const cancelDelete = () => {
    console.log('Delete cancelled'); // Debugging line
    showDeleteModal.value = false;
    userToDelete.value = null;
};
</script>
