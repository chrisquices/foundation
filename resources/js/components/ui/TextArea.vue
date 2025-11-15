<template>
    <textarea
        :value="modelValue"
        ref="input"
        @input="$emit('update:modelValue', $event.target.value)"
        class="rounded-lg p-4 focus:ring-2 focus:ring-accent focus:border-accent focus:outline-none disabled:opacity-50 bg-input text-text w-full"
        :class="[
            colorClasses[color],
        ]"
        v-bind="$attrs"
    ></textarea>
</template>

<script>
export default {
    name: "TextArea",

    props: {
        modelValue: String,

        color: {
            type: String,
            default: 'input',
            validator: value =>
                ['input', 'inputForeground'].includes(value),
        },
    },

    computed: {
        colorClasses() {
            return {
                input: 'bg-input',
                inputForeground: 'bg-input-foreground',
            };
        },
    },

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input && this.$refs.input.focus();
        },

        click() {
            this.$refs.input && this.$refs.input.click();
        }
    }
};
</script>
