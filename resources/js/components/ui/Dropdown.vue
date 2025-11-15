<template>
    <div class="relative inline-block xl:w-auto" ref="dropdownRef">
        <div @click="toggleDropdown" ref="triggerRef" class="cursor-pointer">
            <slot name="trigger"></slot>
        </div>

        <transition
            enter-active-class="animate__animated animate__fadeIn ultra-fast"
            leave-active-class="animate__animated animate__fadeOut ultra-fast"
        >
            <div
                v-if="isOpen"
                class="absolute mt-2 rounded-lg shadow-lg !z-[120] text-sm"
                tabindex="-1"
                :class="{
                  'right-0': direction === 'left',
                  'left-0': direction === 'right',
                }"
            >
                <Card
                    class="!p-0 !bg-card border border-border"
                    :style="{
    width: 'auto',
    minWidth: triggerWidth + 'px',
  }"
                    @click="handleOptionClick"
                >
                    <slot name="content"></slot>
                </Card>
            </div>
        </transition>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, onUpdated } from 'vue'
import Card from '@/components/ui/Card.vue'

defineOptions({ name: 'Dropdown' })

type Direction = 'left' | 'right'

const props = defineProps<{
    direction?: Direction
    closeTriggerOnClick?: boolean
    closeContentOnClick?: boolean
    width?: string
}>()

const {
    direction = 'right',
    closeTriggerOnClick = true,
    closeContentOnClick = true,
    width = 'auto',
} = props

// Refs
const dropdownRef = ref<HTMLElement | null>(null)
const triggerRef = ref<HTMLElement | null>(null)
const isOpen = ref(false)
const triggerWidth = ref(0)

// --- Methods ---
const updateTriggerWidth = () => {
    if (triggerRef.value) {
        triggerWidth.value = triggerRef.value.offsetWidth
    }
}

const closeDropdown = () => {
    isOpen.value = false
}

const toggleDropdown = () => {
    if (isOpen.value && closeTriggerOnClick) {
        closeDropdown()
    } else {
        isOpen.value = true
        updateTriggerWidth()
    }
}

const handleOptionClick = () => {
    if (closeContentOnClick) closeDropdown()
}

const handleClickOutside = (event: MouseEvent) => {
    const path = (event.composedPath && event.composedPath()) || []
    if (!path.includes(dropdownRef.value)) {
        closeDropdown()
    }
}

// --- Lifecycle ---
onMounted(() => {
    updateTriggerWidth()
    window.addEventListener('resize', updateTriggerWidth)
    document.addEventListener('mousedown', handleClickOutside)
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', updateTriggerWidth)
    document.removeEventListener('mousedown', handleClickOutside)
})

onUpdated(updateTriggerWidth)
</script>

<style scoped>
.ultra-fast {
    --animate-duration: 0.2s;
}
</style>
