<template>
    <div class="relative flex min-h-screen flex-col bg-background">

        <div class="relative z-10 mx-auto w-full space-y-6 px-6 sm:space-y-8 sm:px-8 lg:max-w-[90rem] xl:max-w-[100rem]">
            <!-- Main Content Area -->
            <main class="relative w-full space-y-6 sm:space-y-8 text-text">
                <slot />
            </main>
        </div>

        <!--        <Toaster position="bottom-right" richColors />-->
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'GuestLayout',

    components: {
    },

    data() {
        return {
        };
    },
});
</script>
