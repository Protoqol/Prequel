<template>
    <table class="w-full overflow-auto bg-gray-200">
        <thead class="border-b bg-gray-400 rounded-t">
        <tr>
            <th class="border p-2 text-sm text-gray-800 text-center">
                <font-awesome-icon icon="tools"/>
            </th>
            <th class="border p-2 text-sm text-gray-800 text-center" v-for="struct in table.structure">
                {{struct.Field}}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="border" v-for="row in table.data">
            <td class="text-gray-700 text-sm text-center cursor-pointer hover:bg-gray-400" :title="`Inspect row`">
                <font-awesome-icon style="transform: rotate(90deg);" icon="search-plus"/>&nbsp;
            </td>
            <td class="text-sm text-center cursor-pointer hover:bg-gray-300"
                :class="!item ? 'text-gray-500 italic' : 'text-gray-700'"
                v-for="item in row"
                :title="item ? item : 'This item is empty'">

                {{item ? item : 'Nothing here'}}

            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "Table",
        props: ['table']
    }
</script>

<style scoped>

</style>
