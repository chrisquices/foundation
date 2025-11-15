<template>
    <div class="flex items-center gap-2">
        <label v-if="flipped" class="text-sm cursor-pointer" @click="toggle">{{ label }}</label>
        <button
            type="button"
            role="switch"
            :aria-checked="modelValue"
            :class="[
                'inline-flex cursor-pointer items-center rounded-full transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2',
                modelValue ? 'bg-primary' : 'bg-text-muted',
                sizeClasses.toggle
            ]"
            @click="toggle"
        >
            <span
                :class="[
                    'pointer-events-none block rounded-full !bg-switch-accent shadow-lg transform transition-transform',
                    modelValue ? sizeClasses.circleTranslateOn : sizeClasses.circleTranslateOff,
                    sizeClasses.circle
                ]"
            ></span>
        </button>
        <label v-if="!flipped" class="text-sm cursor-pointer" @click="toggle">{{ label }}</label>
    </div>
</template>

<script>
export default {
    name: "Switch",
    props: {
        modelValue: {
            type: Boolean,
            required: true,
        },
        label: {
            type: String,
            default: null,
        },
        size: {
            type: String,
            default: 'normal',
            validator: (value) => {
                return ['small', 'normal', 'large'].includes(value);
            },
        },
        flipped: {
            type: Boolean,
            default: false,
        }
    },

    emits: ["update:modelValue"],

    computed: {
        sizeClasses() {
            const sizes = {
                small: {
                    toggle: 'h-4 w-6',
                    circle: 'h-3 w-3',
                    circleTranslateOn: 'translate-x-2.5',
                    circleTranslateOff: 'translate-x-0.5',
                },
                normal: {
                    toggle: 'h-6 w-10',
                    circle: 'h-4 w-4',
                    circleTranslateOn: 'translate-x-5',
                    circleTranslateOff: 'translate-x-1',
                },
                large: {
                    toggle: 'h-8 w-14',
                    circle: 'h-6 w-6',
                    circleTranslateOn: 'translate-x-7',
                    circleTranslateOff: 'translate-x-1',
                },
            };
            return sizes[this.size];
        },
    },

    methods: {
        toggle() {
            this.$emit("update:modelValue", !this.modelValue);
        },
    },
};
</script>
