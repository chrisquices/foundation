<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Alert Dialog</p>

                <Button variant="primary" @click="toggleAlertDialog()"> Open Alert Dialog </Button>

                <!-- Alert Dialog -->
                <AlertDialog :show="isAlertDialogOpen" @close="toggleAlertDialog()">
                    <template #title>
                        <p>System Message</p>
                    </template>

                    <template #content>
                        <p>This is an alert dialog. It appears when the system needs your attention.</p>
                        <br />
                        <p class="text-muted-foreground text-sm italic">
                            You can dismiss this message or continue with your action.
                        </p>
                    </template>

                    <template #buttons>
                        <Button
                            size="normal"
                            color="transparent"
                            onhover="primaryForeground"
                            @click="toggleAlertDialog()"
                        >
                            Accept
                        </Button>
                    </template>
                </AlertDialog>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import AlertDialog from '@/components/ui/AlertDialog.vue';
import Button from '@/components/ui/Button.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { ref } from 'vue';

const isAlertDialogOpen = ref(false);

function toggleAlertDialog() {
    isAlertDialogOpen.value = !isAlertDialogOpen.value;
}
</script>
