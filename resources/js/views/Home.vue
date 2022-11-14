<template>
  <main class="container flex flex-wrap md:flex-row items-center gap-4 py-5"> 
    <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md" v-for="city in cities" :key="city.id">
        <!-- <router-link :to="{ name: 'City', params: { name: city.name } }">
            <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="">
        </router-link> -->
        <div class="p-5">
            <router-link :to="{ name: 'City', params: { name: city.name } }">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900" @click="store.methods.setCity(city)">{{ capitalizeFirstLetter(city.name) }}</h5>
            </router-link>
            <p class="mb-3 font-normal text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati laborum voluptas dolore ex alias placeat maxime, aliquid nostrum beatae similique?</p>
            <div @click="store.methods.setCity(city)">
                <router-link 
                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                :to="{ name: 'City', params: { name: city.name } }"
              >
                  Check details
                  <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </router-link>
            </div>
        </div>
    </div>
  </main>
</template>

<script>
import { inject } from 'vue';

export default {
  name: 'Home',
  setup() {
    const store = inject('store');

    return {
      store
    }
  },
  data() {
    return {
      cities: [
        {id: 1, name: "tokyo", latitude: 35.689487, longitude: 139.691711},
        {id: 2, name: "yokohama", latitude: 35.443707, longitude: 139.638031},
        {id: 3, name: "kyoto", latitude: 35.011635, longitude: 135.768036},
        {id: 4, name: "osaka", latitude: 34.693737, longitude: 135.502167},
        {id: 5, name: "sapporo", latitude: 43.062096, longitude: 141.354370},
        {id: 6, name: "nagoya", latitude: 35.172340, longitude: 136.908325}
      ]
    }
  },
  methods: {
    capitalizeFirstLetter(newString) {
      return newString.charAt(0).toUpperCase() + newString.slice(1);
    }
  }

}
</script>

<style>

</style>