<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-8">
                <h2 class="text-lg font-semibold">Carousel</h2>

                <div class="h-52">
                    <Carousel
                        :images="images"
                        :speed="1000"
                        :images-to-show="4"
                        rounded="xl"
                        loop
                        autoplay
                        shuffle
                    />
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <Carousel
                        :images="images"
                        :speed="1000"
                        :images-to-show="1"
                        rounded="xl"
                        loop
                        autoplay
                        shuffle
                    />

                    <Carousel
                        :images="images"
                        :speed="1000"
                        :images-to-show="1"
                        rounded="xl"
                        loop
                        autoplay
                        shuffle
                    />
                </div>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Carousel from '@/components/ui/Carousel.vue'
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue'
import AuthLayout from '@/layouts/AuthLayout.vue'

const images: string[] = Array.from({ length: 5 }, (_, i) =>
    `https://picsum.photos/seed/${i + 1}/800/600`
)
</script>
