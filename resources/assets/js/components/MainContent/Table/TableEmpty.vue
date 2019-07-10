<template>
    <div class="empty-table-wrapper">
        <h1>
            This query did not yield any result
        </h1>
    </div>
</template>

<script>
  export default {
    name : 'TableEmpty',
    props: ['structure'],
  };
</script>

<style lang="scss">
    .empty-table-wrapper {
        transform: rotateX(180deg);

        h1 {
            @apply my-4;
            @apply text-gray-700;
            @apply w-full;
            @apply text-center;
        }
    }
</style>
