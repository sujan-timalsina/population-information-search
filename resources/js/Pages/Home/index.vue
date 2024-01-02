<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';

const props = defineProps({
    'countries': Array,
    'highestCoutriesByPopulation': Array,
    'ageGroupStats': Array,
})

const selectedCities = ref([]);

// console.log(props.countries);

const form = useForm({
    country_id: '',
    city_id: '',
    gender_population: '',
});

const selectCityList = () => {
    const country = props.countries.filter(country => country.id === form.country_id);
    selectedCities.value = country[0].cities;
    submit();
}

watchEffect(() => {
    if (form.country_id) {
        form.city_id = ''; // Reset city_id whenever country_id changes
        form.gender_population = '';
    }
});

const submit = () => {
    form.post(route('home.post'), {
        only: ['ageGroupStats']
    });
};

</script>

<template>
    <MainLayout>

        <div class="w-full sm:max-w-xl mt-6 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto">
            <form @submit.prevent="submit" class="flex gap-4 w-full justify-around">

                <div class="my-2">
                    <InputLabel for="country_id" value="Country Name" />
                    <select v-model="form.country_id" id="country_id" name="country_id" @change="selectCityList"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full min-w-40">
                        <option v-for="country in props.countries" :key="country.id" :value="country.id">
                            {{ country.country }}
                        </option>
                    </select>
                </div>
                <div class="my-2">
                    <InputLabel for="city_id" value="City Name" />
                    <select v-model="form.city_id" id="city_id" name="city_id" @change="submit"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full min-w-40">
                        <option v-for="city in selectedCities" :key="city.id" :value="city.id">
                            {{ city.city }}
                        </option>
                    </select>
                </div>

                <div class="my-2">
                    <InputLabel for="gender_population" value="Age Group" />
                    <select v-model="form.gender_population" id="gender_population" name="gender_population"
                        @change="submit"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full min-w-40">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </form>
        </div>

        <table class="divide-y divide-gray-200 mx-auto my-8">
            <thead class="bg-gray-50">
                <tr v-for="ageGroup in ageGroupStats">
                    <th scope="col" class="px-6 py-3 text-left font-medium text-white uppercase tracking-wider bg-gray-600">
                        {{ ageGroup.age_group }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">
                        {{ ageGroup.total_population }}
                    </th>
                </tr>
            </thead>
        </table>



        <div class="text-center my-4">
            <div class="text-2xl">Summary Report</div>
            <p>Three country with highest population</p>
        </div>
        <table class="max-w-128 divide-y divide-gray-200 mx-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        SN
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Country Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Population
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="({ country_name, total_population }, index) in props.highestCoutriesByPopulation" :key="index">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ index + 1 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ country_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ total_population }}
                    </td>
                </tr>
            </tbody>
        </table>

    </MainLayout>
</template>