<template>
    <Head title="Users" />

    <AuthLayout>
        <Heading>
            <!-- Title -->
            <h1 class="w-full text-2xl font-medium">Users</h1>

            <div class="flex items-center justify-between gap-4">
                <!-- Search -->
                <TextInputSearch v-model="tableControls.search" placeholder="Press ⌘ + . to search" />

                <!-- Page Actions -->
                <div class="flex gap-4">
                    <Button
                        :variant="canDeleteUsers ? 'destructive' : 'secondary'"
                        :disabled="!canDeleteUsers"
                        @click="openDeleteManyUsersAlertDialog()"
                    >
                        Delete Users
                    </Button>
                    <Link :href="UserController.create()">
                        <Button variant="primary">Create User</Button>
                    </Link>
                </div>
            </div>
        </Heading>

        <Content>
            <Card>
                <div class="-mx-4 -mt-4 mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <Select v-model="tableControls.recordsPerPage" variant="input" class="!w-16">
                            <template #default="{ search, select }">
                                <li @click="select(10)">10</li>
                                <li @click="select(20)">20</li>
                                <li @click="select(50)">50</li>
                                <li @click="select(100)">100</li>
                            </template>
                        </Select>
                    </div>
                </div>

                <!-- Table -->
                <Table size="comfortable" class="-mx-8">
                    <template #head>
                        <TableHeadRow size="compact">
                            <!-- Checkbox -->
                            <TableHeader class="w-1"></TableHeader>

                            <!-- Name -->
                            <TableHeader class="w-44">
                                <div
                                    class="flex items-center gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'name' }"
                                    @click="sortTable('name')"
                                >
                                    <div class="font-bold">Name</div>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'name'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

                            <!-- Last Name -->
                            <TableHeader class="w-52">
                                <div
                                    class="flex items-center gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'last_name' }"
                                    @click="sortTable('last_name')"
                                >
                                    <span>Last Name</span>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'last_name'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

                            <!-- Email -->
                            <TableHeader>
                                <div
                                    class="flex items-center gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'email' }"
                                    @click="sortTable('email')"
                                >
                                    <span>Email</span>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'email'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

                            <!-- Email Verified At -->
                            <TableHeader class="w-44">
                                <div
                                    class="flex items-center justify-end gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'email_verified_at' }"
                                    @click="sortTable('email_verified_at')"
                                >
                                    <span>Email Verified At</span>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'email_verified_at'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

                            <!-- Active -->
                            <TableHeader class="w-1">
                                <div
                                    class="flex items-center justify-center gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'is_active' }"
                                    @click="sortTable('is_active')"
                                >
                                    <span>Active</span>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'is_active'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

                            <!-- Admin -->
                            <TableHeader class="w-1">
                                <div
                                    class="flex items-center justify-center gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'is_admin' }"
                                    @click="sortTable('is_admin')"
                                >
                                    <span>Admin</span>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'is_admin'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

                            <!-- Actions -->
                            <TableHeader class="w-1"></TableHeader>
                        </TableHeadRow>
                    </template>

                    <template #body>
                        <TableRow v-for="(user, index) in users.data" :key="`table-row-users-${index}`">
                            <!-- Checkbox -->
                            <TableCell>
                                <TableCheckbox
                                    v-model="tableControls.selectedRows"
                                    :value="user.id"
                                    variant="input-foreground"
                                />
                            </TableCell>

                            <!-- Name -->
                            <TableCell class="font-bold">{{ user.name }}</TableCell>

                            <!-- Last Name -->
                            <TableCell>{{ user.lastName }}</TableCell>

                            <!-- Email -->
                            <TableCell>{{ user.email }}</TableCell>

                            <!-- Email Verified At -->
                            <TableCell>{{ user.emailVerifiedAt }}</TableCell>

                            <!-- Active -->
                            <TableCell>
                                <div class="flex items-center justify-center">
                                    <CircleX v-if="!user.isActive" :size="20" class="text-destructive" />
                                    <CircleCheck v-if="user.isActive" :size="20" class="text-restorative" />
                                </div>
                            </TableCell>

                            <!-- Admin -->
                            <TableCell>
                                <div class="flex items-center justify-center">
                                    <CircleX v-if="!user.isAdmin" :size="20" class="text-destructive" />
                                    <CircleCheck v-if="user.isAdmin" :size="20" class="text-restorative" />
                                </div>
                            </TableCell>

                            <!-- Actions -->
                            <TableCell class="text-end">
                                <div class="flex items-center justify-end gap-4">
                                    <!-- View -->
                                    <button aria-label="view user">
                                        <Link :href="UserController.show(user.id)" class="w-6 cursor-pointer">
                                            <Search :size="20" />
                                        </Link>
                                    </button>

                                    <!-- Edit -->
                                    <button aria-label="edit user">
                                        <Link :href="UserController.edit(user.id)" class="w-6 cursor-pointer">
                                            <SquarePen :size="20" />
                                        </Link>
                                    </button>

                                    <!-- Delete -->
                                    <button aria-label="delete user">
                                        <div class="w-6 cursor-pointer">
                                            <Trash2 :size="20" @click="openDeleteSingleUserAlertDialog(user)" />
                                        </div>
                                    </button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </template>

                    <template #empty>
                        <NoResultsFound v-if="!users.data.length" />
                    </template>

                    <template #pagination>
                        <TablePagination :data="users" />
                    </template>
                </Table>
            </Card>
        </Content>

        <!-- Delete Single User Alert Dialog -->
        <AlertDialog :show="deleteSingleUserAlertDialog.isOpen">
            <template #title>
                <p>Confirmation Required</p>
            </template>
            <template #content>
                <p>
                    Are you sure you want to delete the user
                    <b>{{ deleteSingleUserAlertDialog.selectedUser?.name }}</b>
                    ?
                </p>
            </template>
            <template #buttons>
                <!-- Cancel -->
                <Button
                    variant="transparent"
                    onhover="primaryForeground"
                    :disabled="deleteSingleUserAlertDialog.isLoading"
                    @click="closeDeleteSingleUserAlertDialog()"
                >
                    Cancel
                </Button>

                <!-- Delete -->
                <Button
                    variant="destructive"
                    :disabled="deleteSingleUserAlertDialog.isLoading"
                    @click="deleteSingleUser()"
                    autofocus
                >
                    <template v-if="deleteSingleUserAlertDialog.isLoading">
                        <Spinner />
                        Deleting...
                    </template>
                    <template v-else> Delete User </template>
                </Button>
            </template>
        </AlertDialog>

        <!-- Delete Many Users Alert Dialog -->
        <AlertDialog :show="deleteManyUsersAlertDialog.isOpen" @close="closeDeleteManyUsersAlertDialog">
            <template #title>
                <p>Confirmation Required</p>
            </template>

            <template #content>
                <p>Are you sure you want to delete the selected users?</p>
            </template>

            <template #buttons>
                <!-- Cancel -->
                <Button
                    variant="transparent"
                    onhover="primaryForeground"
                    :disabled="deleteManyUsersAlertDialog.isLoading"
                    @click="closeDeleteManyUsersAlertDialog()"
                >
                    Cancel
                </Button>

                <!-- Delete -->
                <Button
                    ref="confirmDeleteManyUsersAlertDialogButton"
                    variant="destructive"
                    :disabled="deleteManyUsersAlertDialog.isLoading"
                    @click="deleteManyUsers()"
                    autofocus
                >
                    <template v-if="deleteManyUsersAlertDialog.isLoading">
                        <Spinner />
                        Deleting...
                    </template>
                    <template v-else> Delete Users </template>
                </Button>
            </template>
        </AlertDialog>
    </AuthLayout>
</template>

<script setup lang="ts">
// region --- Import ---------------------------------------------------------------------------------------------------
import UserController from '@/actions/App/Http/Controllers/Backend/UserController';
import AlertDialog from '@/components/ui/AlertDialog.vue';
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import Content from '@/components/ui/Content.vue';
import NoResultsFound from '@/components/ui/NoResultsFound.vue';
import Select from '@/components/ui/Select.vue';
import SortIcon from '@/components/ui/SortIcon.vue';
import Spinner from '@/components/ui/Spinner.vue';
import Table from '@/components/ui/Table.vue';
import TableCell from '@/components/ui/TableCell.vue';
import TableCheckbox from '@/components/ui/TableCheckbox.vue';
import TableHeader from '@/components/ui/TableHeader.vue';
import TableHeadRow from '@/components/ui/TableHeadRow.vue';
import TablePagination from '@/components/ui/TablePagination.vue';
import TableRow from '@/components/ui/TableRow.vue';
import TextInputSearch from '@/components/ui/TextInputSearch.vue';
import Heading from '@/layouts/app/Heading.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { debounce } from 'lodash-es';
import { CircleCheck, CircleX, Search, SquarePen, Trash2 } from 'lucide-vue-next';
import { computed, defineProps, ref, watch } from 'vue';
import { toast } from 'vue-sonner';
// endregion

// region --- Types ----------------------------------------------------------------------------------------------------
type SortByColumn = 'name' | 'last_name' | 'email' | 'email_verified_at' | 'is_active' | 'is_admin';

type SortByDirection = 'asc' | 'desc';
// endregion

// region --- Setup ----------------------------------------------------------------------------------------------------
const props = defineProps<{
    users: PaginatedUsers;
    params: {
        recordsPerPage: 10 | 20 | 50 | 100;
        search: string;
        page: number;
        sortByColumn: 'name' | 'last_name' | 'email' | 'email_verified_at' | 'is_active' | 'is_admin';
        sortByDirection: 'asc' | 'desc';
    };
}>();
// endregion

// region --- Params ---------------------------------------------------------------------------------------------------
interface Params {
    recordsPerPage: 10 | 20 | 50 | 100;
    search: string;
    page: number;
    sortByColumn: SortByColumn;
    sortByDirection: SortByDirection;
}
// endregion

// region --- Table ----------------------------------------------------------------------------------------------------
interface User {
    id: number;
    name: string;
    lastName: string;
    email: string;
    emailVerifiedAt: string | null;
    isActive: boolean;
    isAdmin: boolean;
}

interface PaginatedUsers {
    data: User[];
    current_page: number;
    last_page: number;
    prev_page_url: string | null;
    next_page_url: string | null;
    total: number;
    from: number;
    to: number;
    first_page_url: string;
    per_page: number;
}

interface TableControls {
    search: string;
    recordsPerPage: 10 | 20 | 50 | 100;
    sortByColumn: SortByColumn;
    sortByDirection: SortByDirection;
    isActive: boolean | null;
    isAdmin: boolean | null;
    selectedRows: number[];
}

const tableControls = ref<TableControls>({
    search: '',
    recordsPerPage: 10,
    sortByColumn: 'name',
    sortByDirection: 'asc',
    isActive: null,
    isAdmin: null,
    selectedRows: [],
});

const reload = () => {
    router.get(
        UserController.index(),
        {
            search: tableControls.value.search || undefined,
            recordsPerPage: tableControls.value.recordsPerPage || undefined,
            sortByColumn: tableControls.value.sortByColumn,
            sortByDirection: tableControls.value.sortByDirection,
            isActive: tableControls.value.isActive ?? undefined,
            isAdmin: tableControls.value.isAdmin ?? undefined,
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        },
    );
};

const sortTable = (column: typeof tableControls.value.sortByColumn) => {
    if (tableControls.value.sortByColumn === column) {
        tableControls.value.sortByDirection = tableControls.value.sortByDirection === 'asc' ? 'desc' : 'asc';
    } else {
        tableControls.value.sortByColumn = column;
        tableControls.value.sortByDirection = 'asc';
    }

    reload();
};

const resetSelectedRows = () => {
    tableControls.value.selectedRows = [];
};

watch(() => tableControls.value.search, debounce(reload, 250));

watch(
    () => ({
        recordsPerPage: tableControls.value.recordsPerPage,
        isActive: tableControls.value.isActive,
        isAdmin: tableControls.value.isAdmin,
        sortByColumn: tableControls.value.sortByColumn,
        sortByDirection: tableControls.value.sortByDirection,
    }),
    reload,
);

watch(
    () => props.params,
    (newParams) => {
        if (newParams) {
            tableControls.value.search = newParams.search || '';
            tableControls.value.recordsPerPage = newParams.recordsPerPage || 10;
            tableControls.value.sortByColumn = newParams.sortByColumn || 'name';
            tableControls.value.sortByDirection = newParams.sortByDirection || 'asc';
        }
    },
    { deep: true, immediate: true },
);

// endregion

// region --- Delete Single User ----------------------------------------------------------------------------------------------
const deleteSingleUserAlertDialog = ref<{
    isOpen: boolean;
    isLoading: boolean;
    selectedUser: User | null;
}>({
    isOpen: false,
    isLoading: false,
    selectedUser: null,
});

const openDeleteSingleUserAlertDialog = (user?: User) => {
    if (deleteSingleUserAlertDialog.value.isLoading) return;

    deleteSingleUserAlertDialog.value.isOpen = true;
    deleteSingleUserAlertDialog.value.selectedUser = user ?? null;
};

const closeDeleteSingleUserAlertDialog = () => {
    deleteSingleUserAlertDialog.value.isOpen = false;
};

const resetDeleteSingleUserAlertDialog = () => {
    deleteSingleUserAlertDialog.value.selectedUser = null;
};

const deleteSingleUser = () => {
    const user = deleteSingleUserAlertDialog.value.selectedUser;

    if (!user) {
        toast.error('No user selected for deletion');
        return;
    }

    router.delete(UserController.delete(user.id), {
        preserveScroll: true,
        onStart: () => {
            deleteSingleUserAlertDialog.value.isLoading = true;
        },
        onSuccess: () => {
            toast.success(`User "${user.name}" deleted`);
        },
        onError: (errors: Record<string, string>) => {
            Object.values(errors).forEach((message) => toast.error(message));
        },
        onFinish: async () => {
            deleteSingleUserAlertDialog.value.isLoading = false;
            closeDeleteSingleUserAlertDialog();
            resetDeleteSingleUserAlertDialog();
        },
    });
};
// endregion

// region --- Delete Many Users ----------------------------------------------------------------------------------------
const deleteManyUsersAlertDialog = ref<{
    isOpen: boolean;
    isLoading: boolean;
}>({
    isOpen: false,
    isLoading: false,
});

const canDeleteUsers = computed(() => tableControls.value.selectedRows.length > 0);

const openDeleteManyUsersAlertDialog = () => {
    if (deleteManyUsersAlertDialog.value.isLoading) return;
    deleteManyUsersAlertDialog.value.isOpen = true;
};

const closeDeleteManyUsersAlertDialog = () => {
    deleteManyUsersAlertDialog.value.isOpen = false;
};

const resetDeleteManyUsersAlertDialog = () => {
    deleteManyUsersAlertDialog.value.isLoading = false;
};

const deleteManyUsers = () => {
    if (!canDeleteUsers.value) {
        toast.error('No users selected for deletion');
        return;
    }

    router.post(
        UserController.deleteMany(),
        { userIds: tableControls.value.selectedRows },
        {
            preserveScroll: true,
            onStart: () => {
                deleteManyUsersAlertDialog.value.isLoading = true;
            },
            onSuccess: () => {
                toast.success('Users deleted');
                resetSelectedRows();
            },
            onError: (errors: Record<string, string>) => {
                Object.values(errors).forEach((message) => toast.error(message));
            },
            onFinish: () => {
                deleteManyUsersAlertDialog.value.isLoading = false;
                closeDeleteManyUsersAlertDialog();
                resetDeleteManyUsersAlertDialog();
            },
        },
    );
};

// endregion
</script>
