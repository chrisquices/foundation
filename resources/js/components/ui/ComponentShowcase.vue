<template>
    <div class="w-full flex justify-center items-center">
        <Card class="relative flex flex-col w-full max-w-5xl max-h-[60rem]">
            <div class="flex flex-1 min-h-0 gap-8">
                <aside
                    class="flex flex-col transition-all duration-300 text-foreground z-50 overflow-hidden space-y-8 p-1"
                    :style="{ width: sidebarWidth }"
                >
                    <div>
                        <TextInput
                            v-model="searchQuery"
                            class="w-full"
                            type="text"
                            placeholder="Search..."
                            autofocus
                        />
                    </div>

                    <nav class="flex-1 overflow-y-auto pb-8">
                        <ul class="flex flex-col space-y-2 rounded-lg">
                            <li
                                v-for="item in filteredMenu"
                                :key="item.label"
                                class="group"
                            >
                                <Link
                                    :href="item.route"
                                    class="flex items-center px-4 py-2 rounded-lg transition-colors text-foreground"
                                    :class="{
                                        'bg-primary text-primary-foreground': isActive(item.route),
                                        'hover:bg-hover': !isActive(item.route)
                                    }"
                                >
                                    <span
                                        class="text-sm font-medium truncate"
                                        :class="{ 'hidden md:inline': isMobile && !expanded }"
                                    >
                                        {{ item.label }}
                                    </span>
                                </Link>
                            </li>

                            <li
                                class="group"
                            >
                                <p
                                    class="flex items-center px-4 py-2 rounded-lg transition-colors text-foreground"
                                >
                                    <span
                                        class="text-sm font-medium truncate"
                                        :class="{ 'hidden md:inline': isMobile && !expanded }"
                                    >
                                        More cooming soon...
                                    </span>
                                </p>
                            </li>
                        </ul>
                    </nav>
                </aside>

                <main class="flex-1 overflow-y-auto pt-1.5 p-1">
                    <slot />
                </main>
            </div>
        </Card>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import { Link } from '@inertiajs/vue3'
import ComponentController from '@/actions/App/Http/Controllers/Backend/ComponentController'
import Card from '@/components/ui/Card.vue'
import TextInput from '@/components/ui/TextInput.vue';

interface MenuItem {
    label: string
    route: string
}

const expanded = ref(false)
const isMobile = ref(false)
const searchQuery = ref('')
const currentPath = ref(window.location.pathname)

const menuItems = ref<MenuItem[]>([
    { label: 'Accordion', route: ComponentController.accordion() },
    { label: 'Alert', route: ComponentController.alert() },
    { label: 'Alert Dialog', route: ComponentController.alertDialog() },
    { label: 'Avatar', route: ComponentController.avatar() },
    { label: 'Badge', route: ComponentController.badge() },
    { label: 'Breadcrumb', route: ComponentController.breadcrumb() },
    { label: 'Button', route: ComponentController.button() },
    { label: 'Button Group', route: ComponentController.buttonGroup() },
    { label: 'Card', route: ComponentController.card() },
    { label: 'Carousel', route: ComponentController.carousel() },
    { label: 'Checkbox', route: ComponentController.checkbox() },
    { label: 'Table', route: ComponentController.table() },
    { label: 'Dialog', route: ComponentController.dialog() },
    // { label: 'Dropdown Menu', route: ComponentController.dropdownMenu() },
    { label: 'Input', route: ComponentController.input() },
    // { label: 'Radio Group', route: ComponentController.radioGroup() },
    { label: 'Select', route: ComponentController.select() },
    // { label: 'Sheet', route: ComponentController.sheet() },
    // { label: 'Sidebar', route: ComponentController.sidebar() },
    // { label: 'Switch', route: ComponentController.switch() },
    // { label: 'Tabs', route: ComponentController.tabs() },
    // { label: 'Textarea', route: ComponentController.textarea() },
])

const sidebarWidth = computed(() => {
    if (!isMobile.value) return '14rem'
    return expanded.value ? '70vw' : '3.5rem'
})

const filteredMenu = computed(() => {
    const q = searchQuery.value.toLowerCase()
    return menuItems.value
        .filter((item) => item.label.toLowerCase().includes(q))
        .sort((a, b) => a.label.localeCompare(b.label))
})

const isActive = (route: string) => {
    return window.location.pathname === new URL(route.url, window.location.origin).pathname
}

const checkMobile = () => {
    isMobile.value = window.innerWidth < 768
    if (!isMobile.value) expanded.value = false
}

onMounted(() => {
    checkMobile()
    window.addEventListener('resize', checkMobile)
    window.addEventListener('popstate', () => {
        currentPath.value = window.location.pathname
    })
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', checkMobile)
})
</script>

<style scoped>
aside {
    transition: width 0.3s ease;
}
</style>
