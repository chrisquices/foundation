<template>
    <Head title="Permissions" />

    <AuthLayout>
        <Heading>
            <!-- Title -->
            <h1 class="w-full text-2xl font-medium">Permissions</h1>

            <div class="flex items-center justify-between gap-4">
                <!-- Search -->
                <TextInputSearch v-model="tableControls.search" placeholder="Press ⌘ + . to search" />
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
                            <!-- Category -->
                            <TableHeader class="w-44">
                                <div
                                    class="flex items-center gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'category' }"
                                    @click="sortTable('category')"
                                >
                                    <div class="font-bold">Category</div>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'category'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

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

                            <!-- Code -->
                            <TableHeader>
                                <div
                                    class="flex items-center gap-2 hover:text-text"
                                    :class="{ 'text-text': tableControls.sortByColumn === 'code' }"
                                    @click="sortTable('code')"
                                >
                                    <span>Code</span>
                                    <SortIcon
                                        v-if="tableControls.sortByColumn === 'code'"
                                        :direction="tableControls.sortByDirection"
                                    />
                                </div>
                            </TableHeader>

                            <!-- Actions -->
                            <TableHeader class="w-1"></TableHeader>
                        </TableHeadRow>
                    </template>

                    <template #body>
                        <TableRow
                            v-for="(permission, index) in permissions.data"
                            :key="`table-row-permissions-${index}`"
                        >
                            <!-- Category -->
                            <TableCell class="font-bold">{{ permission.category }}</TableCell>

                            <!-- Name -->
                            <TableCell class="font-bold">{{ permission.name }}</TableCell>

                            <!-- Code -->
                            <TableCell class="font-bold">{{ permission.code }}</TableCell>

                            <!-- Actions -->
                            <TableCell class="text-end">
                                <div class="flex items-center justify-end gap-4">
                                    <!-- View -->
                                    <button aria-label="view permission">
                                        <Link
                                            :href="PermissionController.show(permission.id)"
                                            class="w-6 cursor-pointer"
                                        >
                                            <Search :size="20" />
                                        </Link>
                                    </button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </template>

                    <template #empty>
                        <NoResultsFound v-if="!permissions.data.length" />
                    </template>

                    <template #pagination>
                        <TablePagination :data="permissions" />
                    </template>
                </Table>
            </Card>
        </Content>
    </AuthLayout>
</template>

<script setup lang="ts">
// region --- Import ---------------------------------------------------------------------------------------------------
import PermissionController from '@/actions/App/Http/Controllers/Backend/PermissionController';
import Card from '@/components/ui/Card.vue';
import Content from '@/components/ui/Content.vue';
import NoResultsFound from '@/components/ui/NoResultsFound.vue';
import Select from '@/components/ui/Select.vue';
import SortIcon from '@/components/ui/SortIcon.vue';
import Table from '@/components/ui/Table.vue';
import TableCell from '@/components/ui/TableCell.vue';
import TableHeader from '@/components/ui/TableHeader.vue';
import TableHeadRow from '@/components/ui/TableHeadRow.vue';
import TablePagination from '@/components/ui/TablePagination.vue';
import TableRow from '@/components/ui/TableRow.vue';
import TextInputSearch from '@/components/ui/TextInputSearch.vue';
import Heading from '@/layouts/app/Heading.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { debounce } from 'lodash-es';
import { Search } from 'lucide-vue-next';
import { defineProps, ref, watch } from 'vue';
// endregion

// region --- Types ----------------------------------------------------------------------------------------------------
type SortByColumn = 'category' | 'name' | 'code';

type SortByDirection = 'asc' | 'desc';
// endregion

// region --- Setup ----------------------------------------------------------------------------------------------------
const props = defineProps<{
    permissions: PaginatedPermissions;
    params: {
        recordsPerPage: 10 | 20 | 50 | 100;
        search: string;
        page: number;
        sortByColumn: 'category' | 'name' | 'code';
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
interface Permission {
    id: number;
    category: string;
    name: string;
    code: string;
}

interface PaginatedPermissions {
    data: Permission[];
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
}

const tableControls = ref<TableControls>({
    search: '',
    recordsPerPage: 10,
    sortByColumn: 'category',
    sortByDirection: 'asc',
});

const reload = () => {
    router.get(
        PermissionController.index(),
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
</script>
