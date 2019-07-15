<template>
    <div>
        <ul class="menu-ul" v-for="database in tableData">
            <Accordion>
                <div slot="header">
                    <li class="border-b p-2 rounded-l text-gray-700 cursor-pointer text-left"
                        :title="`${database.official_name} (${database.tables.length} tables)`"
                        :value="database.official_name">

                        <font-awesome-icon class="mr-1" icon="database"/>

                        {{ readability ? database.pretty_name : database.official_name }}

                        <span class="text-xs font-normal">
                            ({{ getNoTables(database) }})
                        </span>
                    </li>
                </div>
                <li v-if="database.tables.length !== 0"
                    class="border-b pl-2 flex flex-row items-center justify-start cursor-pointer hover:text-indigo-500 text-sm text-gray-600 text-left"
                    :title="`${database.official_name}.${table.name.official}`"
                    :value="table.name.official"
                    @click="$emit('tableSelect', $event)"
                    v-for="table in database.tables">

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
                    This database does not contain any tables
                </li>
            </Accordion>
        </ul>
    </div>
</template>

<script>
  import Accordion from './Accordion';

  export default {
    name      : 'TableMenu',
    components: {Accordion},
    props     : ['tableData', 'readability'],

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
        @apply ml-2;

        li {
            font-family: Nunito, sans-serif !important;
            font-size: .95rem !important;
            font-weight: 400 !important;
        }

        .menu-li-no-content {
            @apply border-b;
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
