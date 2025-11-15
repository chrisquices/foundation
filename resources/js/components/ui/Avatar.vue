<template>
    <div
        :class="[
      'relative flex shrink-0 overflow-hidden',
      sizeClass,
      roundedClass
    ]"
    >
        <img
            class="aspect-square size-full"
            :alt="alt || 'avatar'"
            :src="src"
        />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

type AvatarSize = 'small' | 'normal' | 'large'
type AvatarRounded = 'full' | 'semi'

const props = defineProps<{
    src: string
    alt?: string
    size?: AvatarSize
    rounded?: AvatarRounded
}>()

const sizeClass = computed(() => {
    switch (props.size) {
        case 'small':
            return 'w-8 h-8'
        case 'large':
            return 'w-16 h-16'
        default:
            return 'w-12 h-12'
    }
})

const roundedClass = computed(() =>
    props.rounded === 'semi' ? 'rounded-2xl' : 'rounded-full'
)
</script>
