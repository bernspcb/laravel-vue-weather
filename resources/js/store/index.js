import { reactive } from "vue";

const state = reactive({
    city: {},
    cityWeather: {},
    cityLocations: {},
    response: [],
    errors: null,
    fetching: true,
    fetchingLocations: true
});

const methods = {
    setCity(newCity) {
        state.city = newCity;
    },
    async fetchWeather() {
        try {
            await axios.get(`/api/weather?latitude=${state.city.latitude}&longitude=${state.city.longitude}`)
            .then(data => {
                state.cityWeather = data.data;
            });
        } catch (errors) {
            state.errors = errors
        } finally {
            state.fetching = false;
        }
    },
    async fetchLocations(query) {
        try {
            await axios.get(`/api/location?search=${query}&ll=${state.city.latitude},${state.city.longitude}`)
            .then(data => {
                state.cityLocations = data.data;
            });
        } catch (errors) {
            state.errors = errors
        } finally {
            state.fetchingLocations = false;
        }
    }
}

export default {
    state,
    methods
};