<template>
    <div
        :class="[
      'inline-flex items-center justify-center font-medium whitespace-nowrap shrink-0 gap-1.5',
      'rounded-lg border overflow-hidden',
      'px-4',
      sizeClasses[size],
      outline ? outlineClasses[variant] : filledClasses[variant],
    ]"
    >
        <slot name="icon"></slot>
        <slot />
    </div>
</template>

<script setup lang="ts">
type Variant =
    | 'primary'
    | 'secondary'
    | 'transparent'
    | 'restorative'
    | 'destructive'
    | 'warning'
    | 'info'

type Size = 'small' | 'normal' | 'large'

const props = defineProps<{
    variant?: Variant
    outline?: boolean
    size?: Size
}>();

const sizeClasses: Record<Size, string> = {
    small: 'h-4 text-xs',
    normal: 'h-6 text-sm',
    large: 'h-8 text-base'
};

const filledClasses: Record<Variant, string> = {
    primary: 'bg-primary text-primary-foreground border border-primary',
    secondary: 'bg-secondary text-secondary-foreground border border-secondary',
    transparent: 'bg-transparent text-transparent-foreground border border-transparent',
    restorative: 'bg-restorative text-restorative-foreground border border-restorative',
    destructive: 'bg-destructive text-destructive-foreground border border-destructive',
    warning: 'bg-warning text-warning-foreground border border-warning',
    info: 'bg-info text-info-foreground border border-info'
};

const outlineClasses: Record<Variant, string> = {
    primary: 'border-primary bg-transparent',
    secondary: 'border-secondary bg-transparent',
    transparent: 'border-foreground bg-transparent',
    restorative: 'border-restorative bg-transparent',
    destructive: 'border-destructive bg-transparent',
    warning: 'border-warning bg-transparent',
    info: 'border-info bg-transparent'
};

const { variant = 'primary', outline = false, size = 'normal' } = props;
</script>
