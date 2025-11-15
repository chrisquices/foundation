<template>
    <tr :class="rowSizeClass" v-bind="$attrs" class="">
        <slot></slot>
    </tr>
</template>

<script>
export default {
    name: "TableHeadRow",

    props: {
        size: {
            type: String,
            default: "comfortable",
        },
    },

    computed: {
        rowSizeClass() {
            switch (this.size) {
                case 'compact':
                    return '!h-10'
                case 'comfortable':
                    return '!h-12'
                default:
                    return '!h-12'
            }
        },
    },
};
</script>
