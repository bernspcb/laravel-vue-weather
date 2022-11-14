<template>
    <header class="top-0 shadow-lg">
        <nav class="container flex flex-col sm:flex-row items-center gap-4 text-white py-6">

            <router-link :to="{ name: 'Home' }">
                <div class="flex items-center gap-3" @click="resetValues">
                    <p class="text-xl">Home</p>
                </div>
            </router-link>
        </nav>
    </header>
</template>

<script>
import { inject } from 'vue';

export default {
    name: "Navigation",
    setup() {
        const store = inject('store');

        return {
            store
        }
    },
    methods: {
        resetValues() {
            this.store.state.cityLocations = {};
        }
    },
    mounted() {
        this.resetValues();
    }
}
</script>