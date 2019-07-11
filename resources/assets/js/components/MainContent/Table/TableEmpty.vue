<template>
    <div class="empty-table-wrapper">
        <h1>
            This query did not yield any result
        </h1>
        <div class="column-overview">
            <h2>Columns in this table</h2>
            <br>
            <div class="columns-wrapper">
                <p v-for="struct in structure">{{struct.Field}}</p>
            </div>
        </div>
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

        .column-overview {
            @apply w-full;
            @apply flex;
            @apply justify-center;

            .columns-wrapper {
                @apply flex;
                @apply flex-col;
            }
        }
    }
</style>
