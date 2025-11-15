<!-- components/ui/Spinner.vue -->
<template>
    <div
        class="inline-flex items-center justify-center text-text"
        role="status"
        aria-live="polite"
    >
        <LoaderCircle class="animate-spin" :class="sizeClasses[size || 'normal']" />
    </div>
</template>

<script setup lang="ts">
import { LoaderCircle } from 'lucide-vue-next'

type Size = 'small' | 'normal' | 'large'

defineProps<{
    size?: Size
}>()

const sizeClasses: Record<Size, string> = {
    small: 'h-3 w-3',
    normal: 'h-4 w-4',
    large: 'h-5 w-5',
}
</script>
