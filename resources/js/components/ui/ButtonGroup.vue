<template>
    <!-- Default design: small centered dividers -->
    <div
        v-if="!alt"
        :style="`--divider-color: var(--${variant}-border);`"
        class="flex w-fit items-stretch
      [&>*]:relative [&>*]:focus-visible:z-10 [&>*]:focus-visible:relative
      [&>*:not(:first-child)]:rounded-l-none [&>*:not(:last-child)]:rounded-r-none
      [&>*:not(:first-child)]:border-l-0 [&>*:not(:last-child)]:border-r-0
      [&>*:not(:first-child)]:before:content-[''] [&>*:not(:first-child)]:before:absolute
      [&>*:not(:first-child)]:before:left-0 [&>*:not(:first-child)]:before:top-1/4
      [&>*:not(:first-child)]:before:h-1/2 [&>*:not(:first-child)]:before:w-px
      [&>*:not(:first-child)]:before:bg-[var(--divider-color)]"
    >
        <slot />
    </div>

    <!-- Alt design: full-height dividers -->
    <div
        v-else
        :style="`--divider-color: var(--${variant}-border);`"
        class="flex w-fit items-stretch
      [&>*]:relative [&>*]:focus-visible:z-10 [&>*]:focus-visible:relative
      [&>*:not(:first-child)]:rounded-l-none [&>*:not(:last-child)]:rounded-r-none
      [&>*:not(:first-child)]:border-l-0 [&>*:not(:last-child)]:border-r-0
      [&>*:not(:first-child)]:before:content-[''] [&>*:not(:first-child)]:before:absolute
      [&>*:not(:first-child)]:before:left-0 [&>*:not(:first-child)]:before:top-0
      [&>*:not(:first-child)]:before:h-full [&>*:not(:first-child)]:before:w-px
      [&>*:not(:first-child)]:before:bg-[var(--divider-color)]"
    >
        <slot />
    </div>
</template>


<script setup lang="ts">
type Variant =
    | 'primary'
    | 'secondary'
    | 'transparent'
    | 'restorative'
    | 'destructive'
    | 'warning'
    | 'info'

const props = defineProps<{
    alt?: boolean
    variant?: Variant
}>()

const { alt = false, variant = 'primary' } = props
</script>
