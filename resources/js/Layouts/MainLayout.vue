<template>
    <LoadingOverlay :logoUrl="logoUrl" />
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot></slot>
</template>

<script setup>
import {ref} from "vue";
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'
import LoadingOverlay from '@/Components/LoadingOverlay.vue';
const page = usePage()
const flashSuccess = computed(() => page.props.flash?.success);
const flashError = computed(() => page.props.flash?.error);
// Directly set the logo URL
const logoUrl = '/images/logo-dark.png'; // Adjust the path to your logo
</script>
