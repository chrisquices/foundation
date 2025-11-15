<template>
    <div class="w-32 justify-end sm:w-48">
    <div class="flex items-center justify-end gap-4">

        <!-- Options -->
        <Dropdown width="100" direction="top">
            <template #trigger>
                <div
                    class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-full text-text transition-all duration-300"
                >
                    <i class="lni lni-user-4 lni-flip-x cursor-pointer !text-xl"></i>
                    Settings
                </div>
            </template>

            <template #content>
                <ul class="max-h-80 w-full overflow-y-auto">
<!--                    <li class="cursor-pointer px-4 py-2 whitespace-nowrap hover:bg-hover text-text">-->
<!--                        <Link :href="route('settings.index')" class="flex items-center gap-2">-->
<!--                            <i class="lni lni-gear-1"></i>-->
<!--                            <p>Account Settings</p>-->
<!--                        </Link>-->
<!--                    </li>-->

<!--                    <li class="cursor-pointer px-4 py-2 whitespace-nowrap hover:bg-hover text-text">-->
<!--                        <Link :href="route('premium.index')" class="flex items-center gap-2">-->
<!--                            <i class="lni lni-star-fat"></i>-->
<!--                            <p>Premium</p>-->
<!--                        </Link>-->
<!--                    </li>-->

                    <li class="cursor-pointer px-4 py-2 whitespace-nowrap hover:bg-hover text-text">
                        <a href="#" @click.prevent="submitLogout" class="flex items-center gap-2">
                            <i class="lni lni-exit lni-flip-x"></i>
                            <p>Logout</p>
                        </a>

                        <form id="logout-form" :action="route('backend.logout')" method="POST" class="hidden">
                            <input type="hidden" name="_token" />
                        </form>
                    </li>
                </ul>
            </template>
        </Dropdown>
    </div>
    </div>
</template>

<script lang="ts">
import { Link } from '@inertiajs/vue3';
import Dropdown from '@/components/ui/Dropdown.vue';
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'NavUser',

    components: {
        Dropdown,
        Link
    },

    data() {
        return {
        };
    },

    methods: {
        submitLogout() {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (token) {
                document.querySelector('#logout-form input[name="_token"]').value = token;
                document.getElementById('logout-form').submit();
            } else {
                console.error('CSRF token not found.');
            }
        },
    },
});
</script>
