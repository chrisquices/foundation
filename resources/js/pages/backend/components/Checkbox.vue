<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Checkbox</p>

                <!-- Example 1: Simple single checkbox -->
                <Checkbox v-model="agreed"> I agree to the privacy policy </Checkbox>

                <!-- Example 2: Preferences -->
                <Checkbox v-model="sendUpdates">
                    <p>Send me product updates</p>
                    <p>Get notified about new features and improvements.</p>
                </Checkbox>

                <!-- Example 3: Disabled state -->
                <Checkbox v-model="sendUpdates" :disabled="true">
                    <p>Enable beta features</p>
                    <p>Currently unavailable for your account.</p>
                </Checkbox>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Checkbox from '@/components/ui/Checkbox.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { ref } from 'vue';

const agreed = ref(false);
const sendUpdates = ref(true);
const disabledOption = ref(false);
</script>
