<template>
    <Topbar />

    <!--    <div class="pointer-events-none absolute inset-x-0 top-0 z-20 flex justify-center overflow-hidden">-->
    <!--        <div class="flex w-[108rem] flex-none justify-end">-->
    <!--            &lt;!&ndash;                <picture&ndash;&gt;-->
    <!--            &lt;!&ndash;                    ><source srcset="/_next/static/media/docs@30.8b9a76a2.avif" type="image/avif" />&ndash;&gt;-->
    <!--            &lt;!&ndash;                    <img&ndash;&gt;-->
    <!--            &lt;!&ndash;                        src="/_next/static/media/docs@tinypng.d9e4dcdc.png"&ndash;&gt;-->
    <!--            &lt;!&ndash;                        alt=""&ndash;&gt;-->
    <!--            &lt;!&ndash;                        class="w-[71.75rem] max-w-none flex-none dark:hidden"&ndash;&gt;-->
    <!--            &lt;!&ndash;                        decoding="async" /></picture&ndash;&gt;-->
    <!--            &lt;!&ndash;                >&ndash;&gt;-->
    <!--            <picture-->
    <!--            ><source srcset="https://v3.tailwindcss.com/_next/static/media/docs-dark@30.1a9f8cbf.avif" type="image/avif" />-->
    <!--                <img-->
    <!--                    src="https://v3.tailwindcss.com/_next/static/media/docs-dark@30.1a9f8cbf.avif"-->
    <!--                    alt=""-->
    <!--                    class="hidden w-[90rem] max-w-none flex-none dark:block opacity-50"-->
    <!--                    decoding="async"-->
    <!--                /></picture>-->
    <!--        </div>-->
    <!--    </div>-->

    <div class="relative flex gap-12 bg-background">
        <!-- Background gradient -->

        <!--        <div-->
        <!--            class="fixed inset-0 bg-gradient-to-br from-gradient-from via-gradient-via to-gradient-to -z-10"-->
        <!--        ></div>-->

        <!-- Sidebar -->
        <Sidebar />

        <!-- Main content -->
        <main class="flex-grow space-y-4 overflow-hidden pt-6 pr-8 pl-8 lg:pr-12 lg:pl-0">
            <slot />
        </main>
    </div>

    <!--    <Footer />-->
    <Toaster position="bottom-right" richColors />
</template>

<script setup lang="ts">
import Sidebar from '@/layouts/app/Sidebar.vue';
import Topbar from '@/layouts/app/Topbar.vue';
import { Toaster } from 'vue-sonner';
</script>
