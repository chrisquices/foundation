<template>
    <v-tooltip v-if="hasSlot" theme="info" placement="top" :distance="8">
        <template #popper>
            <div class="space-y-2">
                <slot />
            </div>
        </template>

        <!-- Trigger icon -->
        <slot name="icon">
            <span class="flex items-center">
                <i class="lni lni-info-circle"></i>
            </span>
        </slot>
    </v-tooltip>

    <!-- If no slot used, default to v-tooltip from parent directive -->
    <span v-else>
    <slot name="icon">
        <span class="flex items-center">
            <i class="lni lni-info-circle"></i>
        </span>
    </slot>
  </span>
</template>

<script>
export default {
    name: 'InfoTooltip',

    props: {
        width: {
            type: String,
            default: ''
        }
    },

    computed: {
        hasSlot() {
            return !!this.$slots.default;
        }
    }
};
</script>
