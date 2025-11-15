<template>
    <div
        tabindex="0"
        class="relative outline-none select-none w-full h-full overflow-hidden"
        @keydown.left.prevent="onKeyLeft"
        @keydown.right.prevent="onKeyRight"
    >
        <!-- Carousel Track -->
        <div class="flex h-full w-full overflow-hidden" :class="roundedClass">
            <div
                v-for="(slot, i) in slots"
                :key="i"
                class="flex-1 h-full overflow-hidden relative"
            >
                <!-- Inner mini-carousel -->
                <div
                    class="flex w-full h-full"
                    :class="slot.animating ? 'transition-transform duration-500 ease-in-out' : 'transition-none'"
                    :style="{ transform: `translateX(${slot.translateX}%)` }"
                    @transitionend="onSlotTransitionEnd(i, $event)"
                >
                    <img
                        :src="slot.prevSrc"
                        :class="['w-full h-full object-cover flex-shrink-0', `order-${slot.orders.prev}`]"
                        alt="prev"
                    />
                    <img
                        :src="slot.currentSrc"
                        :class="['w-full h-full object-cover flex-shrink-0', `order-${slot.orders.current}`]"
                        alt="current"
                    />
                    <img
                        :src="slot.nextSrc"
                        :class="['w-full h-full object-cover flex-shrink-0', `order-${slot.orders.next}`]"
                        alt="next"
                    />
                </div>
            </div>
        </div>

        <!-- Controls -->
        <Button
            ref="prevButton"
            variant="transparent"
            outline
            class="absolute top-1/2 left-3 -translate-y-1/2 !rounded-full !px-2 !bg-black/25 !h-8 !w-8"
            @click="prev"
            @keydown.left.prevent="prev"
            @keydown.right.prevent="next"
        >
            <ChevronLeft :size="24" class=""/>
        </Button>

        <Button
            ref="nextButton"
            variant="transparent"
            outline
            class="absolute top-1/2 right-3 -translate-y-1/2 !rounded-full !px-2 !bg-black/25 !h-8 !w-8"
            @click="next"
            @keydown.left.prevent="prev"
            @keydown.right.prevent="next"
        >
            <ChevronRight :size="24" class=""/>
        </Button>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import Button from '@/components/ui/Button.vue'
import { ChevronRight, ChevronLeft } from 'lucide-vue-next';

type Rounded = 'none' | 'sm' | 'md' | 'lg' | 'xl' | '2xl' | '3xl' | '4xl'

interface SlotState {
    currentIdx: number
    prevSrc: string
    currentSrc: string
    nextSrc: string
    orders: { prev: 1 | 2 | 3; current: 1 | 2 | 3; next: 1 | 2 | 3 }
    animating: boolean
    translateX: number
}

const props = defineProps<{
    images: string[]
    loop?: boolean
    autoplay?: boolean
    speed?: number
    imagesToShow?: number
    rounded?: Rounded
    shuffle?: boolean
}>()

const {
    images,
    loop = true,
    autoplay = false,
    speed = 4000,
    imagesToShow = 1,
    rounded = 'xl',
    shuffle = false,
} = props

const internalImages = ref<string[]>([])
const slots = ref<SlotState[]>([])
const intervalId = ref<number | null>(null)
const pendingDir = ref<'next' | 'prev' | null>(null)

const roundedClass = computed(() =>
    rounded === 'none' ? '' : `rounded-${rounded}`
)

const mod = (n: number, m: number) => ((n % m) + m) % m

const next = () => {
    if (pendingDir.value) return
    pendingDir.value = 'next'
    slots.value.forEach((slot) => {
        slot.animating = true
        slot.translateX = -200
    })
}

const prev = () => {
    if (pendingDir.value) return
    pendingDir.value = 'prev'
    slots.value.forEach((slot) => {
        slot.animating = true
        slot.translateX = 0
    })
}

const onSlotTransitionEnd = (slotIndex: number, e: TransitionEvent) => {
    if (e.propertyName !== 'transform' || !pendingDir.value) return

    const total = internalImages.value.length
    const slot = slots.value[slotIndex]
    slot.animating = false
    slot.translateX = -100

    if (pendingDir.value === 'next') {
        slot.orders = { prev: 3, current: 1, next: 2 }
        slot.currentIdx = mod(slot.currentIdx + 1, total)
        const newNextIdx = mod(slot.currentIdx + 1, total)
        const newPrevIdx = mod(slot.currentIdx - 1, total)
        slot.currentSrc = internalImages.value[slot.currentIdx]
        slot.prevSrc = internalImages.value[newPrevIdx]
        slot.nextSrc = internalImages.value[newNextIdx]
    } else {
        slot.orders = { prev: 2, current: 3, next: 1 }
        slot.currentIdx = mod(slot.currentIdx - 1, total)
        const newPrevIdx = mod(slot.currentIdx - 1, total)
        const newNextIdx = mod(slot.currentIdx + 1, total)
        slot.prevSrc = internalImages.value[newPrevIdx]
        slot.currentSrc = internalImages.value[slot.currentIdx]
        slot.nextSrc = internalImages.value[newNextIdx]
    }

    requestAnimationFrame(() => {
        slot.orders = { prev: 1, current: 2, next: 3 }
    })

    if (slots.value.every((s) => !s.animating)) {
        pendingDir.value = null
    }
}

const startAutoplay = () => {
    stopAutoplay()
    intervalId.value = window.setInterval(() => next(), speed)
}

const stopAutoplay = () => {
    if (intervalId.value !== null) {
        clearInterval(intervalId.value)
        intervalId.value = null
    }
}

const onKeyLeft = () => prev()
const onKeyRight = () => next()

onMounted(() => {
    internalImages.value = shuffle
        ? [...images].sort(() => Math.random() - 0.5)
        : [...images]

    const visible = Math.min(imagesToShow, Math.max(1, internalImages.value.length))

    slots.value = Array.from({ length: visible }, (_, i) => {
        const currentIdx = mod(i, internalImages.value.length)
        const prevIdx = mod(currentIdx - 1, internalImages.value.length)
        const nextIdx = mod(currentIdx + 1, internalImages.value.length)
        return {
            currentIdx,
            prevSrc: internalImages.value[prevIdx],
            currentSrc: internalImages.value[currentIdx],
            nextSrc: internalImages.value[nextIdx],
            orders: { prev: 1, current: 2, next: 3 },
            animating: false,
            translateX: -100,
        } as SlotState
    })

    if (autoplay) startAutoplay()
})

onBeforeUnmount(() => stopAutoplay())
</script>
