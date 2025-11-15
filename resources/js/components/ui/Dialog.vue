<template>
    <transition name="fade">
        <teleport to="body">
            <div
                v-if="show"
                class="fixed inset-0 z-70 flex flex-col items-center justify-center space-y-12 p-4"
                @click="handleOutsideClick"
            >
                <!-- Background Layer -->
                <div class="absolute inset-0 h-screen z-0 bg-slate-950/30"></div>

                <!-- Dialog -->
                <div
                    ref="dialog"
                    role="alertdialog"
                    aria-modal="true"
                    class="z-10 space-y-8 p-8 border border-border transform transition-all max-w-lg w-full h-auto max-h-full duration-300 bg-card text-text rounded-xl shadow-lg shadow-shadow"
                    @click.stop
                >
                    <slot />
                </div>
            </div>
        </teleport>
    </transition>
</template>

<script setup lang="ts">
import { ref, watch, nextTick, onBeforeUnmount } from 'vue'

/* ---------- Props & Emits ---------- */
const props = defineProps<{
    show: boolean
    closeOnEsc?: boolean
    closeOnOutsideClick?: boolean
}>()

const emit = defineEmits<{
    (e: 'close'): void
}>()

/* ---------- State ---------- */
const dialog = ref<HTMLElement | null>(null)
let lastFocusedElement: HTMLElement | null = null

/* ---------- Focus trap ---------- */
const trapFocus = (event: FocusEvent) => {
    if (!dialog.value) return
    if (!dialog.value.contains(event.target as Node)) {
        event.stopPropagation()
        dialog.value.focus()
    }
}

/* ---------- Focus helpers ---------- */
const focusFirstElement = async () => {
    await nextTick();
    const root = dialog.value as HTMLElement | null;
    const preferred =
        root?.querySelector<HTMLElement>('[autofocus]') ||
        root?.querySelector<HTMLElement>('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');

    preferred?.focus();
}

/* ---------- Watch show ---------- */
watch(
    () => props.show,
    async (isOpen) => {
        if (isOpen) {
            lastFocusedElement = document.activeElement as HTMLElement
            await focusFirstElement()
            document.addEventListener('focus', trapFocus, true)
        } else {
            document.removeEventListener('focus', trapFocus, true)
            lastFocusedElement?.focus()
        }
    }
)

/* ---------- Event handlers ---------- */
const handleEsc = (event: KeyboardEvent) => {
    if (props.closeOnEsc !== false && event.key === 'Escape') emit('close')
}

const handleOutsideClick = (event: MouseEvent) => {
    if (props.closeOnOutsideClick !== false && dialog.value && !dialog.value.contains(event.target as Node)) {
        emit('close')
    }
}

/* ---------- Lifecycle ---------- */
window.addEventListener('keydown', handleEsc)

onBeforeUnmount(() => {
    window.removeEventListener('keydown', handleEsc)
    document.removeEventListener('focus', trapFocus, true)
})
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
