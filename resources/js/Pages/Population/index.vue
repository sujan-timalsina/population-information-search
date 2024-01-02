<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    'countries': Array,
})

const selectedCities = ref([]);

// console.log(props.countries);

const form = useForm({
    country_id: '',
    city_id: '',
    age_group: '',
    male_population: '',
    female_population: '',
});

const selectCityList = () => {
    const country = props.countries.filter(country => country.id === form.country_id);
    selectedCities.value = country[0].cities;
}


const submit = () => {
    form.post(route('population.store'), {
        onFinish: () => {
            form.reset('country_id')
            // form.reset('city')
        },
    });
};
</script>

<template>
    <MainLayout>

        <div v-if="$page.props.flash.message" class="bg-green-500 text-white px-4 py-3 rounded-lg mb-4">
            {{ $page.props.flash.message }}
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mx-auto">
            <form @submit.prevent="submit">

                <div class="my-2">
                    <InputLabel for="country_id" value="Country Name" />
                    <select v-model="form.country_id" id="country_id" name="country_id" @change="selectCityList"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option v-for="country in props.countries" :key="country.id" :value="country.id">
                            {{ country.country }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.country_id" />
                </div>
                <div class="my-2">
                    <InputLabel for="city_id" value="City Name" />
                    <select v-model="form.city_id" id="city_id" name="city_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option v-for="city in selectedCities" :key="city.id" :value="city.id">
                            {{ city.city }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.city_id" />
                </div>

                <div class="my-2">
                    <InputLabel for="age_group" value="Age Group" />
                    <select v-model="form.age_group" id="age_group" name="age_group"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option value="Old">Old</option>
                        <option value="Young">Young</option>
                        <option value="Child">Child</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.age_group" />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <InputLabel for="male_population" value="Male" />

                        <TextInput id="male_population" type="number" class="mt-1 block w-full"
                            v-model="form.male_population" required autofocus autocomplete="male_population" />

                        <InputError class="mt-2" :message="form.errors.male_population" />
                    </div>
                    <div>
                        <InputLabel for="female_population" value="Female" />

                        <TextInput id="female_population" type="number" class="mt-1 block w-full"
                            v-model="form.female_population" required autofocus autocomplete="female_population" />

                        <InputError class="mt-2" :message="form.errors.female_population" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add Population
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </MainLayout>
</template>