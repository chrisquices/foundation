<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Avatar</p>

                <div class="flex items-center gap-8">
                    <Avatar size="small" :src="pikachu" />
                    <Avatar size="normal" :src="pikachu" />
                    <Avatar size="large" :src="pikachu" />

                    <Avatar size="small" :src="pikachu" rounded="semi" />
                    <Avatar size="normal" :src="pikachu" rounded="semi" />
                    <Avatar size="large" :src="pikachu" rounded="semi" />
                </div>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Avatar from '@/components/ui/Avatar.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';

import pikachu from '@img/pikachu.jpg';
</script>
