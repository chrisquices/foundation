<template>
    <button v-bind="$attrs" :class="classes" type="button">
        <slot name="icon"></slot>
        <slot />
    </button>
</template>

<script setup lang="ts">
import { computed } from 'vue'

type Variant =
    | 'primary'
    | 'secondary'
    | 'transparent'
    | 'restorative'
    | 'destructive'
    | 'warning'
    | 'info'
    | 'input'
    | 'input-foreground'

type Size = 'small' | 'normal' | 'large'

const props = defineProps<{
    variant?: Variant
    outline?: boolean
    size?: Size
}>()

const variant = computed(() => props.variant ?? 'primary')
const outline = computed(() => props.outline ?? false)
const size = computed(() => props.size ?? 'normal')

const sizeClasses: Record<Size, string> = {
    small: 'h-8 text-xs',
    normal: 'h-10 text-sm',
    large: 'h-12 text-base',
}

const filledClasses: Record<Variant, string> = {
    primary: 'bg-primary text-primary-foreground border border-primary-border hover:bg-primary/90 focus:ring-primary-border',
    secondary: 'bg-secondary text-secondary-foreground border border-secondary-border hover:bg-secondary/90 focus:ring-secondary-border',
    transparent: 'bg-transparent text-text border border-transparent hover:bg-foreground/10 focus:ring-border',
    restorative: 'bg-restorative text-restorative-foreground border border-restorative-border hover:bg-restorative/90 focus:ring-restorative-border',
    destructive: 'bg-destructive text-destructive-foreground border border-destructive-border hover:bg-destructive/90 focus:ring-destructive-border',
    warning: 'bg-warning text-warning-foreground border border-warning-border hover:bg-warning/90 focus:ring-warning-border',
    info: 'bg-info text-info-foreground border border-info-border hover:bg-info/90 focus:ring-info-border',
    input: 'bg-input text-text border border-border hover:bg-input/90 focus:ring-border',
    'input-foreground': 'bg-input-foreground text-foreground border border-input-foreground-border hover:bg-input-foreground/90 focus:ring-input-foreground-border',
}

const outlineClasses: Record<Variant, string> = {
    primary: 'border-primary bg-transparent text-primary hover:bg-primary/20 focus:ring-primary-border',
    secondary: 'border-secondary bg-transparent text-secondary-foreground hover:bg-secondary/20 focus:ring-secondary-border',
    transparent: 'border-transparent bg-transparent text-foreground-foreground hover:bg-foreground/20 focus:ring-transparent-border',
    restorative: 'border-restorative bg-transparent text-restorative-foreground hover:bg-restorative/20 focus:ring-restorative-border',
    destructive: 'border-destructive bg-transparent text-destructive-foreground hover:bg-destructive/20 focus:ring-destructive-border',
    warning: 'border-warning bg-transparent text-warning-foreground hover:bg-warning/20 focus:ring-warning-border',
    info: 'border-info bg-transparent text-info-foreground hover:bg-info/20 focus:ring-info-border',
    input: 'border-input bg-transparent text-text-foreground hover:bg-input/20 focus:ring-input-border',
    'input-foreground': 'border-input-foreground bg-transparent text-foreground hover:bg-input-foreground/20 focus:ring-input-foreground-border',
}

// ✅ Computed master class list (reactive)
const classes = computed(() => [
    'inline-flex items-center justify-center font-medium whitespace-nowrap shrink-0 gap-1.5 focus:outline-none focus:ring-2',
    'rounded-lg border select-none transition-all duration-200',
    'px-4 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-1',
    'disabled:opacity-50 disabled:pointer-events-none',
    sizeClasses[size.value],
    outline.value ? outlineClasses[variant.value] : filledClasses[variant.value],
    'cursor-pointer hover:opacity-90',
])
</script>
