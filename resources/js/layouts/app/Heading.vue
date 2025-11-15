<template>
    <div class="text-text space-y-4">
        <slot/>
    </div>

</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'Heading',

    components: {

    },

    data() {
        return {
        };
    },

    computed: {
    },
});
</script>
