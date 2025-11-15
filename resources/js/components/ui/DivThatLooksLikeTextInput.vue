<template>
    <div
        ref="input"
        class="rounded px-3 py-1 focus:ring-2 focus:ring-accent focus:border-accent focus:outline-none disabled:opacity-50 text-text flex items-center"
        :class="[
            sizeClasses[size],
            colorClasses[color],
        ]"
        v-bind="$attrs"
    >
        <slot />
    </div>
</template>

<script setup lang="ts">
defineOptions({ name: 'DivThatLooksLikeTextInput' })

type Size = 'small' | 'normal' | 'large'
type Color = 'input' | 'inputForeground'

const props = defineProps<{
    size?: Size
    color?: Color
}>()

const { size = 'normal', color = 'input' } = props

const sizeClasses: Record<Size, string> = {
    small: 'text-sm h-8 px-2.5 py-1.5',
    normal: 'text-sm h-10 px-3 py-2',
    large: 'text-base h-10 px-3.5 py-3',
}

const colorClasses: Record<Color, string> = {
    input: 'bg-input',
    inputForeground: 'bg-input-foreground',
}
</script>
