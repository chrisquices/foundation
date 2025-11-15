<template>
    <label class="text-text font-medium leading-none disabled:cursor-not-allowed disabled:opacity-70"
           :class="[
                sizeClasses[size],
            ]"
    >
        <slot/>
    </label>
</template>

<script>
export default {
    name: "TextLabel",

    props: {
        size: {
            type: String,
            default: 'normal',
            validator: (value) => {
                return ['small', 'normal', 'large'].includes(value);
            },
        },
    },

    computed: {
        sizeClasses() {
            return {
                small: 'text-sm h-6 py-1.5',
                normal: 'text-sm h-8 py-2',
                large: 'text-base h-10 py-3',
            };
        },
    }
};
</script>
