<template>
    <div class="flex flex-col min-h-screen bg-gray-400">
        <Navigation />
        <router-view />
    </div>
</template>

<script>
import Navigation from './components/Navigation.vue';
import { provide } from 'vue';
import store from './store';

export default {
    name: 'App',
    components: {
        Navigation
    },
    setup() {
        provide('store', store);
    }
}
</script>
