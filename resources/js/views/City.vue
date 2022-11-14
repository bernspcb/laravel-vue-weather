<template>
    <main class="container flex flex-wrap items-center gap-4 py-5 mx-auto justify-center" :key="store.state.city.id"> 
        <div v-if="store.state.fetching === false">
            <div class="text-white mb-8">
                <div class="weather-container lg:w-144 max-w-lg rounded-lg overflow-hidden bg-gray-900 shadow-lg mt-4">
                    <div class="current-weather flex items-center justify-between px-6 py-9">
                        <div class="flex items-center">
                            <div>
                                <div class="text-5xl font-semibold">{{ store.state.cityWeather.main.temp }}°C</div>
                                <div>Feels like {{ store.state.cityWeather.main.feels_like }}°C</div>
                            </div>
                        </div>
                        <div class="mx-5">
                            <div class="font-semibold">{{ capitalizeFirstLetter(store.state.cityWeather.weather[0].description) }}</div>
                            <div>{{ store.state.cityWeather.name }}, {{ store.state.cityWeather.sys.country }}</div>
                        </div>
                        <div><img :src="handleWeatherIcon(store.state.cityWeather.weather[0].icon)" alt="weather icon"></div>
                    </div>
                </div>

                <div class="pt-4 mb-8 relative">
                    <form>   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input
                                type="search" 
                                id="default-search" 
                                class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:outline-none border border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Search for Coffee Shops, Malls..." 
                                required
                                v-model="searchQuery"
                            />
                            <button 
                                type="submit" 
                                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
                                @click.prevent="handleFetchLocation(searchQuery)"
                            >
                            Search
                            </button>
                        </div>
                    </form>
                    {{ store.state.errors }}
                </div>
            </div>
        </div>
        <div
            class="container flex flex-wrap md:flex-row items-center gap-3 py-2"
            v-if="store.state.fetchingLocations === false && store.state.cityLocations != null"
        >
            <div class="w-96" v-for="location in store.state.cityLocations" :key="location.place.fsq_id">
                <div class="block p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ location.text.primary }}</h5>
                    <p class="font-bold">Address: 
                        <span v-if="location.place.location.formatted_address.length != 0" class="font-normal text-gray-700"> {{ location.place.location.formatted_address }}</span>
                        <span v-else class="font-normal text-gray-700"> NONE</span>
                    </p>
                </div>
            </div>
        </div>
        <div 
            class="container flex flex-wrap md:flex-row items-center gap-3 py-2"
            v-if="store.state.cityLocations.length === 0"
        >
            <p>No Search data</p>
        </div>
    </main>
</template>
<script>
import { inject } from 'vue';

export default {
    name: "City",
    setup() {
        const store = inject('store');

        return {
            store
        }
    },
    data() {
        return {
            searchQuery: ''
        }
    },
    async created() {
        await this.store.methods.fetchWeather();
    },
    methods: {
        handleWeatherIcon(newIcon) {
            this.store.state.fetching = true;
            let setIcon = 'https://openweathermap.org/img/wn/' + newIcon + '@2x.png';
            this.store.state.fetching = false;
            return setIcon;
        },
        async handleFetchLocation(searchQuery) {
            let trimSearch = searchQuery.replace(/^\s+|\s+$/gm,'');
            
            if (trimSearch.length === 0) {
                return 0;
            } else {
                await this.store.methods.fetchLocations(trimSearch);
            }
        },
        capitalizeFirstLetter(newString) {
            return newString.charAt(0).toUpperCase() + newString.slice(1);
        }
    }
}
</script>