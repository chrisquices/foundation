<template>
    <nav class="flex items-center justify-between mt-6" aria-label="Pagination">

        <!-- Showing -->
        <span v-if="data.total == 0" class="text-sm text-text">
            Showing 0 results
        </span>

        <span v-if="data.total > 0" class="text-sm text-text">
            Showing {{ data.from }} to {{ data.to }} of {{ data.total }} results
        </span>

        <!-- Pagination -->
        <div class="flex items-center gap-1">

            <!-- Prev -->
            <Link
                :href="data.prev_page_url || '#'"
                class="px-2 py-1 text-text hover:text-primary"
                :class="{ 'opacity-40 pointer-events-none': !data.prev_page_url }"
            >
                ‹
            </Link>

            <!-- Pages -->
            <template v-for="(page, i) in pages" :key="i">
                <span
                    v-if="page === '...'">
                    …
                </span>

                <Link
                    v-else
                    :href="pageUrl(page)"
                    class="px-3 py-1 rounded text-sm"
                    :class="{
                        'bg-primary text-white font-semibold': page === data.current_page,
                        'hover:bg-hover hover:font-semibold': page !== data.current_page
                    }"
                >
                    {{ page }}
                </Link>
            </template>

            <!-- Next -->
            <Link
                :href="data.next_page_url || '#'"
                class="px-2 py-1 text-text hover:text-primary"
                :class="{ 'opacity-40 pointer-events-none': !data.next_page_url }"
            >
                ›
            </Link>

        </div>
    </nav>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps<{
    data: {
        current_page: number
        last_page: number
        prev_page_url: string | null
        next_page_url: string | null
        total: number
        from: number
        to: number
        first_page_url: string
    }
}>()

/** Build URL with ?page=# */
const pageUrl = (page: number) => {
    const [base] = props.data.first_page_url.split('?')
    return `${base}?page=${page}`
}

/** Clean page window (1 … x-1 x x+1 … last) */
const pages = computed(() => {
    const current = props.data.current_page
    const last = props.data.last_page

    const window = 2
    const output: (number | string)[] = []

    for (let page = 1; page <= last; page++) {
        const inRange =
            page === 1 ||
            page === last ||
            (page >= current - window && page <= current + window)

        if (inRange) output.push(page)
    }

    // Add dots
    return output.reduce<(number | string)[]>((acc, page, i) => {
        if (i > 0 && typeof page === 'number' && typeof acc[acc.length - 1] === 'number') {
            if (page !== (acc[acc.length - 1] as number) + 1) acc.push('...')
        }
        acc.push(page)
        return acc
    }, [])
})
</script>
