<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Dialog</p>

                <Button variant="primary" @click="toggleDialog()"> Open Dialog </Button>

                <!-- Dialog -->
                <Dialog :show="isDialogOpen" @close="toggleDialog()">
                    <div class="space-y-6">
                        <!-- Title -->
                        <h2 class="text-foreground text-xl font-semibold">Example Dialog Title</h2>

                        <!-- Placeholder paragraph -->
                        <p class="text-foreground/80 text-sm leading-relaxed">
                            This is placeholder content for your dialog. You can replace it with any text, form,
                            component, or interactive element you need. Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit. Integer at faucibus orci.
                        </p>

                        <!-- Placeholder list -->
                        <ul class="text-foreground/80 list-inside list-disc space-y-1 text-sm">
                            <li>First placeholder item</li>
                            <li>Second placeholder item</li>
                            <li>Third placeholder item</li>
                        </ul>

                        <!-- Placeholder input fields -->
                        <div class="space-y-4">
                            <div class="flex flex-col space-y-2">
                                <TextLabel>Name</TextLabel>
                                <TextInput variant="input-foreground" placeholder="Enter your name" />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <TextLabel>Email</TextLabel>
                                <TextInput variant="input-foreground" placeholder="Enter your email" />
                            </div>
                        </div>

                        <!-- Separator -->
                        <hr class="border-border" />

                        <!-- More placeholder text -->
                        <p class="text-foreground/80 text-sm leading-relaxed">
                            Additional placeholder text to simulate more dialog content. Quisque sit amet lectus vel
                            ligula placerat consequat a vitae neque.
                        </p>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end gap-3">
                            <Button variant="transparent" onhover="primaryForeground" @click="toggleDialog()"
                                >Cancel</Button
                            >

                            <Button size="normal" variant="primary" @click="toggleDialog()"> Accept </Button>
                        </div>
                    </div>
                </Dialog>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Button from '@/components/ui/Button.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import Dialog from '@/components/ui/Dialog.vue';
import TextInput from '@/components/ui/TextInput.vue';
import TextLabel from '@/components/ui/TextLabel.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { ref } from 'vue';

const isDialogOpen = ref(false);

function toggleDialog() {
    isDialogOpen.value = !isDialogOpen.value;
}
</script>
