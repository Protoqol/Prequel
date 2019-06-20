<template>
    <div>
        <ul class="ml-2" v-for="database in tableData">
            <Accordion>
                <div slot="header">
                    <li class="border-b p-2 rounded-l text-gray-700 cursor-pointer text-left"
                        :title="`${database.official_name} (${database.tables.length} tables)`"
                        :value="database.official_name">

                        <font-awesome-icon class="mr-1" icon="database"/>

                        {{ readability ? database.pretty_name : database.official_name }}

                        <span class="text-xs font-normal">
                            ({{ database.tables.length }})
                        </span>
                    </li>
                </div>
                <li v-if="database.tables.length !== 0"
                    class="border-b pl-2 flex flex-row items-center justify-start cursor-pointer hover:text-indigo-500 text-sm text-gray-600 text-left"
                    :title="`${database.official_name}.${table.name.official}`"
                    :value="table.name.official"
                    @click="$emit('tableSelect', $event)"
                    v-for="table in database.tables">

                    <font-awesome-icon class="mr-2 hover:text-gray-700" icon="asterisk"
                                       :title="`${database.official_name}.${table.name.official}`"/>

                    <font-awesome-icon class="mr-2 hover:text-gray-700" icon="table"
                                       :title="`${database.official_name}.${table.name.official}`"/>

                    <span class="table-name-animation break-words hover:text-blue-400"
                          style="max-width: 80%;"
                          :title="database.official_name + '.' + table.name.official">
                                {{ readability ? table.name.pretty : table.name.official }}
                    </span>
                </li>
                <li v-if="database.tables.length === 0"
                    class="border-b pl-2 flex flex-row items-center justify-start text-sm text-gray-600 text-left">
                    This database does not contain any data
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
  };
</script>

<style scoped>
    li {
        font-family: Nunito, sans-serif !important;
        font-size: .95rem !important;
        font-weight: 400 !important;
    }
</style>
