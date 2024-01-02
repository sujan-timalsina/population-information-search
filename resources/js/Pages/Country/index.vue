<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    country: '',
});

const submit = () => {
    form.post(route('country.store'), {
        onFinish: () => form.reset('country'),
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
                <div>
                    <InputLabel for="country" value="Country Name" />

                    <TextInput id="country" type="text" class="mt-1 block w-full" v-model="form.country" required autofocus
                        autocomplete="country" />

                    <InputError class="mt-2" :message="form.errors.country" />
                </div>

                <div class="flex items-center justify-end mt-4">

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add Country
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </MainLayout>
</template>