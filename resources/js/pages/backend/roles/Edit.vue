<template>
    <Head title="Role" />

    <AuthLayout>
        <Heading>
            <h1 class="w-full text-2xl font-medium">Edit Role: {{ role.name }}</h1>
        </Heading>

        <Content>
            <form @submit.prevent="updateRole">
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
                            <TextLabel>Permissions</TextLabel>

                            <div class="col-span-2 space-y-4">
                                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
                                    <div v-for="group in permissions" :key="group.category" class="space-y-4">
                                        <!-- Permission Category -->
                                        <h3 class="text-foreground/80 text-sm font-semibold">
                                            {{ group.category }}
                                        </h3>

                                        <!-- Permissions -->
                                        <div class="space-y-2">
                                            <div
                                                v-for="permission in group.permissions"
                                                :key="permission.id"
                                                class="flex flex-col"
                                            >
                                                <Checkbox v-model="form.permissionIds" :value="permission.id">
                                                    {{ permission.name }}
                                                </Checkbox>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <InputError :error="form.errors.permissionIds" />
                            </div>
                        </div>
                    </div>
                </Card>

                <div class="mt-6 flex items-center justify-end gap-4">
                    <Link :href="RoleController.index()">
                        <Button variant="transparent" onhover="primaryForeground">Cancel</Button>
                    </Link>

                    <Button variant="primary" :disabled="form.isProcessing" @click="updateRole" type="submit">
                        <span v-if="form.isProcessing">Saving...</span>
                        <span v-else>Save Role</span>
                    </Button>
                </div>
            </form>
        </Content>
    </AuthLayout>
</template>

<script setup lang="ts">
import RoleController from '@/actions/App/Http/Controllers/Backend/RoleController';
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

interface Permission {
    id: number;
    name: string;
    code: string;
}

interface PermissionGroup {
    category: string;
    permissions: Permission[];
}

const props = defineProps<{
    role: Role;
    permissions: PermissionGroup[];
}>();

interface Role {
    id: number;
    name: string;
    permissions: number[];
}

interface RoleForm {
    isProcessing: boolean;
    name: string;
    permissionIds: number[];
}

const form = useForm<RoleForm>({
    isProcessing: false,
    name: props.role.name,
    permissionIds: props.role.permissions,
});

const updateRole = () => {
    form.isProcessing = true;

    form.patch(RoleController.update(props.role.id), {
        preserveScroll: true,

        data: {
            ...form.data(),
            permissionIds: form.permissionIds,
        },

        onSuccess: () => {
            toast.success('Role updated successfully');
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
