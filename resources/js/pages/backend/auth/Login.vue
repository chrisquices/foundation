<template>
    <Head title="Login" />

    <GuestLayout>
        <div class="grid h-screen place-items-center">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <Card class="!p-10">
                    <form @submit.prevent="authenticate" class="space-y-8">
                        <div class="mt-6 mb-12 flex h-10 w-auto items-center justify-center gap-4">
                            <img :src="logoUrl" alt="logo" class="h-10" />

                            <p class="text-2xl font-medium">Foundation</p>
                        </div>

                        <div class="flex flex-col gap-1">
                            <TextLabel for="email" class="pl-1">Email</TextLabel>
                            <TextInput
                                ref="email"
                                color="inputForeground"
                                v-model="loginForm.email"
                                size="normal"
                                placeholder="john@email.com"
                                type="email"
                                autofocus
                            />
                            <InputError :error="loginForm.errors.email" />
                        </div>

                        <div class="flex flex-col gap-1">
                            <TextLabel for="password" class="pl-1">Password</TextLabel>
                            <TextInput
                                color="inputForeground"
                                v-model="loginForm.password"
                                size="normal"
                                placeholder="••••••••••••"
                                type="password"
                            />
                            <InputError :error="loginForm.errors.password" />
                        </div>

                        <!--                        <div class="flex items-center justify-end">-->
                        <!--                            <Link class="text-sm font-medium text-primary">Forgot Password?</Link>-->
                        <!--                        </div>-->
                        <!--                        <div class="flex items-center justify-between">-->
                        <!--                            <div class="form-control">-->
                        <!--                                <label class="label cursor-pointer">-->
                        <!--                                    <x-backend.checkbox id="remember" checked/>-->
                        <!--                                    <span class="label-text ml-2">{{ __('backend.remember_me') }}</span>-->
                        <!--                                </label>-->
                        <!--                            </div>-->
                        <!--                            <x-backend.anchor href="{{ route('backend.password.request') }}">{{ __('backend.forgot_your_password?') }}</x-backend.anchor>-->
                        <!--                        </div>-->

                        <div class="flex flex-col gap-2">
                            <Button variant="primary" type="submit">Sign In</Button>
                        </div>
                    </form>
                </Card>
            </div>
        </div>
    </GuestLayout>
</template>

<script lang="ts">
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import InputError from '@/components/ui/InputError.vue';
import TextInput from '@/components/ui/TextInput.vue';
import TextLabel from '@/components/ui/TextLabel.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import logoUrl from '@img/logo.svg';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineComponent } from 'vue';
import { toast } from 'vue-sonner';

import { authenticate } from '@/actions/App/Http/Controllers/Backend/AuthController';

export default defineComponent({
    components: {
        Link,
        InputError,
        TextLabel,
        TextInput,
        GuestLayout,
        Card,
        Head,
        Button,
    },

    props: {},

    data() {
        return {
            logoUrl,

            loginForm: useForm({
                email: 'admin@foundation.com',
                password: 'password',
            }),
        };
    },

    mounted() {
        this.$nextTick(() => {
            this.$refs.email?.focus?.();
        });
    },

    computed: {},

    methods: {
        authenticate() {
            this.loginForm.post(authenticate(), {
                onError: (errors) => {
                    Object.values(errors).forEach((message) => {
                        toast.error(message);
                    });
                },
            });
        },
    },
});
</script>
