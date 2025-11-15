<template>
    <Head title="Users" />

    <AuthLayout>
        <Heading>
            <h1 class="w-full text-2xl font-medium">Create User</h1>
        </Heading>

        <Content>
            <Card class="lg:!py-0">
                <div class="w-full divide-border lg:divide-y">
                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Name</TextLabel>

                        <p class="w-full">{{ user.name }}</p>
                    </div>

                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Last Name</TextLabel>

                        <p class="w-full">{{ user.lastName }}</p>
                    </div>

                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Email</TextLabel>

                        <p class="w-full">{{ user.email }}</p>
                    </div>

                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Roles</TextLabel>

                        <div class="col-span-2 space-y-4">
                            <div v-for="role in user.roles" class="flex flex-col">
                                <p>{{ role.name }}</p>
                            </div>

                            <p v-if="user.roles.length === 0">No roles assigned</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                        <TextLabel>Is Active</TextLabel>

                        <CircleX v-if="!user.isActive" :size="20" class="text-destructive" />
                        <CircleCheck v-if="user.isActive" :size="20" class="text-restorative" />
                    </div>
                </div>
            </Card>

            <div class="mt-6 flex items-center justify-end gap-4">
                <Link :href="UserController.index()">
                    <Button variant="transparent" onhover="primaryForeground">Cancel</Button>
                </Link>

                <Link :href="UserController.edit(user.id)">
                    <Button variant="secondary">Edit User</Button>
                </Link>

                <Button v-if="!isOwnUser && !user.isActive" variant="restorative" @click="activateUser()">
                    Activate User
                </Button>
                <Button v-if="!isOwnUser && user.isActive" variant="warning" @click="deactivateUser()">
                    Deactivate User
                </Button>

                <Button v-if="!isOwnUser" variant="destructive" @click="openDeleteUserAlertDialog()">
                    Delete User
                </Button>
            </div>
        </Content>

        <!-- Delete Single User Alert Dialog -->
        <AlertDialog :show="deleteUserAlertDialog.isOpen">
            <template #title>
                <p>Confirmation Required</p>
            </template>
            <template #content>
                <p>
                    Are you sure you want to delete the user
                    <b>{{ user.name }}</b>
                    ?
                </p>
            </template>
            <template #buttons>
                <!-- Cancel -->
                <Button
                    variant="transparent"
                    onhover="primaryForeground"
                    :disabled="deleteUserAlertDialog.isLoading"
                    @click="closeDeleteUserAlertDialog()"
                >
                    Cancel
                </Button>

                <!-- Delete -->
                <Button
                    variant="destructive"
                    :disabled="deleteUserAlertDialog.isLoading"
                    @click="deleteUser()"
                    autofocus
                >
                    <template v-if="deleteUserAlertDialog.isLoading">
                        <Spinner />
                        Deleting...
                    </template>
                    <template v-else> Delete User </template>
                </Button>
            </template>
        </AlertDialog>
    </AuthLayout>
</template>

<script setup lang="ts">
import UserController from '@/actions/App/Http/Controllers/Backend/UserController';
import AlertDialog from '@/components/ui/AlertDialog.vue';
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import Content from '@/components/ui/Content.vue';
import Spinner from '@/components/ui/Spinner.vue';
import TextLabel from '@/components/ui/TextLabel.vue';
import Heading from '@/layouts/app/Heading.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { CircleCheck, CircleX } from 'lucide-vue-next';
import { defineProps, ref } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps<{
    user: User;
    isOwnUser: boolean;
}>();

interface User {
    id: number;
    name: string;
    lastName: string;
    email: string;
    isActive: boolean;
    roles: { name: string }[];
}

// region --- Activate User --------------------------------------------------------------------------------------------
const activateUser = () => {
    const user = props.user;

    router.patch(
        UserController.activateUser(user.id),
        {},
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.success(`User activated successfully`);
            },
            onError: (errors: Record<string, string>) => {
                Object.values(errors).forEach((message) => toast.error(message));
            },
        },
    );
};
// endregion

// region --- Deactivate User --------------------------------------------------------------------------------------------
const deactivateUser = () => {
    const user = props.user;

    router.patch(
        UserController.deactivateUser(user.id),
        {},
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.success(`User deactivated successfully`);
            },
            onError: (errors: Record<string, string>) => {
                Object.values(errors).forEach((message) => toast.error(message));
            },
        },
    );
};
// endregion

// region --- Delete Single User ----------------------------------------------------------------------------------------------
const deleteUserAlertDialog = ref<{
    isOpen: boolean;
    isLoading: boolean;
}>({
    isOpen: false,
    isLoading: false,
});

const openDeleteUserAlertDialog = (user?: User) => {
    if (deleteUserAlertDialog.value.isLoading) return;

    deleteUserAlertDialog.value.isOpen = true;
};

const closeDeleteUserAlertDialog = () => {
    deleteUserAlertDialog.value.isOpen = false;
};

const deleteUser = () => {
    const user = props.user;

    router.delete(UserController.delete(user.id), {
        preserveScroll: true,
        onStart: () => {
            deleteUserAlertDialog.value.isLoading = true;
        },
        onSuccess: () => {
            toast.success(`User "${user.name}" deleted`);
        },
        onError: (errors: Record<string, string>) => {
            Object.values(errors).forEach((message) => toast.error(message));
        },
        onFinish: async () => {
            deleteUserAlertDialog.value.isLoading = false;
            closeDeleteUserAlertDialog();
        },
    });
};
// endregion
</script>
