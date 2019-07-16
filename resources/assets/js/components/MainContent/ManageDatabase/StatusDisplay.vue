<template>
    <div id="db-status-wrapper">
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
    name : 'StatusDisplay',
    props: ['header', 'value', 'unit'],
  };
</script>

<style lang="scss">
    #db-status-wrapper {
        @apply flex-1;
        @apply w-40;
        @apply bg-gray-100;
        @apply py-4;
        @apply px-2;
        @apply border-l;
        @apply border-r;

        h1 {
            @apply flex;
            @apply flex-row;
            @apply justify-between;
            @apply text-lg;
            @apply text-left;
            @apply ml-2;
            @apply text-gray-700;
        }

        h2 {
            @apply text-black;
            @apply text-xl;
            @apply mt-4;
            @apply text-center;
        }
    }
</style>
