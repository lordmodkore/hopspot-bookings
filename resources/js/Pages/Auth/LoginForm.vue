<template>
    <!-- But this doesn't, it's empty :( -->
    <div class="relative overflow-hidden bg-gray-100 min-h-screen">
        <div class="relative z-5">
            <div class="flex flex-col lg:flex-row">
                <div class="hidden lg:flex lg:w-1/2 items-center justify-center h-screen">
                    <img :src="props.logoUrl" alt="Logo" class="img-fluid" width="500">
                </div>
                <div class="lg:w-1/2 flex items-center justify-center min-h-screen bg-white p-4">
                    <div class="w-full max-w-md">
                        <h2 class="text-2xl font-bold mb-3 text-center">Welcome to HopSpot Admin</h2>
                        <!-- Flash Messages -->
                        <div v-if="flash.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <span class="block sm:inline">{{ flash.error }}</span>
                        </div>

                        <div v-if="flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            <span class="block sm:inline">{{ flash.success }}</span>
                        </div>
                        <!-- Social Login Buttons -->
                        <div class="flex space-x-4 mb-4">
                            <button @click="signInWithGoogle" class="flex-1 bg-white border border-gray-300 text-gray-800 py-2 rounded-md flex items-center justify-center hover:bg-gray-100 transition">
                                <img :src="props.googleIconUrl" alt="Google Icon" class="mr-2" width="18" height="18">
                                <span>Sign in with Google</span>
                            </button>
                            <button @click="signInWithFacebook" class="flex-1 bg-white border border-gray-300 text-gray-800 py-2 rounded-md flex items-center justify-center hover:bg-gray-100 transition">
                                <img :src="props.facebookIconUrl" alt="Facebook Icon" class="mr-2" width="18" height="18">
                                <span>Sign in with FB</span>
                            </button>
                        </div>

                        <div class="relative text-center my-4">
                            <p class="bg-white text-gray-800 px-3 inline-block relative z-10">or sign in with</p>
                            <span class="border-t w-full absolute top-1/2 left-0"></span>
                        </div>

                        <form @submit.prevent="login">
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Username</label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    id="email"
                                    class="border border-gray-300 rounded-md w-full p-2"
                                    placeholder="you@example.com"
                                    :class="{ 'border-red-500': form.errors.email }"
                                />
                                <!-- Display error message for email -->
                                <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email[0] }}</p>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Password</label>
                                <input
                                    v-model="form.password"
                                    type="password"
                                    id="password"
                                    class="border border-gray-300 rounded-md w-full p-2"
                                    :class="{ 'border-red-500': form.errors.password }"
                                    placeholder="********"
                                />
                                <!-- Display error message for email -->
                                <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password[0] }}</p>

                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        id="remember_me"
                                        v-model="form.remember_me"
                                        class="mr-2"
                                    />
                                    <label for="remember_me" class="text-gray-600">Remember this Device</label>
                                </div>
                                <a class="text-blue-600" href="{{route('forgot')}}">Forgot Password?</a>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Sign In</button>
                            <div class="flex justify-center items-center mt-4">
                                <p class="text-gray-600">No Account yet?</p>
                                <a class="text-blue-600 ml-2" href="{{route('signup')}}">Create an account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps,ref } from 'vue';
import LoadingOverlay from '@/Components/LoadingOverlay.vue';

// Define your own props for additional URLs
const props = defineProps({
    flash: Object,
    logoUrl: String,
    googleIconUrl: String,
    facebookIconUrl: String,
});

// Initialize the form
const form = useForm({
    email: null,
    password: null,
    remember_me: false,
});


// Form submit handler
const login = () => form.post(route('processLogin'));
// Sign in with Google
const signInWithGoogle = () => {
    window.location.href = route('auth.google'); // Redirect to Laravel for Google authentication
};
// Sign in with Facebook
const signInWithFacebook = () => {
    window.location.href = route('auth.facebook'); // Redirect to Laravel for Facebook authentication
};

</script>

