<template>
    <Dialog
        :show="isDialogOpen"
        @close="toggleDialog()"
    >

        <div class="text-lg font-bold text-text mb-4">
            <slot name="title" />
        </div>

        <p class="text-sm text-text">
            <slot name="content" />
        </p>

        <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4">
            <slot name="buttons" />
        </div>

    </Dialog>
</template>

<script setup lang="ts">
import { ref, watch, nextTick, onBeforeUnmount } from 'vue'
import Dialog from '@/components/ui/Dialog.vue';

const isDialogOpen = ref(false);

function toggleDialog() {
    isDialogOpen.value = !isDialogOpen.value;
}

</script>
