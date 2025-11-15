<template>
    <span class="flex items-center">
        <ChevronUp v-if="direction === 'desc'" :size="16" class="!font-bold" />
        <ChevronDown v-if="direction === 'asc'" :size="16" class="!font-bold" />
    </span>
</template>

<script>

import { ChevronDown, ChevronUp, EllipsisVertical } from 'lucide-vue-next';

export default {
    name: 'SortIcon',
    components: { ChevronDown, ChevronUp, EllipsisVertical },

    props: {
        direction: {
            type: String,
            required: true,
            validator: (value) => ['asc', 'desc'].includes(value),
        },
    },
};
</script>
