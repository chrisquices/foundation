<!--<div class="navbar flex-wrap lg:flex-nowrap bg-white dark:bg-slate-950 border-b-[1px] dark:border-slate-700  px-0 relative !z-40 pr-0 lg:pr-6">-->
<!--    <div class="w-full lg:w-80 mt-2 lg:mt-0 flex justify-items-start">-->
<!--        <img src="{{ Vite::asset('resources/backend/img/logo-alt.svg') }}" alt="logo" class="h-7 lg:mx-6 dark:hidden">-->
<!--        <img src="{{ Vite::asset('resources/backend/img/logo-alt-white.svg') }}" alt="logo" class="h-7 mx-auto lg:mx-6 hidden dark:block">-->
<!--    </div>-->
<!--    <div class="flex grow w-full lg:w-auto justify-between items-center m-4 mb-3 lg:m-0 lg:mb-0 gap-4 mr-4 lg:mr-10">-->
<!--        <div>-->
<!--            <label for="btn-sidebar" class="drawer-button lg:hidden">-->
<!--                <x-heroicon-o-bars-4 class="h-8 w-8"/>-->
<!--            </label>-->
<!--        </div>-->
<!--    -->
<!--        <livewire:backend.global-search/>-->
<!--    -->
<!--        <div class="flex gap-4">-->
<!--            @include('backend.partials.topbar.themes')-->
<!--            @include('backend.partials.topbar.user')-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<template>
    <div class="sticky top-0 z-10 flex h-16 items-center gap-4 border-b border-border bg-sidebar-background px-8">
        <div class="flex h-full w-auto flex-shrink-0 items-center justify-items-start gap-4 lg:w-72">
            <div class="flex items-center justify-center gap-4">
                <img :src="logoUrl" alt="logo" class="h-10" />

                <p class="hidden text-xl font-medium lg:block">Foundation</p>
            </div>
        </div>

        <div class="flex flex-grow items-center justify-between gap-4">
            <div class="flex-grow">
                <div class="dropdown dropdown-bottom w-full lg:w-80">
                    <TextInput
                        variant="input-foreground"
                        v-model="search"
                        id="global_search"
                        tabindex="0"
                        class="w-full !rounded-3xl border-0 text-text lg:w-80"
                        placeholder="Press ⌘ + / to search"
                        autocomplete="off"
                    />
                </div>
            </div>

            <div class="flex flex-shrink-0 justify-end gap-4 lg:w-36 lg:pr-4">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-background text-text">
                    <Moon v-if="theme === 'light'" :size="18" @click="updateTheme('dark')" class="cursor-pointer" />

                    <Sun v-else :size="18" @click="updateTheme('light')" class="cursor-pointer" />
                </div>

                <Dropdown direction="left">
                    <template #trigger>
                        <div class="flex cursor-pointer items-center gap-4" tabindex="0">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-background text-text"
                            >
                                <img :src="pikachu" alt="profile photo" class="rounded-full" />
                            </div>
                        </div>
                    </template>

                    <template #content>
                        <ul class="!cursor-pointer">
                            <li class="rounded-t-lg px-4 py-2 whitespace-nowrap text-text hover:bg-hover">
                                <Link :href="ProfileController.edit()">Profile</Link>
                            </li>
                            <li class="rounded-b-lg px-4 py-2 whitespace-nowrap text-text hover:bg-hover">
                                <Link :href="AuthController.logout()" class="!cursor-pointer">Logout</Link>
                            </li>
                        </ul>
                    </template>
                </Dropdown>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import AuthController from '@/actions/App/Http/Controllers/Backend/AuthController';
import PreferenceController from '@/actions/App/Http/Controllers/Backend/PreferenceController';
import ProfileController from '@/actions/App/Http/Controllers/Backend/ProfileController';
import Dropdown from '@/components/ui/Dropdown.vue';
import TextInput from '@/components/ui/TextInput.vue';
import logoUrl from '@img/logo.svg';
import pikachu from '@img/pikachu.jpg';
import { Link, router, usePage } from '@inertiajs/vue3';
import { Moon, Sun } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import { toast } from 'vue-sonner';

const theme = computed(() => page.props.auth.user.preferences.theme);

// reactive state
const search = ref('');
const hoveredItem = ref<string | null>(null);

// page component (from Inertia)
const page = usePage();
const routeActivePage = computed(() => {
    const component = page.component;

    if (component.startsWith('dashboard')) return 'dashboard';
    if (component.startsWith('portfolios')) return 'portfolios';
    if (component.startsWith('watchlists')) return 'watchlists';
    if (component.startsWith('calendar')) return 'calendar';
    if (component.startsWith('accounts')) return 'accounts';
    if (component.startsWith('settings')) return 'settings';

    return '';
});

const currentActive = computed(() => hoveredItem.value || routeActivePage.value);

const updateTheme = (theme: string) => {
    router.patch(
        PreferenceController.update(),
        {
            name: 'theme',
            value: theme,
        },
        {
            preserveScroll: true,
            onError: (errors: Record<string, string>) => {
                Object.values(errors).forEach((message) => toast.error(message));
            },
            onFinish: () => {
                window.location.reload();
            },
        },
    );
};
</script>
