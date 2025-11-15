<template>
    <nav aria-label="breadcrumb" class="flex items-center gap-2 text-sm">
        <ol class="flex flex-wrap items-center gap-2 sm:gap-1">
            <li
                v-for="(item, index) in items"
                :key="index"
                class="inline-flex items-center gap-1.5"
            >
                <!-- Non-current items -->
                <template v-if="index < items.length - 1">
                    <a
                        :href="item.href"
                        class="flex items-center gap-1.5 text-text-muted hover:text-foreground transition-colors"
                    >
                        <i v-if="item.icon" :class="['lni', item.icon]" />
                        <span>{{ item.label }}</span>
                    </a>
                </template>

                <!-- Last / Current item -->
                <template v-else>
          <span class="flex items-center gap-1.5 text-foreground font-medium">
            <i v-if="item.icon" :class="['lni', item.icon]" />
            <span>{{ item.label }}</span>
          </span>
                </template>

                <!-- Chevron separator -->
                <ChevronRight v-if="index < items.length - 1" :size="12" class="ml-1"/>
            </li>
        </ol>
    </nav>
</template>

<script setup lang="ts">
import { ChevronRight } from 'lucide-vue-next';

interface BreadcrumbItem {
    label: string
    href?: string
    icon?: string
}

const props = defineProps<{
    items: BreadcrumbItem[]
}>()
</script>
