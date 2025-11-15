<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Button</p>

                <!-- Buttons: sizes -->
                <div class="flex flex-wrap items-center gap-4">
                    <Button variant="primary" size="small">Small</Button>
                    <Button variant="primary" size="normal">Normal</Button>
                    <Button variant="primary" size="large">Large</Button>
                </div>

                <!-- Buttons: specific colors -->
                <div class="flex flex-wrap items-center gap-4">
                    <Button variant="primary">Primary</Button>
                    <Button variant="secondary">Secondary</Button>
                    <Button variant="transparent">Transparent</Button>
                </div>

                <!-- Buttons: specific colors with outline -->
                <div class="flex flex-wrap items-center gap-4">
                    <Button variant="primary" outline>Primary</Button>
                    <Button variant="secondary" outline>Secondary</Button>
                    <Button variant="transparent" outline>Transparent</Button>
                </div>

                <!-- Buttons: generic colors -->
                <div class="flex flex-wrap items-center gap-4">
                    <Button variant="restorative">Restorative</Button>
                    <Button variant="destructive">Destructive</Button>
                    <Button variant="warning">Warning</Button>
                    <Button variant="info">Info</Button>
                </div>

                <!-- Buttons: generic colors with outline -->
                <div class="flex flex-wrap items-center gap-4">
                    <Button variant="restorative" outline>Restorative</Button>
                    <Button variant="destructive" outline>Destructive</Button>
                    <Button variant="warning" outline>Warning</Button>
                    <Button variant="info" outline>Info</Button>
                </div>

                <!-- Buttons: generic colors with icons -->
                <div class="flex flex-wrap items-center gap-4">
                    <Button variant="restorative">
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
                    </Button>

                    <Button variant="destructive">
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
                    </Button>

                    <Button variant="warning">
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
                    </Button>

                    <Button variant="info">
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
                    </Button>
                </div>

                <!-- Buttons: generic colors with outline and icons -->
                <div class="flex flex-wrap items-center gap-4">
                    <Button variant="restorative" outline>
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
                    </Button>

                    <Button variant="destructive" outline>
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
                    </Button>

                    <Button variant="warning" outline>
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
                    </Button>

                    <Button variant="info" outline>
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
                    </Button>
                </div>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Button from '@/components/ui/Button.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
</script>
