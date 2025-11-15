<template>
    <button
        type="button"
        role="checkbox"
        :aria-checked="isChecked"
        :disabled="disabled"
        @click="toggle"
        @keydown.space.prevent="toggle"
        @keydown.enter.prevent="toggle"
        class="size-5 !rounded-lg border !border-border outline-none transition-colors focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring disabled:cursor-not-allowed cursor-pointer"
        :class="[
      isChecked
        ? 'bg-primary border-primary-border text-primary-foreground'
        : variant === 'input'
          ? 'bg-input border-input'
          : 'bg-input-foreground border-input-foreground ',
      disabled && 'opacity-50 pointer-events-none',
    ]"
    >
    <span
        v-if="isChecked"
        class="flex items-center justify-center text-current pointer-events-none"
    >
      <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="size-3.5"
      >
        <path d="M20 6 9 17l-5-5" />
      </svg>
    </span>
    </button>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps({
    modelValue: { type: [Boolean, Array], required: true },
    value: { type: [String, Number, Boolean], default: true },
    disabled: { type: Boolean, default: false },
    variant: {
        type: String as () => 'input' | 'input-foreground',
        default: 'input',
    },
})

const emit = defineEmits(['update:modelValue'])

const isChecked = computed(() => {
    if (Array.isArray(props.modelValue)) {
        return props.modelValue.includes(props.value)
    }
    return props.modelValue
})

function toggle() {
    if (props.disabled) return

    if (Array.isArray(props.modelValue)) {
        const newValue = [...props.modelValue]
        const index = newValue.indexOf(props.value)
        if (index > -1) newValue.splice(index, 1)
        else newValue.push(props.value)
        emit('update:modelValue', newValue)
    } else {
        emit('update:modelValue', !props.modelValue)
    }
}
</script>
