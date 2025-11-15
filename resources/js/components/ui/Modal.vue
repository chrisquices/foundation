<template>
    <transition name="modal-pop">
        <teleport to="body">
            <div
                ref="modalContainer"
                v-if="isOpen"
                class="fixed inset-0 z-50 h-screen flex flex-col items-center justify-center space-y-12 p-6 sm:p-16 overflow-hidden"
                @click.self="close"
            >
                <!-- Background Layer -->
                <div class="absolute inset-0 h-screen pointer-events-none z-0">

                    <!-- Stars -->
                    <div
                        v-for="(star, index) in stars"
                        :key="index"
                        class="absolute pointer-events-none"
                        :class="star.class"
                        :style="{
                            top: star.top,
                            left: star.left,
                            width: star.size + 'px',
                            height: star.size + 'px',
                            opacity: star.opacity,
                        }"
                    >
                        <div class="absolute inset-0 w-0.5 h-full bg-gradient-to-b from-transparent via-accent to-transparent mx-auto"></div>
                        <div class="absolute inset-0 h-0.5 w-full bg-gradient-to-r from-transparent via-accent to-transparent my-auto"></div>
                    </div>
                </div>

                <!-- Modal Content -->
                <div
                    tabindex="-1"
                    class="z-10 p-6 sm:p-8 transform transition-all w-full h-auto max-h-full duration-300 bg-card text-text rounded-xl shadow-lg shadow-shadow"
                    :class="[modalSizeClass, { 'overflow-y-auto': scrollable }]"
                    @click.stop
                >
                    <slot></slot>
                </div>
            </div>
        </teleport>
    </transition>
</template>

<script>
export default {
    name: 'Modal',
    props: {
        isOpen: Boolean,
        size: {
            type: String,
            default: 'medium',
        },
        customWidth: String,
        scrollable: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            stars: [
                { class: 'animate-rotateStar', top: '17%', left: '82%', size: 147, opacity: 0.16 },
                { class: 'animate-rotateStar', top: '71%', left: '67%', size: 174, opacity: 0.10 },
                { class: 'animate-rotateStarTiny', top: '73%', left: '29%', size: 131, opacity: 0.19 },
                { class: 'animate-rotateStar', top: '22%', left: '88%', size: 180, opacity: 0.09 },
                { class: 'animate-rotateStarTiny', top: '36%', left: '19%', size: 91, opacity: 0.18 },
                { class: 'animate-rotateStarTiny', top: '8%', left: '33%', size: 168, opacity: 0.33 },
                { class: 'animate-rotateStarReverse', top: '14%', left: '56%', size: 185, opacity: 0.15 },
                { class: 'animate-rotateStar', top: '57%', left: '87%', size: 164, opacity: 0.07 },
                { class: 'animate-rotateStarTiny', top: '90%', left: '12%', size: 108, opacity: 0.10 },
                { class: 'animate-rotateStarTiny', top: '22%', left: '94%', size: 139, opacity: 0.16 },
            ],
        };
    },
    computed: {
        modalSizeClass() {
            if (this.customWidth) return this.customWidth;
            const sizes = {
                small: 'max-w-sm',
                medium: 'max-w-md',
                large: 'max-w-lg',
                'extra-large': 'max-w-xl',
                '2extra-large': 'max-w-2xl',
                '3extra-large': 'max-w-3xl',
                '4extra-large': '!max-w-[60rem]',
                '5extra-large': '!max-w-[66rem]',
                '6extra-large': '!max-w-[72rem]',
                '7extra-large': '!max-w-[90rem]',
                'full-screen': '!w-full !h-full !max-w-none !max-h-none',
            };
            return sizes[this.size] || 'max-w-md';
        },
    },
    watch: {
        isOpen(newValue) {
            if (newValue) {
                this.$nextTick(() => {
                    this.$refs.modalContainer?.focus();
                });
            }
        },
    },
    mounted() {
        window.addEventListener('keydown', this.handleKeydown);
    },
    beforeUnmount() {
        window.removeEventListener('keydown', this.handleKeydown);
    },
    methods: {
        close() {
            this.$emit('update:isOpen', false);
        },

        handleKeydown(event) {
            if ((event.metaKey || event.ctrlKey) && event.key === 'k') {
                event.preventDefault();
                this.isOpen = !this.isOpen;
                if (this.isOpen) {
                    this.$nextTick(() => {
                        this.$refs.generalSearch?.$el.focus();
                    });
                }
            } else if (event.key === 'Escape') {
                this.close();
            }
        },
    },
};
</script>

<style scoped>
.modal-pop-enter-active,
.modal-pop-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}
.modal-pop-enter-from,
.modal-pop-leave-to {
    opacity: 0;
    transform: scale(0.95);
}
@keyframes rotateStar { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
@keyframes rotateStarTiny { 0% { transform: rotate(0deg); } 100% { transform: rotate(90deg); } }
@keyframes rotateStarReverse { 0% { transform: rotate(360deg); } 100% { transform: rotate(0deg); } }
@keyframes driftSlow {
    0% { transform: translate(0px, 0px); }
    50% { transform: translate(8px, -6px); }
    100% { transform: translate(0px, 0px); }
}
@keyframes driftSmall {
    0% { transform: translate(0px, 0px); }
    50% { transform: translate(12px, -8px); }
    100% { transform: translate(0px, 0px); }
}
@keyframes driftSubtle {
    0% { transform: translate(-50%, -50%) scale(1); }
    50% { transform: translate(-50%, -50%) scale(1.01); }
    100% { transform: translate(-50%, -50%) scale(1); }
}
.animate-rotateStar { animation: rotateStar 30s linear infinite; }
.animate-rotateStarTiny { animation: rotateStarTiny 75s linear infinite; }
.animate-rotateStarReverse { animation: rotateStarReverse 60s linear infinite; }
.animate-driftSlow { animation: driftSlow 60s ease-in-out infinite; }
.animate-driftSmall { animation: driftSmall 80s ease-in-out infinite; }
.animate-driftSubtle { animation: driftSubtle 90s ease-in-out infinite; }
</style>
