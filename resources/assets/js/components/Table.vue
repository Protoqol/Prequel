<template>
    <table class="w-full overflow-auto bg-gray-200">
        <thead class="border-b bg-gray-400 rounded-t">
        <tr>
            <th class="border p-2 text-sm text-gray-800 text-center cursor-pointer hover:bg-gray-300 hover:border"
                title="Quick actions">
                <font-awesome-icon icon="tools"/>
            </th>
            <th class="border p-2 text-sm text-gray-800 text-center cursor-pointer hover:bg-gray-300 hover:border"
                v-for="struct in table.structure"
                :title="struct.Field + ' - ' + struct.Type"
                :type="struct.Type">
                {{prettifyName(struct.Field)}}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="table.data.data.length > 0" v-for="row in table.data.data">
            <td class="text-gray-700 text-sm text-center cursor-pointer hover:bg-gray-400" title="Inspect row">
                <font-awesome-icon style="transform: rotate(90deg);" icon="search-plus"/>&nbsp;
            </td>
            <td class="text-sm text-center cursor-pointer hover:bg-gray-300"
                :class="!item ? 'text-gray-500 italic' : 'text-gray-700 hover:underline'"
                v-for="item in row"
                :title="item ? item + ` (Length ${item.length})` : 'This item is empty'">
                {{item ? cutString(item) : 'Nothing here'}}
            </td>
        </tr>
        <tr v-else>
            <td>This table does not have any data</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "Table",
        props: ['table', 'readability'],
        methods: {
            cutString: function (str) {
                if (str.length >= 24) {
                    return str.substring(0, 24) + '...';
                }
                return str;
            },
            prettifyName: function(str) {
                if(!this.$props.readability){
                    return str;
                }

                let words      = str.split(/[!@#$%^&*(),.?":{}|<>_-]/);
                let pretty = '';

                for (let i = 0; i < words.length; i++) {
                    pretty += capitalise(words[i]);

                    if (i !== (words.length - 1)) {
                        pretty += ' ';
                        continue;
                    }
                }

                return pretty;
            }
        }
    }
</script>

<style scoped>

</style>
