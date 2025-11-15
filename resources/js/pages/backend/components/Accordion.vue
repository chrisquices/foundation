<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Accordion</p>

                <Card>
                    <Accordion :items="accordionItems" />
                </Card>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Accordion from '@/components/ui/Accordion.vue';
import Card from '@/components/ui/Card.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';

const accordionItems = [
    {
        title: 'Product Information',
        content: 'High quality materials and durable design for long-term use.',
    },
    {
        title: 'Shipping Details',
        content:
            'Worldwide shipping available. Orders usually ship within 3–5 business days.',
    },
    {
        title: 'Return Policy',
        content:
            '30-day hassle-free returns. Full refund issued within 48 hours of receiving the item.',
    },
];
</script>
