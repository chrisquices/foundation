<template>
    <div class="relative w-[200px]" @keydown.stop.prevent="handleKeydown">
        <!-- Button -->
        <button
            type="button"
            class="flex w-full justify-between items-center border border-border rounded-lg shadow-sm h-10 pl-4 pr-2"
            :class="variant === 'input' ? 'bg-input' : variant === 'input-foreground' ? 'bg-input-foreground' : ''"
            @click="toggleDropdown"
        >
            {{ modelValue || 'Select an option...' }}
            <span class="text-text-muted flex items-center text-xl">
                <i class="lni lni-chevron-down"></i>
            </span>
        </button>

        <!-- Dropdown -->
        <div
            v-if="isOpen"
            ref="dropdown"
            class="absolute left-0 top-full mt-1 w-full rounded-lg bg-background border border-border shadow-md z-50"
            :class="variant === 'input' ? 'bg-input' : variant === 'input-foreground' ? 'bg-input-foreground' : ''"
        >
            <!-- Search Input -->
            <div class="p-4">
                <input
                    ref="searchInput"
                    v-model="search"
                    type="text"
                    placeholder="Search..."
                    class="w-full h-8 px-2 text-sm border border-border rounded-lg focus:outline-none focus:primary"
                    @keydown.stop.prevent="handleKeydown"
                />
            </div>

            <!-- Slot List -->
            <ul class="max-h-60 overflow-y-auto text-sm" ref="slotContainer">
                <slot :search="search" :select="selectOption"></slot>
            </ul>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, nextTick, PropType } from "vue";

export default defineComponent({
    name: "Select",
    props: {
        modelValue: {
            type: String,
            default: "",
        },
        variant: {
            type: String as PropType<"input" | "input-foreground">,
            default: "input",
        },
    },
    data() {
        return {
            isOpen: false,
            search: "",
            activeIndex: -1 as number,
        };
    },
    methods: {
        toggleDropdown() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                nextTick(() => {
                    this.decorateChildren();
                    this.focusSearch();
                    this.activeIndex = -1;
                });
            }
        },
        focusSearch() {
            const input = this.$refs.searchInput as HTMLInputElement | null;
            if (input) input.focus();
        },
        selectOption(value: string) {
            this.$emit("update:modelValue", value);
            this.isOpen = false;
            this.search = "";
            this.activeIndex = -1;
        },
        handleClickOutside(event: MouseEvent) {
            const target = event.target as HTMLElement;
            if (!this.$el.contains(target)) {
                this.isOpen = false;
                this.activeIndex = -1;
            }
        },
        decorateChildren() {
            const container = this.$refs.slotContainer as HTMLElement | null;
            if (!container) return;

            Array.from(container.children).forEach((el) => {
                if (el instanceof HTMLElement) {
                    el.classList.add(
                        "px-5",
                        "py-2",
                        "cursor-pointer",
                        "hover:bg-input-foreground",
                        "transition-colors"
                    );
                }
            });
        },
        handleKeydown(e: KeyboardEvent) {
            const container = this.$refs.slotContainer as HTMLElement | null;
            if (!this.isOpen || !container) return;

            const items = Array.from(container.children) as HTMLElement[];
            if (items.length === 0) return;

            switch (e.key) {
                case "ArrowDown":
                    this.activeIndex =
                        (this.activeIndex + 1) % items.length;
                    this.highlightActive(items);
                    break;
                case "ArrowUp":
                    this.activeIndex =
                        (this.activeIndex - 1 + items.length) % items.length;
                    this.highlightActive(items);
                    break;
                case "Enter":
                    if (this.activeIndex >= 0 && this.activeIndex < items.length) {
                        const activeEl = items[this.activeIndex];
                        activeEl.click();
                    }
                    break;
                case "Escape":
                    this.isOpen = false;
                    break;
            }
        },
        highlightActive(items: HTMLElement[]) {
            items.forEach((el, idx) => {
                el.classList.toggle(
                    "bg-input-foreground",
                    idx === this.activeIndex
                );
            });

            // scroll item into view if necessary
            const activeEl = items[this.activeIndex];
            if (activeEl) {
                activeEl.scrollIntoView({
                    block: "nearest",
                    behavior: "smooth",
                });
            }
        },
    },
    mounted() {
        document.addEventListener("click", this.handleClickOutside);
    },
    updated() {
        if (this.isOpen) nextTick(() => this.decorateChildren());
    },
    beforeUnmount() {
        document.removeEventListener("click", this.handleClickOutside);
    },
});
</script>
