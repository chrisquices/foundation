<template>
    <input
        ref="input"
        :type="$attrs.type || 'search'"
        class="w-full rounded-3xl border bg-input lg:w-80 px-4 py-1 border-border focus:ring focus:ring-accent focus:border-accent focus:outline-none disabled:opacity-50 text-text"
        :class="[
      sizeClasses[size],
      colorClasses[color],
    ]"
        :value="displayValue"
        v-bind="$attrs"
        placeholder="Search..."
        autocomplete="off"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>

<script>
export default {
    name: 'TextInputSearch',

    props: {
        modelValue: {
            type: [String, Number],
            default: ''
        },

        size: {
            type: String,
            default: 'normal',
            validator: value => ['small', 'normal', 'large'].includes(value)
        },

        color: {
            type: String,
            default: 'input',
            validator: value => ['input', 'inputForeground'].includes(value)
        }
    },

    computed: {
        sizeClasses() {
            return {
                small: 'text-sm h-8 px-2.5 py-1.5',
                normal: 'text-sm h-10 px-3 py-2',
                large: 'text-base h-10 px-3.5 py-3'
            };
        },

        colorClasses() {
            return {
                input: 'bg-input',
                inputForeground: 'bg-input-foreground'
            };
        },

        displayValue() {
            return this.modelValue?.toString() ?? '';
        }
    },

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
