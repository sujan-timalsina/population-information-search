<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    'countries': Array,
})

const form = useForm({
    country_id: '',
    city: '',
});

const submit = () => {
    form.post(route('city.store'), {
        onFinish: () => {
            form.reset('country_id')
            form.reset('city')
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
                    <select v-model="form.country_id" id="country_id" name="country_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option v-for="country in props.countries" :key="country.id" :value="country.id">
                            {{ country.country }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.country_id" />
                </div>
                <div>
                    <InputLabel for="city" value="City Name" />

                    <TextInput id="city" type="text" class="mt-1 block w-full" v-model="form.city" required autofocus
                        autocomplete="city" />

                    <InputError class="mt-2" :message="form.errors.city" />
                </div>

                <div class="flex items-center justify-end mt-4">

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add City
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </MainLayout>
</template>