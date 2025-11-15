<template>
    <div
        role="alert"
        :class="[
      'relative w-full border rounded-lg px-4 py-3 text-sm gap-x-4 text-text flex items-center',
      bgClass,
      borderClass
    ]"
    >
        <!-- Icon Slot -->
        <div class="flex-shrink-0">
            <slot name="icon"></slot>
        </div>

        <!-- Title + Message -->
        <div class="space-y-2 flex flex-col mt-1">
            <!-- Title Slot -->
            <div class="font-medium tracking-tight">
                <slot name="title"></slot>
            </div>

            <!-- Message Slot (optional) -->
            <div v-if="$slots.message" class="text-sm">
                <slot name="message"></slot>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

type AlertType = 'restorative' | 'destructive' | 'warning' | 'info'

const props = defineProps<{
    type?: AlertType
}>()

const bgClass = computed(() => {
    switch (props.type) {
        case 'restorative':
            return 'bg-restorative/75 !text-restorative-foreground'
        case 'destructive':
            return 'bg-destructive/75 !text-destructive-foreground'
        case 'warning':
            return 'bg-warning/75 !text-warning-foreground'
        case 'info':
        default:
            return 'bg-info/75 !text-info-foreground'
    }
})

const borderClass = computed(() => {
    switch (props.type) {
        case 'restorative':
            return 'border-restorative'
        case 'destructive':
            return 'border-destructive'
        case 'warning':
            return 'border-warning'
        case 'info':
        default:
            return 'border-info'
    }
})
</script>
