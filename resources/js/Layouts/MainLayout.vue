<template>
    <FlashMessage
        v-if="$page.props.flash && $page.props.flash.success"
        :message="$page.props.flash.success"
        type="success"
    />
    <FlashMessage
        v-if="$page.props.flash && $page.props.flash.error"
        :message="$page.props.flash.error"
        type="error"
    />
    <LoadingOverlay :logoUrl="logoUrl" />
    <slot :logoUrl="logoUrl" :googleIconUrl="googleIconUrl" :facebookIconUrl="facebookIconUrl"></slot>
</template>

<script setup>
import {Link, usePage } from '@inertiajs/inertia-vue3';
import { ref,onMounted,computed,reactive, toRefs } from 'vue';
import LoadingOverlay from '@/Components/LoadingOverlay.vue';
import FlashMessage from '@/Components/FlashMessage.vue';


// Log the loginProps to see its structure

// Directly set the logo URL
const logoUrl = '/images/logo-dark.png'; // Adjust the path to your logo
const googleIconUrl = '/images/google-icon.png'; // Set the path for Google icon
const facebookIconUrl = '/images/facebook-icon.png';
</script>
