<template>
    <Head title="Dashboard" />

    <AuthLayout>
        <Heading>
            <h1 class="text-2xl font-medium">Dashboard</h1>
        </Heading>

        <Content>
            <Card>
                <p>Hello</p>
            </Card>
        </Content>
    </AuthLayout>
</template>

<script lang="ts">
import Card from '@/components/ui/Card.vue';
import Content from '@/components/ui/Content.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import Heading from '@/layouts/app/Heading.vue';
import logoUrl from '@img/logo.svg';
import { Head, useForm } from '@inertiajs/vue3';
import { defineComponent } from 'vue';

export default defineComponent({
    components: {
        Heading,
        AuthLayout,
        Card,
        Head,
        Content,
    },

    props: {},

    data() {
        return {
            logoUrl,

            loginForm: useForm({
                email: '',
                password: '',
            }),
        };
    },

    mounted() {},

    computed: {},

    methods: {},
});
</script>
