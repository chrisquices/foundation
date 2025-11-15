<template>
    <!-- Sidebar Toggle Button -->
    <div
        @click="toggleSidebar"
        class="fixed bottom-10 left-0 z-50 flex cursor-pointer flex-col items-center justify-center gap-2 rounded-r-lg bg-primary px-2 py-4 shadow-lg transition-all duration-75 lg:hidden"
    >
        <ChevronRight v-if="!isSidebarOpen" :size="20" class="text-text" />
        <ChevronLeft v-else :size="20" class="text-text" />
    </div>

    <transition
        enter-active-class="transform transition duration-75"
        enter-from-class="-translate-x-full"
        enter-to-class="translate-x-0"
        leave-active-class="transform transition duration-75"
        leave-from-class="translate-x-0"
        leave-to-class="-translate-x-full"
    >
        <div
            v-if="isSidebarOpen"
            class="flex-shrink-0 transition-all duration-75 lg:relative lg:block lg:w-72"
            :class="{
                // MOBILE CLOSED (invisible, does not take space)
                'pointer-events-none hidden': !isSidebarOpen,

                // MOBILE OPEN (full overlay)
                'fixed inset-0 top-15 z-40 h-full w-full overflow-y-auto bg-card pr-6 lg:top-0 lg:bg-transparent lg:pr-0':
                    isSidebarOpen,
            }"
        >
            <div class="flex h-full flex-col overflow-y-auto">
                <div class="z-10 w-full">
                    <div class="drawer lg:drawer-open">
                        <input id="btn-sidebar" type="checkbox" class="drawer-toggle" hidden />

                        <div class="drawer-side">
                            <label for="btn-sidebar" class="drawer-overlay"></label>

                            <ul class="space-y-2 py-6 pt-5 pl-6 text-text">
                                <!-- Dashboard -->
                                <li>
                                    <Link :href="DashboardController.index()">
                                        <div
                                            class="rounded-lg px-4 py-2 font-medium transition-all duration-75 hover:bg-primary/10 hover:text-primary"
                                            :class="{
                                                'bg-primary/10 font-bold text-primary hover:bg-primary/20': [
                                                    'dashboard',
                                                ].includes(currentActive),
                                            }"
                                        >
                                            <div class="flex items-center gap-3">
                                                <House :size="20" />
                                                <p>Dashboard</p>
                                            </div>
                                        </div>
                                    </Link>
                                </li>

                                <!-- User Management -->
                                <li>
                                    <input
                                        id="user-management"
                                        type="checkbox"
                                        class="peer hidden"
                                        :checked="['users', 'roles', 'permissions'].includes(currentActive)"
                                    />
                                    <label
                                        for="user-management"
                                        class="flex cursor-pointer items-center justify-between rounded-lg py-2 pr-2 pl-4 font-medium transition-all duration-75 hover:bg-primary/10 hover:text-primary"
                                        :class="{
                                            'bg-primary/10 font-bold text-primary hover:bg-primary/20': [
                                                'users',
                                                'roles',
                                                'permissions',
                                            ].includes(currentActive),
                                        }"
                                    >
                                        <div class="flex items-center gap-3">
                                            <Users :size="20" />
                                            <p>User Management</p>
                                        </div>
                                        <div class="transition-all duration-75">
                                            <ChevronDown :size="16" class="peer-checked:hidden" />
                                            <ChevronUp :size="16" class="hidden peer-checked:block" />
                                        </div>
                                    </label>

                                    <div
                                        class="ml-6 max-h-0 overflow-hidden border-l border-border pl-3 opacity-0 transition-all duration-75 peer-checked:mt-2 peer-checked:max-h-48 peer-checked:opacity-100"
                                    >
                                        <ul class="space-y-1">
                                            <li
                                                class="rounded-lg font-medium transition-all duration-75 hover:bg-primary/10 hover:text-primary"
                                                :class="{
                                                    'bg-primary/10 font-bold text-primary hover:bg-primary/20':
                                                        currentActive === 'users',
                                                }"
                                            >
                                                <Link :href="UserController.index()">
                                                    <div class="rounded-md px-3 py-2 transition-all duration-75">
                                                        Users
                                                    </div>
                                                </Link>
                                            </li>

                                            <li
                                                class="rounded-lg font-medium transition-all duration-75 hover:bg-primary/10 hover:text-primary"
                                                :class="{
                                                    'bg-primary/10 font-bold text-primary hover:bg-primary/20':
                                                        currentActive === 'roles',
                                                }"
                                            >
                                                <Link :href="RoleController.index()">
                                                    <div class="rounded-md px-3 py-2 transition-all duration-75">
                                                        Roles
                                                    </div>
                                                </Link>
                                            </li>

                                            <li
                                                class="rounded-lg font-medium transition-all duration-75 hover:bg-primary/10 hover:text-primary"
                                                :class="{
                                                    'bg-primary/10 font-bold text-primary hover:bg-primary/20':
                                                        currentActive === 'permissions',
                                                }"
                                            >
                                                <Link :href="PermissionController.index()">
                                                    <div class="rounded-md px-3 py-2 transition-all duration-75">
                                                        Permissions
                                                    </div>
                                                </Link>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- Components -->
                                <li>
                                    <Link :href="ComponentController.index()">
                                        <div
                                            class="rounded-lg px-4 py-2 font-medium transition-all duration-75 hover:bg-primary/10 hover:text-primary"
                                            :class="{
                                                'bg-primary/10 font-bold text-primary hover:bg-primary/20': [
                                                    'components',
                                                ].includes(currentActive),
                                            }"
                                        >
                                            <div class="flex items-center gap-3">
                                                <LayoutPanelTop :size="20" />
                                                <p>Components</p>
                                            </div>
                                        </div>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup lang="ts">
import ComponentController from '@/actions/App/Http/Controllers/Backend/ComponentController';
import DashboardController from '@/actions/App/Http/Controllers/Backend/DashboardController';
import PermissionController from '@/actions/App/Http/Controllers/Backend/PermissionController';
import RoleController from '@/actions/App/Http/Controllers/Backend/RoleController';
import UserController from '@/actions/App/Http/Controllers/Backend/UserController';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronDown, ChevronLeft, ChevronRight, ChevronUp, House, LayoutPanelTop, Users } from 'lucide-vue-next';
import { computed, onMounted, onUnmounted, ref } from 'vue';

const hoveredItem = ref<string | null>(null);
const page = usePage();

const routeActivePage = computed(() => {
    const component = page.component;

    if (component.startsWith('backend/dashboard')) return 'dashboard';
    if (component.startsWith('backend/users')) return 'users';
    if (component.startsWith('backend/roles')) return 'roles';
    if (component.startsWith('backend/permissions')) return 'permissions';
    if (component.startsWith('backend/components')) return 'components';

    return '';
});

const currentActive = computed(() => hoveredItem.value || routeActivePage.value);

// AUTO sidebar state (open on desktop, closed on mobile)
const isSidebarOpen = ref(window.innerWidth >= 1024);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

// 👇 NEW — Watch for window resize
const handleResize = () => {
    if (window.innerWidth >= 1024) {
        isSidebarOpen.value = true; // always open on desktop
    } else {
        isSidebarOpen.value = false; // always closed on mobile
    }
};

onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize(); // initial check
});

// Clean up listener to avoid memory leaks
onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});
</script>
