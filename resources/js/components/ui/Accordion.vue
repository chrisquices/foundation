<template>
    <div class="w-full">
        <div
            v-for="(item, idx) in items"
            :key="idx"
            class="border-b last:border-b-0 border-border"
        >
            <h3 class="flex">
                <button
                    type="button"
                    class="flex flex-1 items-start justify-between gap-4 rounded-md py-4 text-left text-sm font-medium outline-none hover:underline transition-all"
                    @click="toggle(idx)"
                >
                    {{ item.title }}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="size-4 shrink-0 transition-transform duration-200"
                        :class="{ 'rotate-180': openIndex === idx }"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
            </h3>

            <!-- Animated content -->
            <transition
                enter-active-class="transition-all duration-300 ease-in-out"
                leave-active-class="transition-all duration-300 ease-in-out"
                @before-enter="beforeEnter"
                @enter="enter"
                @before-leave="beforeLeave"
                @leave="leave"
            >
                <div
                    v-show="openIndex === idx"
                    class="overflow-hidden text-sm text-text"
                >
                    <div class="pt-0 pb-4 flex flex-col gap-4">
                        <p>{{ item.content }}</p>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

type AccordionItem = {
    title: string
    content: string
}

const props = defineProps<{
    items: AccordionItem[]
}>()

const openIndex = ref<number | null>(null)

const toggle = (idx: number) => {
    openIndex.value = openIndex.value === idx ? null : idx
}

const beforeEnter = (el: HTMLElement) => {
    el.style.maxHeight = '0'
}

const enter = (el: HTMLElement) => {
    el.style.maxHeight = el.scrollHeight + 'px'
}

const beforeLeave = (el: HTMLElement) => {
    el.style.maxHeight = el.scrollHeight + 'px'
}

const leave = (el: HTMLElement) => {
    el.style.maxHeight = '0'
}
</script>
