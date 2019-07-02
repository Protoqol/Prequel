<template>
    <div class="paginator-wrapper">
        <paginate :page-count="numberOfPages"
                  :force-page="parseInt(currentPage)"
                  :click-handler="pageChange"
                  :container-class="'pagination'"
                  :page-link-class="'page-item'"
                  :active-class="'page-item-active'"
                  :prev-link-class="'buttons'"
                  :next-link-class="'buttons'"
                  :prev-text="'<'"
                  :next-text="'>'">
        </paginate>
    </div>
</template>

<script>
  import Paginate from 'vuejs-paginate/src/components/Paginate';

  export default {
    name      : 'Paginator',
    props     : ['currentPage', 'numberOfPages'],
    components: {Paginate},
    methods   : {
      pageChange: function(pageNum) {
        this.$emit('pageChange', pageNum);
      },
    },
  };
</script>

<style lang="scss">
    .paginator-wrapper {
        @apply w-full;
        @apply flex;
        @apply justify-center;
        @apply my-2;

        .pagination {
            @apply flex;
        }

        .page-item {
            @apply px-2;
            @apply cursor-pointer;

            &:hover {
                @apply bg-blue-100;
            }
        }

        .page-item-active {
            @apply text-blue-400;
        }

        .buttons {
            @apply mx-2;
            @apply py-0;
            @apply px-3;
            @apply rounded;
            @apply bg-gray-300;
            @apply text-gray-800;
            @apply font-bold;

            &:hover {
                @apply bg-blue-200;
            }
        }
    }

</style>
