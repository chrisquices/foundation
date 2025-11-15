<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Input</p>

                <TextInput variant="input-foreground" placeholder="Enter your name" />
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import TextInput from '@/components/ui/TextInput.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
</script>
