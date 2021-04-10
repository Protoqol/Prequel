<template>
    <div class="table-status-wrapper">
        <div v-if="loading && !tableLoadError" class="table-status-loading">
            <img width="20" height="20" :alt="trans('table_status.loading_data')" :src="$root.prequel.asset.loader"/>
            <p>{{trans('table_status.loading_data')}}</p>
        </div>

        <div v-if="tableLoadError && !loading" class="table-status-error">
            <h1>{{trans('table_status.error_occurred')}}</h1>
            <pre>
                <code class="sql">
                    {{tableErrorDetailed ? tableErrorDetailed : trans('table_status.could_not_resolve')}}
                </code>
            </pre>
            <h4>
                {{trans('table_status.prequel_suggestions')}}
            </h4>
            <code v-for="error in errorResolver(tableErrorDetailed)">- {{error}}</code>
        </div>
    </div>
</template>

<script>
export default {
    name   : "TableStatus",
    props  : ["loading", "tableErrorDetailed", "tableLoadError"],
    methods: {
        errorResolver: function(errorMsg) {
            let errorCollection = [];

            // General error: 1370
            if (errorMsg.includes("1370")) {
                errorCollection.push(
                    "The current user might not have permission to look into this table.",
                );
                errorCollection.push(
                    "This table might be malformed OR this table is a view.",
                );
            }

            // General error: 3167
            if (errorMsg.includes("3167")) {
                errorCollection.push(
                    "This feature might be disabled.",
                );
            }

            // If no suggestions were found.
            if (errorCollection.length === 0) {
                errorCollection.push(
                    "Prequel could not suggest any fixes.",
                );
            }

            return errorCollection;
        },
    },
};
</script>

<style lang="scss">
    .table-status-wrapper {
        @apply w-full;
        @apply flex;
        @apply justify-center;

        .table-status-loading {
            @apply flex;
            @apply flex-row;
            @apply items-center;
            @apply justify-center;
            @apply my-12;
            @apply w-full;

            img {
                filter: hue-rotate(23deg);
            }

            p {
                @apply ml-2;
                @apply text-gray-500;
            }
        }

        .table-status-error {
            @apply flex;
            @apply flex-col;
            @apply items-center;
            @apply justify-center;
            @apply my-12;
            @apply w-full;

            h1 {
                @apply mb-2;
                @apply text-xl;
                @apply text-red-500;
            }

            h4 {
                @apply mt-4;
                @apply text-center;
                @apply uppercase;
                @apply text-lg;
                @apply text-red-500;
            }

            pre {
                @apply whitespace-normal;
                @apply p-2;
                @apply rounded;
                @apply bg-gray-300;
                @apply text-center;
                @apply max-w-2xl;
            }
        }
    }
</style>
