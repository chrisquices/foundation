<template>
    <div
        v-if="open"
        class="fixed inset-0 z-50 flex items-start justify-center bg-black/50 backdrop-blur-sm p-4"
        @keydown.esc="close"
    >
        <div
            class="w-full max-w-lg rounded-xl border border-border bg-card shadow-xl overflow-hidden"
            @click.stop
        >
            <!-- Search input -->
            <div class="flex items-center border-b border-border px-4 py-2">
                <i class="lni lni-search text-text-muted mr-2"></i>
                <input
                    v-model="query"
                    ref="inputRef"
                    placeholder="Type a command or search..."
                    class="w-full bg-transparent text-sm text-foreground placeholder:text-muted outline-none"
                />
            </div>

            <!-- Command results -->
            <div class="max-h-80 overflow-y-auto text-sm">
                <slot name="section" :query="query" :close="close"></slot>

                <div v-if="!hasResults" class="px-4 py-6 text-center text-muted text-sm">
                    No matching commands
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, nextTick, computed } from 'vue'

defineOptions({ name: 'Command' })

const props = defineProps<{ open: boolean }>()
const emit = defineEmits(['close'])

const query = ref('')
const inputRef = ref<HTMLInputElement | null>(null)
const hasResults = ref(true)

const close = () => {
    emit('close')
    query.value = ''
}

onMounted(() => {
    nextTick(() => inputRef.value?.focus())
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close()
    })
})

onBeforeUnmount(() => {
    window.removeEventListener('keydown', () => close())
})
</script>
