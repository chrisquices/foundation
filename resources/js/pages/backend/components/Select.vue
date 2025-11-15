<template>
    <AuthLayout>
        <ComponentShowcase>
            <div class="space-y-12">
                <p class="text-lg font-semibold">Select</p>

                <Select v-model="selected1" variant="input-foreground">
                    <template #default="{ search, select }">
                        <li v-for="item in filtered(search)" :key="item" @click="select(item)">
                            {{ item }}
                        </li>
                    </template>
                </Select>

                <p class="text-lg font-semibold">Select with Search</p>

                <Select v-model="selected2" variant="input-foreground" search-enabled>
                    <template #default="{ search, select }">
                        <li v-for="item in filtered(search)" :key="item" @click="select(item)">
                            {{ item }}
                        </li>
                    </template>
                </Select>
            </div>
        </ComponentShowcase>
    </AuthLayout>
</template>

<script setup lang="ts">
import ComponentShowcase from '@/components/ui/ComponentShowcase.vue';
import Select from '@/components/ui/Select.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { ref } from 'vue';

const selected1 = ref('');
const selected2 = ref('');
const items = ['Next.js', 'SvelteKit', 'Nuxt.js', 'Remix', 'Astro'];

function filtered(search: string) {
    return items.filter((i) => i.toLowerCase().includes(search.toLowerCase()));
}
</script>
