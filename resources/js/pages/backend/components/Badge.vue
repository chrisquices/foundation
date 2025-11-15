<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Badge</p>

                <div class="flex flex-wrap items-center gap-4">
                    <Badge variant="primary" size="small">Small</Badge>
                    <Badge variant="primary" size="normal">Normal</Badge>
                    <Badge variant="primary" size="large">Large</Badge>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <Badge variant="primary">Primary</Badge>
                    <Badge variant="secondary">Secondary</Badge>
                    <Badge variant="transparent">Transparent</Badge>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <Badge variant="primary" outline>Primary</Badge>
                    <Badge variant="secondary" outline>Secondary</Badge>
                    <Badge variant="transparent" outline>Transparent</Badge>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <Badge variant="restorative">Restorative</Badge>
                    <Badge variant="destructive">Destructive</Badge>
                    <Badge variant="warning">Warning</Badge>
                    <Badge variant="info">Info</Badge>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <Badge variant="restorative" outline>Restorative</Badge>
                    <Badge variant="destructive" outline>Destructive</Badge>
                    <Badge variant="warning" outline>Warning</Badge>
                    <Badge variant="info" outline>Info</Badge>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <Badge variant="restorative">
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v8m0 0l-4-4m4 4l4-4"
                                />
                            </svg>
                        </template>
                        Restorative
                    </Badge>

                    <Badge variant="destructive">
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M18 6L6 18M6 6l12 12"
                                />
                            </svg>
                        </template>
                        Destructive
                    </Badge>

                    <Badge variant="warning">
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v4m0 4h.01M12 2l10 18H2L12 2z"
                                />
                            </svg>
                        </template>
                        Warning
                    </Badge>

                    <Badge variant="info">
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"
                                />
                            </svg>
                        </template>
                        Info
                    </Badge>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <Badge variant="restorative" outline>
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v8m0 0l-4-4m4 4l4-4"
                                />
                            </svg>
                        </template>
                        Restorative
                    </Badge>

                    <Badge variant="destructive" outline>
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M18 6L6 18M6 6l12 12"
                                />
                            </svg>
                        </template>
                        Destructive
                    </Badge>

                    <Badge variant="warning" outline>
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v4m0 4h.01M12 2l10 18H2L12 2z"
                                />
                            </svg>
                        </template>
                        Warning
                    </Badge>

                    <Badge variant="info" outline>
                        <template #icon>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="size-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"
                                />
                            </svg>
                        </template>
                        Info
                    </Badge>
                </div>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Badge from '@/components/ui/Badge.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
</script>
