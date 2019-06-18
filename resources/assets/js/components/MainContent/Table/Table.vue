<template>
    <div>
        <table class="w-full overflow-auto bg-gray-200">
            <thead class="border-b bg-gray-400 rounded-t">
            <tr>
                <th class="border p-2 text-sm text-gray-800 text-center cursor-pointer hover:bg-gray-300 hover:border"
                    title="Quick actions">
                    <font-awesome-icon icon="tools"/>
                </th>
                <th class="border p-2 text-sm text-gray-800 text-center cursor-pointer hover:bg-gray-300 hover:border"
                    v-for="struct in structure"
                    :title="struct.Field + ' - ' + struct.Type"
                    :type="struct.Type">
                    {{readability ? prettifyName(struct.Field) : struct.Field}}
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="data" v-for="row in data">
                <td class="text-gray-700 max-w-8 w-8 text-sm text-center cursor-pointer hover:bg-gray-400"
                    title="Inspect row">
                    <font-awesome-icon style="transform: rotate(90deg);" icon="search-plus"/>&nbsp;
                </td>
                <td class="ellipsis px-4 text-sm max-w-64 w-64 text-center cursor-pointer hover:bg-gray-300"
                    :class="!item ? 'text-gray-500 italic' : 'text-gray-700 hover:underline'"
                    :title="item ? item + ` (Length ${(item + '').length})` : 'This item is empty'"
                    v-for="item in row"
                    @contextmenu.prevent="dataModifier($event)">
                    {{item ? item : 'Nothing here'}}
                </td>
            </tr>
            </tbody>
        </table>
        <h1 v-if="!data" class="my-4 text-gray-700 w-full text-md text-center">
            This table does not contain any data
        </h1>
    </div>
</template>

<script>
  export default {
    name : 'Table',
    props: ['structure', 'data', 'readability'],

    mounted() {
      console.log('Was mounted');
    },

    methods: {
      /**
       * At right click, open contextmenu to edit data.
       * @param ev
       */
      dataModifier: function(ev) {
        console.log(ev.target);
      },

      prettifyName: function(str) {
        if (!this.$props.readability) {
          return str;
        }

        let words  = str.split(/[!@#$%^&*(),.?":{}|<>_-]/);
        let pretty = '';

        for (let i = 0; i < words.length; i++) {
          pretty += capitalise(words[i]);

          if (i !== (words.length - 1)) {
            pretty += ' ';
          }
        }

        return pretty;
      },

    },
  };
</script>

<style>
    .ellipsis {
        width: 300px;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
