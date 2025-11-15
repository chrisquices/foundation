<template>
    <Head title="Roles" />

    <AuthLayout>
        <Heading>
            <h1 class="w-full text-2xl font-medium">Create Role</h1>
        </Heading>

        <Content>
            <Card class="lg:!py-0">
                <div class="w-full divide-border lg:divide-y">
                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Name</TextLabel>

                        <p class="w-full">{{ role.name }}</p>
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
                                            <Checkbox
                                                :value="permission.id"
                                                :model-value="role.permissions.includes(permission.id)"
                                                readonly
                                            >
                                                {{ permission.name }}
                                            </Checkbox>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Card>

            <div class="mt-6 flex items-center justify-end gap-4">
                <Link :href="RoleController.index()">
                    <Button variant="transparent" onhover="primaryForeground">Cancel</Button>
                </Link>

                <Link :href="RoleController.edit(role.id)">
                    <Button variant="secondary">Edit Role</Button>
                </Link>

                <Button v-if="!isOwnRole" variant="destructive" @click="openDeleteRoleAlertDialog()">
                    Delete Role
                </Button>
            </div>
        </Content>

        <!-- Delete Single Role Alert Dialog -->
        <AlertDialog :show="deleteRoleAlertDialog.isOpen">
            <template #title>
                <p>Confirmation Required</p>
            </template>
            <template #content>
                <p>
                    Are you sure you want to delete the role
                    <b>{{ role.name }}</b>
                    ?
                </p>
            </template>
            <template #buttons>
                <!-- Cancel -->
                <Button
                    variant="transparent"
                    onhover="primaryForeground"
                    :disabled="deleteRoleAlertDialog.isLoading"
                    @click="closeDeleteRoleAlertDialog()"
                >
                    Cancel
                </Button>

                <!-- Delete -->
                <Button
                    variant="destructive"
                    :disabled="deleteRoleAlertDialog.isLoading"
                    @click="deleteRole()"
                    autofocus
                >
                    <template v-if="deleteRoleAlertDialog.isLoading">
                        <Spinner />
                        Deleting...
                    </template>
                    <template v-else> Delete Role </template>
                </Button>
            </template>
        </AlertDialog>
    </AuthLayout>
</template>

<script setup lang="ts">
import RoleController from '@/actions/App/Http/Controllers/Backend/RoleController';
import AlertDialog from '@/components/ui/AlertDialog.vue';
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import Checkbox from '@/components/ui/Checkbox.vue';
import Content from '@/components/ui/Content.vue';
import Spinner from '@/components/ui/Spinner.vue';
import TextLabel from '@/components/ui/TextLabel.vue';
import Heading from '@/layouts/app/Heading.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps<{
    role: Role;
    permissions: PermissionGroup[];
}>();

interface Role {
    id: number;
    name: string;
    permissions: number[];
}

// region --- Delete Single Role ----------------------------------------------------------------------------------------------
const deleteRoleAlertDialog = ref<{
    isOpen: boolean;
    isLoading: boolean;
}>({
    isOpen: false,
    isLoading: false,
});

const openDeleteRoleAlertDialog = (role?: Role) => {
    if (deleteRoleAlertDialog.value.isLoading) return;

    deleteRoleAlertDialog.value.isOpen = true;
};

const closeDeleteRoleAlertDialog = () => {
    deleteRoleAlertDialog.value.isOpen = false;
};

const deleteRole = () => {
    const role = props.role;

    router.delete(RoleController.delete(role.id), {
        preserveScroll: true,
        onStart: () => {
            deleteRoleAlertDialog.value.isLoading = true;
        },
        onSuccess: () => {
            toast.success(`Role "${role.name}" deleted`);
        },
        onError: (errors: Record<string, string>) => {
            Object.values(errors).forEach((message) => toast.error(message));
        },
        onFinish: async () => {
            deleteRoleAlertDialog.value.isLoading = false;
            closeDeleteRoleAlertDialog();
        },
    });
};
// endregion
</script>
