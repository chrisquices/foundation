<template>
    <div class="relative min-w-0 group/main-table">
        <!-- Table wrapper with overflow -->
        <div class="w-full overflow-hidden">

            <div
                v-if="isOverflowing"
                class="pointer-events-none absolute right-0 top-0 h-full w-8 bg-gradient-to-l from-accent/7 to-transparent lg:hidden"
            ></div>

            <div class="relative w-full overflow-x-auto">
                <table class="min-w-full text-sm">
                    <slot name="head" :size="size"></slot>
                    <slot name="body" :size="size"></slot>
                </table>
            </div>

            <div class="mx-4 mt-4">
                <slot name="empty"></slot>
            </div>

            <div class="mx-4 mt-4">
                <slot name="pagination"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Table',

    props: {
        size: {
            type: String,
            default: 'comfortable', // compact, comfortable
        },
        mutedOnHover: {
            type: Boolean,
            default: false,
        },
    },

    provide() {
        return {
            tableSize: this.size,
        };
    },

    data() {
        return {
            isOverflowing: false,
        };
    },

    mounted() {
        this.checkOverflow();
        window.addEventListener('resize', this.checkOverflow);
    },

    beforeUnmount() {
        window.removeEventListener('resize', this.checkOverflow);
    },

    methods: {
        checkOverflow() {
            this.$nextTick(() => {
                const el = this.$el.querySelector('.overflow-x-auto');
                this.isOverflowing = el && el.scrollWidth > el.clientWidth;
            });
        },
    }
};
</script>
