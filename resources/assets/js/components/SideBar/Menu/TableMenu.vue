<template>
    <div>
        <ul class="menu-ul" v-for="database in tableData">
            <Accordion>
                <div slot="header">
                    <li class="list-header"
                        :title="`${database.official_name} (${database.tables.length} ${trans('general.tables')})`"
                        :value="database.official_name">

                        <font-awesome-icon class="mr-1" icon="database"/>

                        {{ readability ? database.pretty_name : database.official_name }}

                        <span class="text-xs font-normal">
                            ({{ getNoTables(database) }})
                        </span>
                    </li>
                </div>
                <li v-if="database.tables.length !== 0"
                    class="list-sub"
                    :title="`${database.official_name}.${table.name.official}`"
                    :value="table.name.official"
                    @click="$emit('tableSelect', $event)"
                    v-for="table in database.tables">

                    <!--        @TODO model info            -->
                    <!--                    <font-awesome-icon class="mr-2 hover:text-gray-700" icon="asterisk"-->
                    <!--                                       :title="`${database.official_name}.${table.name.official}`"/>-->

                    <font-awesome-icon class="mr-2 hover:text-gray-700" icon="table"
                                       :title="`${database.official_name}.${table.name.official}`"/>

                    <span class="table-name-animation break-words"
                          style="max-width: 80%;"
                          :title="database.official_name + '.' + table.name.official">
                                {{ readability ? table.name.pretty : table.name.official }}
                    </span>
                </li>
                <li v-if="database.tables.length === 0"
                    class="menu-li-no-content">
                    {{trans('table_menu.empty_table')}}
                </li>
            </Accordion>
        </ul>
    </div>
</template>

<script>
import Accordion from "./Accordion";

export default {
    name      : "TableMenu",
    components: {Accordion},
    props     : ["tableData", "readability"],

    methods: {

        /**
       * Get number of tables
       * @param db
       * @returns {number|*}
       */
        getNoTables: function(db) {
        // Array is countable, and should therefore work with `.length`
            if (!isNaN(db.tables.length)) {
                return db.tables.length;
            }

            // If `.length` did not work we can safely assume it's an object.
            return Object.keys(db.tables).length;
        },
    },
};
</script>

<style lang="scss" scoped>
    .menu-ul {
        background-color: var(--table-item-overview);
        @apply rounded;

        li {
            font-family: Nunito, sans-serif !important;
            font-size: .95rem !important;
            font-weight: 400 !important;
        }

        .list-header {
            color: var(--list-header-text);
            @apply border-b;
            border-color: var(--border-color);
            @apply p-2;
            @apply rounded-l;
            @apply cursor-pointer;
            @apply text-left;

            svg {
                color: #c3cbd7;
            }
        }


        .list-sub {
            color: var(--table-item-text);
            @apply py-1;
            @apply border-b;
            border-color: var(--border-color);
            @apply pl-2;
            @apply flex;
            @apply flex-row;
            @apply items-center;
            @apply justify-start;
            @apply cursor-pointer;
            @apply text-sm;
            @apply text-left;

            &:hover {
                @apply text-indigo-500;
            }
        }

        .menu-li-no-content {
            @apply border-b;
            @apply border-gray-700;
            @apply pl-2;
            @apply flex;
            @apply flex-row;
            @apply items-center;
            @apply justify-start;
            @apply text-sm;
            @apply text-gray-600;
            @apply text-left;
        }
    }
</style>
