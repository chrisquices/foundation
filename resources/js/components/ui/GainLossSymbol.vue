<template>
    <div class="flex items-center mr-1">
        <i :class="iconClass" v-bind="$attrs"></i>
    </div>
</template>

<script>
export default {
    name: "GainLossSymbol",

    props: {
        value: {
            type: Number,
            required: true
        },
    },

    computed: {
        iconClass() {
            if (this.value === 0) {
                return 'lni lni-circle-dashed text-text-muted';
            }

            if (this.value > 0) {
                return 'lni lni-angle-double-up !text-restorative';
            }

            if (this.value < 0) {
                return 'lni lni-angle-double-down !text-destructive';
            }

            return '';
        },
    },
};
</script>
