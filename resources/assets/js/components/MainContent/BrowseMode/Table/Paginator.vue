<template>
    <div class="paginator-wrapper">
        <paginate ref="paginate"
                  :page-count="numberOfPages"
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
import Paginate from "vuejs-paginate/src/components/Paginate";

export default {
    name      : "Paginator",
    props     : ["currentPage", "numberOfPages"],
    components: {Paginate},
    watch     : {
        currentPage(newValue) {
            this.$refs.paginate.selected = newValue;
        },
    },
    methods   : {
        pageChange: function(pageNum) {
            this.$emit("pageChange", pageNum);
        },
    },
};
</script>

<style lang="scss">
    .paginator-wrapper {
        @apply w-full;
        @apply flex;
        @apply justify-center;
        @apply mb-2;

        .pagination {
            @apply flex;
        }

        li {
            @apply text-secondary;
        }

        .page-item {
            @apply px-2;
            @apply cursor-pointer;
            &:hover {
                @apply text-gray-500;
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
            background-color: var(--input-background-color);
            @apply text-gray-800;
            @apply font-bold;
            @apply shadow;

            &:hover {
                @apply bg-blue-200;
            }

            &:active {
                @apply shadow-none;
            }
        }
    }

</style>
