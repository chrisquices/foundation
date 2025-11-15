<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Table</p>

                <!-- Table -->
                <Card>
                    <p class="text-lg font-medium">Simple Table</p>
                    <Table size="comfortable" class="">
                        <template #head>
                            <TableHeadRow size="compact">
                                <!-- Name -->
                                <TableHeader class="w-44">
                                    <div class="flex items-center gap-2 hover:text-text">
                                        <div class="font-bold">Name</div>
                                    </div>
                                </TableHeader>

                                <!-- Email -->
                                <TableHeader>
                                    <div class="flex items-center gap-2 hover:text-text">
                                        <span>Email</span>
                                    </div>
                                </TableHeader>

                                <!-- Active -->
                                <TableHeader class="w-1">
                                    <div class="flex items-center justify-center gap-2 hover:text-text">
                                        <span>Active</span>
                                    </div>
                                </TableHeader>
                            </TableHeadRow>
                        </template>

                        <template #body>
                            <TableRow v-for="(user, index) in users.data" :key="`table-row-users-${index}`">
                                <!-- Name -->
                                <TableCell class="font-bold">{{ user.name }}</TableCell>

                                <!-- Email -->
                                <TableCell>{{ user.email }}</TableCell>

                                <!-- Active -->
                                <TableCell>
                                    <div class="flex items-center justify-center">
                                        <CircleX v-if="!user.isActive" :size="20" class="text-destructive" />
                                        <CircleCheck v-if="user.isActive" :size="20" class="text-restorative" />
                                    </div>
                                </TableCell>
                            </TableRow>
                        </template>
                    </Table>
                </Card>

                <Card>
                    <p class="text-lg font-medium">Advanced Table</p>
                    <Table size="comfortable" class="">
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

                                <!-- Actions -->
                                <TableHeader class="w-1"></TableHeader>
                            </TableHeadRow>
                        </template>

                        <template #body>
                            <TableRow v-for="(user, index) in users.data" :key="`table-row-users-${index}`">
                                <!-- Name -->
                                <TableCell>
                                    <TableCheckbox
                                        v-model="tableControls.selectedRows"
                                        :value="user.id"
                                        variant="input-foreground"
                                    />
                                </TableCell>

                                <!-- Name -->
                                <TableCell class="font-bold">{{ user.name }}</TableCell>

                                <!-- Email -->
                                <TableCell>{{ user.email }}</TableCell>

                                <!-- Active -->
                                <TableCell>
                                    <div class="flex items-center justify-center">
                                        <CircleX v-if="!user.isActive" :size="20" class="text-destructive" />
                                        <CircleCheck v-if="user.isActive" :size="20" class="text-restorative" />
                                    </div>
                                </TableCell>

                                <!-- Actions -->
                                <TableCell class="text-end">
                                    <div class="flex items-center justify-end gap-4">
                                        <!-- View -->
                                        <button aria-label="view user">
                                            <Link :href="'#'" class="w-6 cursor-pointer">
                                                <Search :size="20" />
                                            </Link>
                                        </button>

                                        <!-- Edit -->
                                        <button aria-label="edit user">
                                            <Link :href="'#'" class="w-6 cursor-pointer">
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
                    </Table>
                </Card>

                <Card>
                    <p class="text-lg font-medium">Empty Table</p>
                    <Table size="comfortable" class="">
                        <template #head>
                            <TableHeadRow size="compact">
                                <!-- Name -->
                                <TableHeader class="w-44">
                                    <div class="flex items-center gap-2 hover:text-text">
                                        <div class="font-bold">Name</div>
                                    </div>
                                </TableHeader>

                                <!-- Email -->
                                <TableHeader>
                                    <div class="flex items-center gap-2 hover:text-text">
                                        <span>Email</span>
                                    </div>
                                </TableHeader>

                                <!-- Active -->
                                <TableHeader class="w-1">
                                    <div class="flex items-center justify-center gap-2 hover:text-text">
                                        <span>Active</span>
                                    </div>
                                </TableHeader>
                            </TableHeadRow>
                        </template>
                    </Table>
                    <NoResultsFound />
                </Card>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import Card from '@/components/ui/Card.vue';
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import NoResultsFound from '@/components/ui/NoResultsFound.vue';
import SortIcon from '@/components/ui/SortIcon.vue';
import Table from '@/components/ui/Table.vue';
import TableCell from '@/components/ui/TableCell.vue';
import TableCheckbox from '@/components/ui/TableCheckbox.vue';
import TableHeadRow from '@/components/ui/TableHeadRow.vue';
import TableHeader from '@/components/ui/TableHeader.vue';
import TableRow from '@/components/ui/TableRow.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Link } from '@inertiajs/vue3';
import { CircleCheck, CircleX, Search, SquarePen, Trash2 } from 'lucide-vue-next';
import { reactive } from 'vue';

interface User {
    id: number;
    name: string;
    email: string;
    isActive: boolean;
}

const users = reactive({
    data: [
        { id: 1, name: 'Alice Johnson', email: 'alice@example.com', isActive: true },
        { id: 2, name: 'Bob Smith', email: 'bob.smith@example.com', isActive: false },
        { id: 3, name: 'Charlie Davis', email: 'charlie.davis@example.com', isActive: true },
        { id: 4, name: 'Diana Prince', email: 'diana.prince@example.com', isActive: true },
        { id: 5, name: 'Ethan Clark', email: 'ethan.clark@example.com', isActive: false },
    ] as User[],
});

const tableControls = reactive({
    sortByColumn: 'name',
    sortByDirection: 'asc' as 'asc' | 'desc',
    selectedRows: [] as number[],
});

const sortTable = (column: keyof User) => {
    if (tableControls.sortByColumn === column) {
        tableControls.sortByDirection = tableControls.sortByDirection === 'asc' ? 'desc' : 'asc';
    } else {
        tableControls.sortByColumn = column;
        tableControls.sortByDirection = 'asc';
    }

    const direction = tableControls.sortByDirection === 'asc' ? 1 : -1;
    users.data.sort((a, b) => {
        const valA = a[column];
        const valB = b[column];
        if (typeof valA === 'string' && typeof valB === 'string') {
            return valA.localeCompare(valB) * direction;
        }
        if (typeof valA === 'boolean' && typeof valB === 'boolean') {
            return (valA === valB ? 0 : valA ? 1 : -1) * direction;
        }
        return 0;
    });
};
</script>
