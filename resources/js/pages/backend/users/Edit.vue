<template>
    <Head title="Users" />

    <AuthLayout>
        <Heading>
            <h1 class="w-full text-2xl font-medium">Edit User: {{ user.name }}</h1>
        </Heading>

        <Content>
            <form @submit.prevent="updateUser">
                <Card class="lg:!py-0">
                    <div class="w-full space-y-4 lg:space-y-0 lg:divide-y lg:divide-border">
                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Name</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput v-model="form.name" variant="input-foreground" class="w-full" />
                                <InputError :error="form.errors.name" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Last Name</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput v-model="form.lastName" variant="input-foreground" class="w-full" />
                                <InputError :error="form.errors.lastName" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Email</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput
                                    v-model="form.email"
                                    variant="input-foreground"
                                    class="w-full"
                                    type="email"
                                />
                                <InputError :error="form.errors.email" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Roles</TextLabel>

                            <div class="col-span-2 space-y-4">
                                <div v-for="role in roles" :key="role.id" class="flex flex-col">
                                    <Checkbox v-model="form.roleIds" :value="role.id">
                                        {{ role.name }}
                                    </Checkbox>
                                </div>

                                <InputError :error="form.errors.roleIds" />
                            </div>
                        </div>
                    </div>
                </Card>

                <div class="mt-6 flex items-center justify-end gap-4">
                    <Link :href="UserController.index()">
                        <Button variant="transparent" onhover="primaryForeground">Cancel</Button>
                    </Link>

                    <Button variant="primary" :disabled="form.isProcessing" @click="updateUser" type="submit">
                        <span v-if="form.isProcessing">Saving...</span>
                        <span v-else>Save User</span>
                    </Button>
                </div>
            </form>
        </Content>
    </AuthLayout>
</template>

<script setup lang="ts">
import UserController from '@/actions/App/Http/Controllers/Backend/UserController';
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import Checkbox from '@/components/ui/Checkbox.vue';
import Content from '@/components/ui/Content.vue';
import InputError from '@/components/ui/InputError.vue';
import TextInput from '@/components/ui/TextInput.vue';
import TextLabel from '@/components/ui/TextLabel.vue';
import Heading from '@/layouts/app/Heading.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps<{
    user: User;
    roles: Role[];
}>();

interface Role {
    id: number;
    name: string;
}

interface User {
    id: number;
    name: string;
    lastName: string;
    email: string;
    isActive: boolean;
    isAdmin: boolean;
    roles: { id: number; name: string }[];
}

interface UserForm {
    isProcessing: boolean;
    name: string;
    lastName: string;
    email: string;
    roleIds: number[];
}

const form = useForm<UserForm>({
    isProcessing: false,
    name: props.user.name,
    lastName: props.user.lastName,
    email: props.user.email,
    roleIds: props.user.roles.map((role) => role.id),
});

const updateUser = () => {
    form.isProcessing = true;

    form.patch(UserController.update(props.user.id), {
        preserveScroll: true,

        data: {
            ...form.data(),
            roleIds: form.roleIds,
        },

        onSuccess: () => {
            toast.success('User updated successfully');
        },

        onError: (errors) => {
            Object.values(errors).forEach((msg) => toast.error(String(msg)));
        },

        onFinish: () => {
            form.isProcessing = false;
        },
    });
};
</script>
