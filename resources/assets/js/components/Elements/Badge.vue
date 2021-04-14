<template>
    <div id="badge">
        <span :class="`badge-${type}`">{{text ? text : type}}</span>
    </div>
</template>

<script>
export default {
    name : "Badge",
    props: ["type", "text"],
};
</script>

<style scoped lang="scss">
    #badge {
        color: var(--text-secondary-color-invert);

        .badge-neutral {
            @apply rounded-full;
            @apply bg-blue-300;
            @apply uppercase;
            @apply px-2;
            @apply py-1;
            @apply text-xs;
            @apply font-medium;
            @apply mr-3;
        }

        .badge-average {
            @apply rounded-full;
            @apply bg-orange-300;
            @apply uppercase;
            @apply px-2;
            @apply py-1;
            @apply text-xs;
            @apply font-bold;
            @apply mr-3;
        }

        .badge-warning {
            @apply rounded-full;
            @apply bg-orange-300;
            @apply uppercase;
            @apply px-2;
            @apply py-1;
            @apply text-xs;
            @apply font-bold;
            @apply mr-3;
        }

        .badge-critical {
            @apply rounded-full;
            @apply bg-red-300;
            @apply uppercase;
            @apply px-2;
            @apply py-1;
            @apply text-xs;
            @apply font-bold;
            @apply mr-3;
        }

        .badge-good {
            @apply rounded-full;
            @apply bg-green-300;
            @apply uppercase;
            @apply px-2;
            @apply py-1;
            @apply text-xs;
            @apply font-bold;
            @apply mr-3;
        }
    }
</style>
