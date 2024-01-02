<template>
    <select :value="selectedValue" @change="$emit('input', $event.target.value)">
        <option v-for="option in options" :key="option.key" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>

<script>
export default {
    props: {
        options: {
            type: Array,
            required: true,
        },
        value: {
            type: String | Number,
        },
    },
    computed: {
        selectedValue: {
            get() {
                return this.value;
            },
            set(newValue) {
                this.$emit('input', newValue);
            },
        },
    },
};
</script>