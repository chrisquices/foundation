<template>
    <p v-if="error" class="text-destructive text-xs">{{ error }}</p>
</template>

<script>
export default {
    name: "InputError",

    props: {
        error: {
            type: String,
            default: "",
        },
    },
};
</script>
