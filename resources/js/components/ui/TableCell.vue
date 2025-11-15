<template>
    <td
        class="whitespace-nowrap text-text px-4"
        :class="[
            sizeClass,
        ]"
    >
        <slot></slot>
    </td>
</template>

<script>
export default {
    name: 'TableCell',

    props: {
        size: {
            type: String,
            default: null,
        },
        isStickyLeft: {
            type: Boolean,
            default: false,
        },
        isStickyRight: {
            type: Boolean,
            default: false,
        },
        isActions: {
            type: Boolean,
            default: false,
        },
    },

    inject: {
        tableSize: {
            from: 'tableSize',
            default: 'normal',
        },
    },

    computed: {
        sizeClass() {
            const resolvedSize = this.size || this.tableSize
            switch (resolvedSize) {
                case 'compact':
                    return 'h-10'
                case 'comfortable':
                    return 'h-12'
                default:
                    return 'h-12'
            }
        },
    },
}
</script>
