<template>
    <div class="flex justify-start items-center gap-4 lg:flex-row">
        <div class="justify-start rounded text-text md:w-auto xl:w-auto whitespace-nowrap">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "SegmentedControls",
};
</script>
