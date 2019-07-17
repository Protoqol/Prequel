<template>
    <div id="empty-table-wrapper">
        <h1>
            This query did not yield any result
        </h1>
        <div class="column-overview">
            <div class="columns-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th class="table-th">
                            <p class="text-xs font-light text-secondary -mt-1" @click.prevent>
                                Column Key
                            </p>
                        </th>
                        <th class="table-th">
                            <p class="text-xs font-light text-secondary -mt-1" @click.prevent>
                                Column Field
                            </p>
                        </th>
                        <th class="table-th">
                            <p class="text-xs font-light text-secondary -mt-1" @click.prevent>
                                Column Default
                            </p>
                        </th>
                        <th class="table-th">
                            <p class="text-xs font-light text-secondary -mt-1" @click.prevent>
                                Column Type
                            </p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-row" v-for="struct in structure">
                        <td class="ellipsis table-td" :class="struct.Key ? '' : 'italic'">
                            {{struct.Key ? struct.Key : 'Not set'}}
                        </td>
                        <td class="ellipsis table-td" :class="struct.Field ? '' : 'italic'">
                            {{struct.Field ? struct.Field : 'Not set'}}
                        </td>
                        <td class="ellipsis table-td" :class="struct.Default ? '' : 'italic'">
                            {{struct.Default ? struct.Default : 'Not set'}}
                        </td>
                        <td class="ellipsis table-td" :class="struct.Type  ? '' : 'italic'">
                            {{struct.Type ? struct.Type : 'Not set'}}
                        </td>
                    </tr>
                    </tbody>
                </table>
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
    #empty-table-wrapper {
        transform: rotateX(180deg);

        h1 {
            @apply mt-4;
            @apply mb-2;
            color: var(--header-text-color);
            @apply w-full;
            @apply text-center;
        }

        .column-overview {
            @apply w-full;
            @apply flex;
            @apply flex-col;
            @apply justify-center;

            h2 {
                @apply text-black;
                @apply font-bold;
                @apply bg-gray-400;
                @apply py-2;
                @apply text-center;
                @apply mb-2;
            }

            .columns-wrapper {
                @apply flex;
                @apply flex-col;
                transform: rotateX(180deg);

                table {
                    @apply w-full;
                    @apply rounded;
                    @apply bg-gray-200;

                    thead {
                        @apply border-b;
                        border-color: var(--border-color);
                        @apply rounded;
                        @apply bg-tableColumn;

                        .table-th {
                            @apply border;
                            border-color: var(--border-color);
                            @apply p-1;
                            @apply whitespace-no-wrap;
                            @apply text-sm;
                            @apply mx-10;
                            @apply text-center;
                        }
                    }

                    .table-td {
                        @apply px-4;
                        @apply text-sm;
                        @apply text-center;
                        @apply text-secondary;
                    }
                }
            }

            .buttons-wrapper {
                @apply flex;
                @apply justify-center;

                button {
                    @apply bg-indigo-500;
                    @apply w-40;
                    @apply mt-20;
                    @apply text-white;
                    @apply font-semibold;
                    @apply py-1;
                    @apply px-3;
                    @apply rounded;
                    @apply shadow;

                    &:hover {
                        @apply bg-indigo-400;
                    }

                    &:active {
                        @apply bg-indigo-300;
                    }
                }
            }
        }
    }
</style>
