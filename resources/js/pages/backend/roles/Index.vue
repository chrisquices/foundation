<template>
    <Head title="Roles" />

    <AuthLayout>
        <Heading>
            <!-- Title -->
            <h1 class="w-full text-2xl font-medium">Roles</h1>

            <div class="flex items-center justify-between gap-4">
                <!-- Search -->
                <TextInputSearch v-model="tableControls.search" placeholder="Press ⌘ + . to search" />

                <!-- Page Actions -->
                <div class="flex gap-4">
                    <Button
                        :variant="canDeleteRoles ? 'destructive' : 'secondary'"
                        :disabled="!canDeleteRoles"
                        @click="openDeleteManyRolesAlertDialog()"
                    >
                        Delete Roles
                    </Button>
                    <Link :href="RoleController.create()">
                        <Button variant="primary">Create Role</Button>
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
                            <TableHeader>
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

                            <!-- Actions -->
                            <TableHeader class="w-1"></TableHeader>
                        </TableHeadRow>
                    </template>

                    <template #body>
                        <TableRow v-for="(role, index) in roles.data" :key="`table-row-roles-${index}`">
                            <!-- Checkbox -->
                            <TableCell>
                                <TableCheckbox
                                    v-model="tableControls.selectedRows"
                                    :value="role.id"
                                    variant="input-foreground"
                                />
                            </TableCell>

                            <!-- Name -->
                            <TableCell class="font-bold">{{ role.name }}</TableCell>

                            <!-- Actions -->
                            <TableCell class="text-end">
                                <div class="flex items-center justify-end gap-4">
                                    <!-- View -->
                                    <button aria-label="view role">
                                        <Link :href="RoleController.show(role.id)" class="w-6 cursor-pointer">
                                            <Search :size="20" />
                                        </Link>
                                    </button>

                                    <!-- Edit -->
                                    <button aria-label="edit role">
                                        <Link :href="RoleController.edit(role.id)" class="w-6 cursor-pointer">
                                            <SquarePen :size="20" />
                                        </Link>
                                    </button>

                                    <!-- Delete -->
                                    <button aria-label="delete role">
                                        <div class="w-6 cursor-pointer">
                                            <Trash2 :size="20" @click="openDeleteSingleRoleAlertDialog(role)" />
                                        </div>
                                    </button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </template>

                    <template #empty>
                        <NoResultsFound v-if="!roles.data.length" />
                    </template>

                    <template #pagination>
                        <TablePagination :data="roles" />
                    </template>
                </Table>
            </Card>
        </Content>

        <!-- Delete Single Role Alert Dialog -->
        <AlertDialog :show="deleteSingleRoleAlertDialog.isOpen">
            <template #title>
                <p>Confirmation Required</p>
            </template>
            <template #content>
                <p>
                    Are you sure you want to delete the role
                    <b>{{ deleteSingleRoleAlertDialog.selectedRole?.name }}</b>
                    ?
                </p>
            </template>
            <template #buttons>
                <!-- Cancel -->
                <Button
                    variant="transparent"
                    onhover="primaryForeground"
                    :disabled="deleteSingleRoleAlertDialog.isLoading"
                    @click="closeDeleteSingleRoleAlertDialog()"
                >
                    Cancel
                </Button>

                <!-- Delete -->
                <Button
                    variant="destructive"
                    :disabled="deleteSingleRoleAlertDialog.isLoading"
                    @click="deleteSingleRole()"
                    autofocus
                >
                    <template v-if="deleteSingleRoleAlertDialog.isLoading">
                        <Spinner />
                        Deleting...
                    </template>
                    <template v-else> Delete Role </template>
                </Button>
            </template>
        </AlertDialog>

        <!-- Delete Many Roles Alert Dialog -->
        <AlertDialog :show="deleteManyRolesAlertDialog.isOpen" @close="closeDeleteManyRolesAlertDialog">
            <template #title>
                <p>Confirmation Required</p>
            </template>

            <template #content>
                <p>Are you sure you want to delete the selected roles?</p>
            </template>

            <template #buttons>
                <!-- Cancel -->
                <Button
                    variant="transparent"
                    onhover="primaryForeground"
                    :disabled="deleteManyRolesAlertDialog.isLoading"
                    @click="closeDeleteManyRolesAlertDialog()"
                >
                    Cancel
                </Button>

                <!-- Delete -->
                <Button
                    ref="confirmDeleteManyRolesAlertDialogButton"
                    variant="destructive"
                    :disabled="deleteManyRolesAlertDialog.isLoading"
                    @click="deleteManyRoles()"
                    autofocus
                >
                    <template v-if="deleteManyRolesAlertDialog.isLoading">
                        <Spinner />
                        Deleting...
                    </template>
                    <template v-else> Delete Roles </template>
                </Button>
            </template>
        </AlertDialog>
    </AuthLayout>
</template>

<script setup lang="ts">
// region --- Import ---------------------------------------------------------------------------------------------------
import RoleController from '@/actions/App/Http/Controllers/Backend/RoleController';
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
import { Search, SquarePen, Trash2 } from 'lucide-vue-next';
import { computed, defineProps, ref, watch } from 'vue';
import { toast } from 'vue-sonner';
// endregion

// region --- Types ----------------------------------------------------------------------------------------------------
type SortByColumn = 'name';

type SortByDirection = 'asc' | 'desc';
// endregion

// region --- Setup ----------------------------------------------------------------------------------------------------
const props = defineProps<{
    roles: PaginatedRoles;
    params: {
        recordsPerPage: 10 | 20 | 50 | 100;
        search: string;
        page: number;
        sortByColumn: 'name';
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
interface Role {
    id: number;
    name: string;
}

interface PaginatedRoles {
    data: Role[];
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
    selectedRows: number[];
}

const tableControls = ref<TableControls>({
    search: '',
    recordsPerPage: 10,
    sortByColumn: 'name',
    sortByDirection: 'asc',
    selectedRows: [],
});

const reload = () => {
    router.get(
        RoleController.index(),
        {
            search: tableControls.value.search || undefined,
            recordsPerPage: tableControls.value.recordsPerPage || undefined,
            sortByColumn: tableControls.value.sortByColumn,
            sortByDirection: tableControls.value.sortByDirection,
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

// region --- Delete Single Role ----------------------------------------------------------------------------------------------
const deleteSingleRoleAlertDialog = ref<{
    isOpen: boolean;
    isLoading: boolean;
    selectedRole: Role | null;
}>({
    isOpen: false,
    isLoading: false,
    selectedRole: null,
});

const openDeleteSingleRoleAlertDialog = (role?: Role) => {
    if (deleteSingleRoleAlertDialog.value.isLoading) return;

    deleteSingleRoleAlertDialog.value.isOpen = true;
    deleteSingleRoleAlertDialog.value.selectedRole = role ?? null;
};

const closeDeleteSingleRoleAlertDialog = () => {
    deleteSingleRoleAlertDialog.value.isOpen = false;
};

const resetDeleteSingleRoleAlertDialog = () => {
    deleteSingleRoleAlertDialog.value.selectedRole = null;
};

const deleteSingleRole = () => {
    const role = deleteSingleRoleAlertDialog.value.selectedRole;

    if (!role) {
        toast.error('No role selected for deletion');
        return;
    }

    router.delete(RoleController.delete(role.id), {
        preserveScroll: true,
        onStart: () => {
            deleteSingleRoleAlertDialog.value.isLoading = true;
        },
        onSuccess: () => {
            toast.success(`Role "${role.name}" deleted`);
        },
        onError: (errors: Record<string, string>) => {
            Object.values(errors).forEach((message) => toast.error(message));
        },
        onFinish: async () => {
            deleteSingleRoleAlertDialog.value.isLoading = false;
            closeDeleteSingleRoleAlertDialog();
            resetDeleteSingleRoleAlertDialog();
        },
    });
};
// endregion

// region --- Delete Many Roles ----------------------------------------------------------------------------------------
const deleteManyRolesAlertDialog = ref<{
    isOpen: boolean;
    isLoading: boolean;
}>({
    isOpen: false,
    isLoading: false,
});

const canDeleteRoles = computed(() => tableControls.value.selectedRows.length > 0);

const openDeleteManyRolesAlertDialog = () => {
    if (deleteManyRolesAlertDialog.value.isLoading) return;
    deleteManyRolesAlertDialog.value.isOpen = true;
};

const closeDeleteManyRolesAlertDialog = () => {
    deleteManyRolesAlertDialog.value.isOpen = false;
};

const resetDeleteManyRolesAlertDialog = () => {
    deleteManyRolesAlertDialog.value.isLoading = false;
};

const deleteManyRoles = () => {
    if (!canDeleteRoles.value) {
        toast.error('No roles selected for deletion');
        return;
    }

    router.post(
        RoleController.deleteMany(),
        { roleIds: tableControls.value.selectedRows },
        {
            preserveScroll: true,
            onStart: () => {
                deleteManyRolesAlertDialog.value.isLoading = true;
            },
            onSuccess: () => {
                toast.success('Roles deleted');
                resetSelectedRows();
            },
            onError: (errors: Record<string, string>) => {
                Object.values(errors).forEach((message) => toast.error(message));
            },
            onFinish: () => {
                deleteManyRolesAlertDialog.value.isLoading = false;
                closeDeleteManyRolesAlertDialog();
                resetDeleteManyRolesAlertDialog();
            },
        },
    );
};

// endregion
</script>
