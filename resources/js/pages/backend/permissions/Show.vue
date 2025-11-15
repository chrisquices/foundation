<template>
    <Head title="Permissions" />

    <AuthLayout>
        <Heading>
            <h1 class="w-full text-2xl font-medium">Create Permission</h1>
        </Heading>

        <Content>
            <Card class="lg:!py-0">
                <div class="w-full divide-border lg:divide-y">
                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Category</TextLabel>

                        <p class="w-full">{{ user.category }}</p>
                    </div>

                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Name</TextLabel>

                        <p class="w-full">{{ user.name }}</p>
                    </div>

                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Code</TextLabel>

                        <p class="w-full">{{ user.code }}</p>
                    </div>
                </div>
            </Card>

            <div class="mt-6 flex items-center justify-end gap-4">
                <Link :href="PermissionController.index()">
                    <Button variant="transparent" onhover="primaryForeground">Cancel</Button>
                </Link>
            </div>
        </Content>
    </AuthLayout>
</template>

<script setup lang="ts">
import PermissionController from '@/actions/App/Http/Controllers/Backend/PermissionController';
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import Content from '@/components/ui/Content.vue';
import TextLabel from '@/components/ui/TextLabel.vue';
import Heading from '@/layouts/app/Heading.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps<{
    user: Permission;
}>();

interface Permission {
    id: number;
    category: string;
    name: string;
    code: string;
}
</script>
