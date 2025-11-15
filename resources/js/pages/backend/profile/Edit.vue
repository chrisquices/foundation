<template>
    <Head title="Edit Profile" />

    <AuthLayout>
        <Heading>
            <h1 class="w-full text-2xl font-medium">Edit Profile</h1>
        </Heading>

        <Content>
            <form @submit.prevent="updateProfile">
                <Card class="lg:!py-0">
                    <div class="w-full space-y-4 lg:space-y-0 lg:divide-y lg:divide-border">
                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Name</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput v-model="updateProfileForm.name" variant="input-foreground" class="w-full" />
                                <InputError :error="updateProfileForm.errors.name" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Last Name</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput
                                    v-model="updateProfileForm.lastName"
                                    variant="input-foreground"
                                    class="w-full"
                                />
                                <InputError :error="updateProfileForm.errors.lastName" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Email</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput
                                    v-model="updateProfileForm.email"
                                    variant="input-foreground"
                                    class="w-full"
                                    type="email"
                                />
                                <InputError :error="updateProfileForm.errors.email" />
                            </div>
                        </div>
                    </div>
                </Card>

                <div class="mt-6 flex items-center justify-end gap-4">
                    <Button
                        variant="primary"
                        :disabled="updateProfileForm.isProcessing"
                        @click="updateProfile"
                        type="submit"
                    >
                        <span v-if="updateProfileForm.isProcessing">Saving...</span>
                        <span v-else>Save Profile</span>
                    </Button>
                </div>
            </form>
        </Content>

        <Heading>
            <h1 class="w-full text-2xl font-medium">Update Password</h1>
        </Heading>

        <Content>
            <form @submit.prevent="updatePassword">
                <Card class="lg:!py-0">
                    <div class="w-full space-y-4 lg:space-y-0 lg:divide-y lg:divide-border">
                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Password</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput
                                    v-model="updatePasswordForm.password"
                                    variant="input-foreground"
                                    class="w-full"
                                    type="password"
                                />
                                <InputError :error="updatePasswordForm.errors.password" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 items-center lg:grid-cols-4 lg:py-8">
                            <TextLabel>Confirm Password</TextLabel>

                            <div class="col-span-2 space-y-2">
                                <TextInput
                                    v-model="updatePasswordForm.password_confirmation"
                                    variant="input-foreground"
                                    class="w-full"
                                    type="password"
                                />
                                <InputError :error="updatePasswordForm.errors.password_confirmation" />
                            </div>
                        </div>
                    </div>
                </Card>

                <div class="mt-6 flex items-center justify-end gap-4">
                    <Button variant="primary" :disabled="updatePasswordForm.isProcessing" type="submit">
                        <span v-if="updatePasswordForm.isProcessing">Saving...</span>
                        <span v-else>Update Password</span>
                    </Button>
                </div>
            </form>
        </Content>
    </AuthLayout>
</template>

<script setup lang="ts">
import ProfileController from '@/actions/App/Http/Controllers/Backend/ProfileController';
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import Content from '@/components/ui/Content.vue';
import InputError from '@/components/ui/InputError.vue';
import TextInput from '@/components/ui/TextInput.vue';
import TextLabel from '@/components/ui/TextLabel.vue';
import Heading from '@/layouts/app/Heading.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps<{
    user: User;
}>();

interface User {
    id: number;
    name: string;
    lastName: string;
    email: string;
}

interface UserForm {
    isProcessing: boolean;
    name: string;
    lastName: string;
    email: string;
}

// region --- Update Profile  ------------------------------------------------------------------------------------------
const updateProfileForm = useForm<UserForm>({
    isProcessing: false,
    name: props.user.name,
    lastName: props.user.lastName,
    email: props.user.email,
});

const updateProfile = () => {
    updateProfileForm.isProcessing = true;

    updateProfileForm.patch(ProfileController.update(), {
        preserveScroll: true,

        data: {
            ...updateProfileForm.data(),
            roleIds: updateProfileForm.roleIds,
        },

        onSuccess: () => {
            toast.success('User updated successfully');
        },

        onError: (errors) => {
            Object.values(errors).forEach((msg) => toast.error(String(msg)));
        },

        onFinish: () => {
            updateProfileForm.isProcessing = false;
        },
    });
};
// endregion

// region --- Update Password ------------------------------------------------------------------------------------------
const updatePasswordForm = useForm({
    isProcessing: false,
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    updatePasswordForm.isProcessing = true;

    updatePasswordForm.patch(ProfileController.updatePassword(), {
        preserveScroll: true,

        data: {
            password: updatePasswordForm.password,
            password_confirmation: updatePasswordForm.password_confirmation,
        },

        onSuccess: () => {
            toast.success('Password updated successfully');
            updatePasswordForm.reset('password', 'password_confirmation');
        },

        onError: (errors) => {
            Object.values(errors).forEach((msg) => toast.error(String(msg)));
        },

        onFinish: () => {
            updatePasswordForm.isProcessing = false;
        },
    });
};
// endregion
</script>
