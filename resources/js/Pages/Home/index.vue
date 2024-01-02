<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    'countries': Array,
    'highestCoutriesByPopulation': Array,
    'ageGroupstats': Array,
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
    form.post(route('home.post'))
}


const submit = () => {
    form.post(route('home.post'), {
        onFinish: () => {
            // form.reset('country_id')
            // form.reset('city')
        },
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

        <table class="divide-y divide-gray-200 mx-auto my-8 text-2xl">
            <thead class="bg-gray-50">
                <tr v-for="ageGroup in ageGroupstats">
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ ageGroup.age_group }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                <tr v-for="({ id, country_name, total_population }, index) in props.highestCoutriesByPopulation" :key="id">
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