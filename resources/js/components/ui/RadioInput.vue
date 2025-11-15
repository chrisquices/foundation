<template>
    <div class="flex items-center space-x-2">
        <input
            type="radio"
            :id="id"
            :name="name"
            :value="value"
            :checked="modelValue === value"
            @change="updateValue"
            class="peer h-4 w-4 rounded-full border border-border appearance-none bg-input accent-accent checked:bg-accent"
            style="background-image: none;"
            v-bind="$attrs"
        />
        <label
            :for="id"
            class="text-sm leading-none text-text peer-checked:text-selected-label"
        >
            <slot>{{ label }}</slot>
        </label>
    </div>
</template>

<script>
export default {
    name: "RadioInput",
    props: {
        id: {
            type: String,
            required: true,
        },
        name: {
            type: String,
            required: true,
        },
        value: {
            type: [String, Number],
            required: true,
        },
        modelValue: {
            type: [String, Number],
            required: true,
        },
        label: {
            type: String,
            default: "",
        },
    },
    emits: ["update:modelValue"],
    methods: {
        updateValue(event) {
            this.$emit("update:modelValue", event.target.value);
        },
    },
};
</script>
