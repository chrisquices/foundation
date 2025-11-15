<template>
    <div class="relative w-auto" @keydown.stop="handleKeydown">
        <!-- Button -->
        <div
            class="cursor-pointer w-auto flex items-center justify-between rounded-lg px-4 py-1 border border-border focus:border-primary focus:outline-none disabled:opacity-50 text-text focus:ring-2 focus:ring-primary"
            :class="[
                sizeClasses[size],
                variantClasses[variant],
            ]"
            @click="toggleDropdown"
            @keydown.stop.prevent="handleKeydown"
        >
            <span>{{ modelValue || 'Select an option...' }}</span>
            <span class="text-text-muted flex items-center text-xl">
                <ChevronDownIcon :size="20" class="peer-checked:hidden" />
            </span>
        </div>

        <!-- Dropdown -->
        <div
            v-if="isOpen"
            ref="dropdown"
            class="absolute left-0 top-full mt-1 w-full rounded-lg bg-background border border-border shadow-lg z-50"
            :class="variant === 'input' ? 'bg-input' : variant === 'input-foreground' ? 'bg-input-foreground' : ''"
        >
            <!-- Search Input -->
            <div v-if="searchEnabled" class="p-2">
                <input
                    ref="searchInput"
                    v-model="search"
                    type="text"
                    placeholder="Search..."
                    class="w-full h-8 px-2 text-sm border border-border rounded-lg focus:outline-none focus:primary focus:ring-2 focus:ring-primary"
                />
            </div>

            <!-- Slot List -->
            <ul data-select-list class="max-h-60 overflow-y-auto text-sm" ref="slotContainer">
                <slot :search="search" :select="selectOption"></slot>
            </ul>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch, onMounted, onBeforeUnmount, nextTick, defineProps, defineEmits } from "vue";
import { ChevronDownIcon } from "lucide-vue-next";

const props = defineProps({
    modelValue: { type: String, default: "" },
    size: {
        type: String as () => 'small' | 'normal' | 'large',
        default: 'normal'
    },
    variant: {
        type: String as () => 'input' | 'input-foreground',
        default: 'input'
    },
    searchEnabled: { type: Boolean, default: false },
});

const sizeClasses = {
    small: 'text-sm h-8 px-2.5 py-1.5',
    normal: 'text-sm h-10 px-3 py-2',
    large: 'text-base h-10 px-3.5 py-3'
}

const variantClasses = {
    input: 'bg-input',
    'input-foreground': 'bg-input-foreground'
}

const emit = defineEmits(["update:modelValue"]);

const isOpen = ref(false);
const search = ref("");
const activeIndex = ref(-1);

const searchInput = ref<HTMLInputElement | null>(null);
const slotContainer = ref<HTMLElement | null>(null);

function toggleDropdown() {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        nextTick(() => {
            decorateChildren();
            focusSearch();

            const items = getItems();
            if (items.length > 0) {
                activeIndex.value = 0;
                highlightActive(items);
            }
        });
    }
}

function focusSearch() {
    if (searchInput.value) searchInput.value.focus();
}

function selectOption(value: string) {
    emit("update:modelValue", value);
    isOpen.value = false;
    search.value = "";
    activeIndex.value = -1;
}

function handleClickOutside(event: MouseEvent) {
    const target = event.target as HTMLElement;
    const root = (searchInput.value?.closest("div.relative") ?? null) as HTMLElement | null;

    if (root && !root.contains(target)) {
        isOpen.value = false;
        activeIndex.value = -1;
    }
}

function decorateChildren() {
    const elements = getItems();
    elements.forEach((el) => {
        el.classList.add(
            "px-5",
            "py-2",
            "cursor-pointer",
            "hover:bg-input-foreground",
            "transition-colors"
        );
    });
}

function getItems(): HTMLElement[] {
    return slotContainer.value ? Array.from(slotContainer.value.children) as HTMLElement[] : [];
}

function handleKeydown(e: KeyboardEvent) {
    if (!isOpen.value) return;

    const items = getItems();
    if (items.length === 0) return;

    switch (e.key) {
        case "ArrowDown":
            activeIndex.value = (activeIndex.value + 1) % items.length;
            highlightActive(items);
            break;
        case "ArrowUp":
            activeIndex.value = (activeIndex.value - 1 + items.length) % items.length;
            highlightActive(items);
            break;
        case "Enter":
            if (activeIndex.value >= 0 && activeIndex.value < items.length) {
                items[activeIndex.value].click();
            }
            break;
        case "Escape":
            isOpen.value = false;
            break;
    }
}

function highlightActive(items: HTMLElement[]) {
    items.forEach((el, idx) => {
        el.classList.toggle("bg-input-foreground", idx === activeIndex.value);
    });

    const activeEl = items[activeIndex.value];
    if (activeEl) {
        activeEl.scrollIntoView({ block: "nearest", behavior: "smooth" });
    }
}

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});

watch(isOpen, (v) => {
    if (v) nextTick(() => decorateChildren());
});

watch(search, () => {
    nextTick(() => {
        decorateChildren();
        const items = getItems();
        if (items.length > 0) highlightActive(items);
    });
});
</script>
