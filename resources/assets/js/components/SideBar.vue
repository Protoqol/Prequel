<template>
    <div class="inline-block">

        <!--    Menu    -->
        <ul class="ml-2 mt-2" v-for="database in databases">

            <!--    Database Name      -->
            <li class="text-base cursor-pointer hover:text-blue-600 text-gray-700 text-left font-bold"
                :title="`${database.official_name} (${database.tables.length} tables)`"
                :value="database.official_name">

                <font-awesome-icon icon="database"/>&nbsp;
                {{ readability ? database.pretty_name : database.official_name }}

            </li>

            <!--    Table Names        -->
            <li class="ml-4 flex flex-row items-center justify-start cursor-pointer hover:text-blue-400 text-sm text-gray-600 text-left"
                :title="database.official_name + '.' + table.name.official"
                :value="database.official_name + '.' + table.name.official"
                v-for="table in database.tables"
                @click="$emit('tableSelect', $event.target)">

                <font-awesome-icon class="mr-2 hover:text-gray-700" icon="asterisk"
                                   :title="`${database.official_name}.${table.name.official}`"/>
                <font-awesome-icon class="mr-2 hover:text-gray-700" icon="table"
                                   :title="`${database.official_name}.${table.name.official}`"/>

                <span class="table-name-animation hover:text-blue-400"
                      :title="database.official_name + '.' + table.name.official">
                        {{ readability ? table.name.pretty : table.name.official }}
                </span>
            </li>
        </ul>

    </div>
</template>

<script>
    export default {
        name: 'SideBar',
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
