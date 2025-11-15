<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Alert</p>

                <div class="space-y-12">
                    <!-- Restorative -->
                    <Alert type="restorative">
                        <template #icon>
                            <CircleCheck :size="20" />
                        </template>
                        <template #title> Success! Your changes have been saved </template>
                        <template #message> Everything went smoothly. You can continue working. </template>
                    </Alert>

                    <!-- Destructive -->
                    <Alert type="destructive">
                        <template #icon>
                            <X :size="20" />
                        </template>
                        <template #title> Error! Something went wrong </template>
                        <template #message> Unable to process your request. Please try again later. </template>
                    </Alert>

                    <!-- Warning -->
                    <Alert type="warning">
                        <template #icon>
                            <TriangleAlert :size="20" />
                        </template>
                        <template #title> Warning! Check your inputs </template>
                        <template #message> Some fields may not be valid. Review before submitting. </template>
                    </Alert>

                    <!-- Info -->
                    <Alert type="info">
                        <template #icon>
                            <MessageCircleQuestionIcon :size="20" />
                        </template>
                        <template #title> Info! Heads up </template>
                        <template #message> This is additional information for your attention. </template>
                    </Alert>
                </div>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Alert from '@/components/ui/Alert.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { CircleCheck, MessageCircleQuestionIcon, TriangleAlert, X } from 'lucide-vue-next';
</script>
