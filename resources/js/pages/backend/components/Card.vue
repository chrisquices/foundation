<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Card</p>

                <Card class="w-full max-w-sm">
                    <div class="space-y-2 text-center">
                        <h2 class="text-xl font-semibold">Welcome back</h2>
                        <p class="text-muted-foreground text-sm">
                            Sign in to your account
                        </p>
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium"
                            >Email</label
                        >
                        <input
                            id="email"
                            type="email"
                            placeholder="you@example.com"
                            class="focus:ring-ring w-full rounded-md border border-border bg-input px-3 py-2 text-sm focus:ring-2 focus:ring-offset-1 focus:outline-none"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium"
                            >Password</label
                        >
                        <input
                            id="password"
                            type="password"
                            placeholder="••••••••"
                            class="focus:ring-ring w-full rounded-md border border-border bg-input px-3 py-2 text-sm focus:ring-2 focus:ring-offset-1 focus:outline-none"
                        />
                    </div>

                    <Button variant="primary" size="normal" class="w-full"
                        >Sign In</Button
                    >

                    <p class="text-center">
                        Don’t have an account?
                        <a href="#" class="text-info hover:underline"
                            >Create one</a
                        >
                    </p>
                </Card>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
</script>
