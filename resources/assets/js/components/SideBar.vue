<template>
    <div class="inline-block">

        <!--    Menu    -->
        <ul class="ml-2 mt-2" v-for="(value, key) in databases">

            <!--    Database Name      -->
            <li class="text-base cursor-pointer hover:text-blue-600 text-gray-700 text-left font-bold"
                :title="`${value.official_name} (${value.columns.length} tables)`"
                :value="value.official_name">

                <font-awesome-icon icon="database"/>&nbsp;
                {{ readability ? key : value.official_name }}

            </li>

            <!--    Table Names        -->
            <li class="ml-4 cursor-pointer hover:text-blue-400 text-sm text-gray-600 text-left"
                v-for="table in value.columns"
                v-on:click="$emit('tableSelect', $event.target)"
                :title="`${value.official_name}.${table.name.official}`"
                :value="`${value.official_name}.${table.name.official}`">

                <font-awesome-icon icon="table"/>&nbsp;
                {{ readability ? table.name.pretty : table.name.official }}

            </li>

        </ul>

    </div>
</template>

<script>
    export default {
        name: "SideBar",
        props: ['readability'],
        data() {
            return {
                databases: window.Prequel.databases
            }
        },
        methods: {
            selectTable: table => {
                this.$emit('tableSelect', table)
            }
        }
    }
</script>

<style scoped lang="scss">

</style>
