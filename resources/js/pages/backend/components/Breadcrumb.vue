<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Breadcrumb</p>
                <Breadcrumb :items="breadcrumbItems" />
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { ref } from 'vue';

interface BreadcrumbItem {
    label: string;
    href?: string;
    icon?: string;
    current?: boolean;
}

const breadcrumbItems = ref<BreadcrumbItem[]>([
    { label: 'Home', href: '/', icon: 'lni-home-2' },
    { label: 'Components', href: '/components', icon: 'lni-layout-9' },
    { label: 'Breadcrumb', current: true, icon: 'lni-layout-9' },
]);
</script>
