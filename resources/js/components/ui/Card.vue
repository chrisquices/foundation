<template>
    <div
        v-bind="$attrs"
        class="rounded-xl border bg-card/75 border-border space-y-8 p-8"
    >
        <slot />
    </div>
</template>

<script setup lang="ts">
defineOptions({ name: 'Card' })
</script>
