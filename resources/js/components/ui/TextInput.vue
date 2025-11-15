<template>
    <input
        ref="input"
        :type="attrs.type || 'text'"
        class="rounded-lg px-4 py-1 border border-border focus:border-primary focus:outline-none disabled:opacity-50 text-text focus:ring-2 focus:ring-primary"
        :class="[
            sizeClasses[size],
            variantClasses[variant],
            isCheckbox ? checkboxVariantClasses[variant] : ''
        ]"
        :value="displayValue"
        @input="handleInput"
        v-bind="attrs"
    >
</template>

<script setup lang="ts">
import { computed, ref, useAttrs } from 'vue'

/* ------------------ Props ------------------ */

interface Currency {
    id: number
    code: string
    symbol: string
    thousands_separator: string
    decimal_separator: string
    decimal_points: number
}

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    size: {
        type: String as () => 'small' | 'normal' | 'large',
        default: 'normal'
    },
    variant: {
        type: String as () => 'input' | 'input-foreground',
        default: 'input'
    },
    isMoney: {
        type: Boolean,
        default: false
    },
    currency: {
        type: Object as () => Currency,
        default: () => ({
            id: 1,
            code: 'USD',
            symbol: '$',
            thousands_separator: ',',
            decimal_separator: '.',
            decimal_points: 2
        })
    }
})

const emit = defineEmits(['update:modelValue'])
const attrs = useAttrs()

const input = ref<HTMLInputElement | null>(null)

/* ------------------ Classes ------------------ */

const sizeClasses = {
    small: 'text-sm h-8 px-2.5 py-1.5',
    normal: 'text-sm h-10 px-3 py-2',
    large: 'text-base h-10 px-3.5 py-3'
}

const variantClasses = {
    input: 'bg-input',
    'input-foreground': 'bg-input-foreground'
}

const checkboxVariantClasses = {
    input: '!text-lg !rounded-full focus:!ring-0 accent-primary',
    'input-foreground': 'focus:!ring-0 accent-primary'
}

/* ------------------ Computed ------------------ */

const isCheckbox = computed(() => attrs.type === 'checkbox')

const displayValue = computed(() => props.modelValue?.toString() ?? '')

/* ------------------ Methods ------------------ */

function handleInput(event: Event) {
    const target = event.target as HTMLInputElement
    let raw = target.value

    if (!props.isMoney || !props.currency) {
        emit('update:modelValue', raw)
        return
    }

    const dec = props.currency.decimal_separator
    const points = props.currency.decimal_points

    const escapedDec = dec.replace(/[-/\\^$*+?.()|[\]{}]/g, '\\$&')
    const allowedCharsRegex = new RegExp(`[^\\d${escapedDec}]`, 'g')

    raw = raw.replace(allowedCharsRegex, '')

    const parts = raw.split(dec)
    let whole = parts[0]
    let decimal = parts[1] ?? ''

    if (points === 0) {
        raw = whole
    } else {
        decimal = decimal.slice(0, points)
        raw = whole + (parts.length > 1 ? dec + decimal : '')
    }

    if (target.value !== raw) {
        target.value = raw
    }

    emit('update:modelValue', raw)
}

function focus() {
    input.value?.focus()
}

function click() {
    input.value?.click()
}
</script>
