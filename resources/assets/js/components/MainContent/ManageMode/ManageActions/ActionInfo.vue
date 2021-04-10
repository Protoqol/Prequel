<template>
    <div class="action-info-wrapper">
        <h1>{{title}}</h1>
        <p>{{description}}</p>
    </div>
</template>

<script>
export default {
    name : "ActionInfo",
    props: ["title", "description"],
};
</script>

<style scoped lang="scss">
    .action-info-wrapper {
        background-color : var(--manage-navbar-bg);
        @apply mt-2;
        @apply mx-2;
        @apply p-2;
        @apply rounded;
        @apply text-gray-400;

        h1 {
            @apply text-gray-500;
        }

        p {
            @apply text-xs;
        }
    }
</style>
