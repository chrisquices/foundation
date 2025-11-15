<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Button Group</p>

                <!-- Restorative variant group -->
                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="primary">
                        <Button variant="primary" size="small">Undo</Button>
                        <Button variant="primary" size="small">Restore</Button>
                        <Button variant="primary" size="small">Confirm</Button>
                    </ButtonGroup>

                    <ButtonGroup variant="primary" alt>
                        <Button variant="primary" size="small">Undo</Button>
                        <Button variant="primary" size="small">Restore</Button>
                        <Button variant="primary" size="small">Confirm</Button>
                    </ButtonGroup>
                </div>

                <!-- Restorative variant group -->
                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="primary">
                        <Button variant="primary" size="normal">Undo</Button>
                        <Button variant="primary" size="normal">Restore</Button>
                        <Button variant="primary" size="normal">Confirm</Button>
                    </ButtonGroup>

                    <ButtonGroup variant="primary" alt>
                        <Button variant="primary" size="normal">Undo</Button>
                        <Button variant="primary" size="normal">Restore</Button>
                        <Button variant="primary" size="normal">Confirm</Button>
                    </ButtonGroup>
                </div>

                <!-- Restorative variant group -->
                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="primary">
                        <Button variant="primary" size="large">Undo</Button>
                        <Button variant="primary" size="large">Restore</Button>
                        <Button variant="primary" size="large">Confirm</Button>
                    </ButtonGroup>

                    <ButtonGroup variant="primary" alt>
                        <Button variant="primary" size="large">Undo</Button>
                        <Button variant="primary" size="large">Restore</Button>
                        <Button variant="primary" size="large">Confirm</Button>
                    </ButtonGroup>
                </div>

                <!-- Restorative variant group -->
                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="secondary">
                        <Button variant="secondary" size="normal">Undo</Button>
                        <Button variant="secondary" size="normal"
                            >Restore</Button
                        >
                        <Button variant="secondary" size="normal"
                            >Confirm</Button
                        >
                    </ButtonGroup>

                    <ButtonGroup variant="secondary" alt>
                        <Button variant="secondary" size="normal">Undo</Button>
                        <Button variant="secondary" size="normal"
                            >Restore</Button
                        >
                        <Button variant="secondary" size="normal"
                            >Confirm</Button
                        >
                    </ButtonGroup>
                </div>

                <!-- Restorative variant group -->
                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="restorative">
                        <Button variant="restorative" size="normal"
                            >Undo</Button
                        >
                        <Button variant="restorative" size="normal"
                            >Restore</Button
                        >
                        <Button variant="restorative" size="normal"
                            >Confirm</Button
                        >
                    </ButtonGroup>

                    <ButtonGroup variant="restorative" alt>
                        <Button variant="restorative" size="normal"
                            >Undo</Button
                        >
                        <Button variant="restorative" size="normal"
                            >Restore</Button
                        >
                        <Button variant="restorative" size="normal"
                            >Confirm</Button
                        >
                    </ButtonGroup>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="destructive">
                        <Button variant="destructive" size="normal"
                            >Undo</Button
                        >
                        <Button variant="destructive" size="normal"
                            >Restore</Button
                        >
                        <Button variant="destructive" size="normal"
                            >Confirm</Button
                        >
                    </ButtonGroup>

                    <ButtonGroup variant="destructive" alt>
                        <Button variant="destructive" size="normal"
                            >Undo</Button
                        >
                        <Button variant="destructive" size="normal"
                            >Restore</Button
                        >
                        <Button variant="destructive" size="normal"
                            >Confirm</Button
                        >
                    </ButtonGroup>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="warning">
                        <Button variant="warning" size="normal">Undo</Button>
                        <Button variant="warning" size="normal">Restore</Button>
                        <Button variant="warning" size="normal">Confirm</Button>
                    </ButtonGroup>

                    <ButtonGroup variant="warning" alt>
                        <Button variant="warning" size="normal">Undo</Button>
                        <Button variant="warning" size="normal">Restore</Button>
                        <Button variant="warning" size="normal">Confirm</Button>
                    </ButtonGroup>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <ButtonGroup variant="info">
                        <Button variant="info" size="normal">Undo</Button>
                        <Button variant="info" size="normal">Restore</Button>
                        <Button variant="info" size="normal">Confirm</Button>
                    </ButtonGroup>

                    <ButtonGroup variant="info" alt>
                        <Button variant="info" size="normal">Undo</Button>
                        <Button variant="info" size="normal">Restore</Button>
                        <Button variant="info" size="normal">Confirm</Button>
                    </ButtonGroup>
                </div>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Button from '@/components/ui/Button.vue';
import ButtonGroup from '@/components/ui/ButtonGroup.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
</script>
