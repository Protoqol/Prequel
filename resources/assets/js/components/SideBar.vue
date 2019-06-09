<template>
    <div style="min-width: 15%; width: 17%;" class="inline-block">
        <ul class="ml-2" v-for="database in databases">
            <Accordion theme="purple">
                <div slot="header">
                    <li class="border-b p-2 bg-indigo-300 rounded-l text-base text-gray-800 cursor-pointer hover:text-gray-700 text-left font-bold"
                        :title="`${database.official_name} (${database.tables.length} tables)`"
                        :value="database.official_name">
                        <font-awesome-icon icon="database"/>&nbsp;
                        {{ readability ? database.pretty_name : database.official_name }}
                        <span class="text-xs font-normal text-gray-600">({{ database.tables.length }})</span>
                    </li>
                </div>
                <li v-if="database.tables.length !== 0"
                    v-for="table in database.tables"
                    class="border-b pl-2 flex flex-row items-center justify-start cursor-pointer hover:text-blue-400 text-sm text-gray-600 text-left"
                    :title="database.official_name + '.' + table.name.official"
                    :value="database.official_name + '.' + table.name.official"
                    @click="$emit('tableSelect', $event)">
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
        name: 'SideBar',
        components: {Accordion},
        props: ['readability', 'tableData'],
        data() {
            return {
                databases: window.Prequel.databases,
            };
        },
        methods: {
            /**
             * Create readable object from database and table
             *
             * @param db
             * @param table
             * @returns {{database: *, table: *}}
             */
            shortList: function (db, table) {
                return {
                    'database': db,
                    'table': table,
                };
            },
        },
    };
</script>

<style lang="scss">
    .table-name-animation {
        transition: .5s ease;
    }
</style>
