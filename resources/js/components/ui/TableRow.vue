<template>
    <tr
        :class="[
        rowSizeClass,
            'hover:bg-hover border-t border-border',
            striped ? '' : ''
        ]"
        >
        <slot></slot>
    </tr>
</template>

<script>
export default {
    name: "TableRow",

    props: {
        size: {
            type: String,
            default: "comfortable",
        },

        striped: {
            type: Boolean,
            default: false,
        }
    },

    computed: {
        rowSizeClass() {
            switch (this.size) {
                case 'compact':
                    return 'h-8'
                case 'comfortable':
                    return 'h-10'
                default:
                    return 'h-10'
            }
        },
    },
};
</script>
