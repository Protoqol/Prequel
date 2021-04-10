<template>
    <div class="status">
        <h1>
            {{header}}
            <slot ref="alert"></slot>
        </h1>
        <h2> {{value}}
            <small v-if="unit">/ {{unit}}</small>
        </h2>
    </div>
</template>

<script>
export default {
    name:  "StatusDisplay",
    props: ["header", "value", "unit"],
};
</script>

<style scoped lang="scss">
    .status {
        @apply flex-1;
        @apply w-40;
        background-color: var(--table-item-overview);
        @apply py-4;
        @apply px-2;
        @apply border-l;
        @apply border-r;
        border-color: var(--border-color);

        h1 {
            @apply flex;
            @apply flex-row;
            @apply justify-between;
            @apply text-lg;
            @apply text-left;
            @apply ml-2;
            color: var(--header-text-color);
        }

        h2 {
            color: var(--text-secondary-color);
            @apply text-xl;
            @apply mt-4;
            @apply text-center;
        }
    }
</style>
