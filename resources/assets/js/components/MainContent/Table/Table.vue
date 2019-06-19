<template>
    <div>
        <table v-if="data.length !== 0" class="w-full overflow-auto bg-gray-200">
            <thead class="border-b bg-gray-400 rounded-t">
            <tr>
                <th class="border p-2 text-sm text-gray-800 text-center cursor-pointer hover:bg-gray-300 hover:border"
                    title="Quick actions">
                    <font-awesome-icon icon="tools"/>
                </th>
                <th class="border p-2 whitespace-no-wrap text-sm  text-center cursor-pointer hover:bg-gray-300"
                    :class="struct.Key === 'PRI' ? 'text-indigo-800' : 'text-gray-800'"
                    :title="struct.Field + ' - ' + struct.Type"
                    :type="struct.Type"
                    v-for="struct in structure">
                    {{readability ? prettifyName(struct.Field) : struct.Field}}
                    <br>
                    <p class="text-xs font-light text-gray-700 -mt-1">{{struct.Type}}</p>
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
                    :id="item ? item : ENUM.PREQUEL_UNDEFINED"
                    :class="!item ? 'text-gray-500 italic' : 'text-gray-700 hover:underline'"
                    :title="item ? item + ` (Length ${(item + '').length})` : 'This item is empty'"
                    :contenteditable="false"
                    @contextmenu.prevent="dataModifier($event)"
                    v-for="item in row">
                    {{item ? item : 'Nothing here'}}
                </td>
            </tr>
            </tbody>
        </table>
        <TableEmpty v-if="data.length === 0" :structure="structure"/>
    </div>
</template>

<script>
  import TableEmpty from './TableEmpty';

  export default {
    name      : 'Table',
    components: {TableEmpty},
    props     : ['structure', 'data', 'readability'],

    data() {
      return {

        /**
         * Holds data about table view
         */
        view: {
          params: new URLSearchParams(window.location.search),
          cell  : {
            selected: {},
            editing : false,
          },
        },

        /**
         * Enumerator
         */
        ENUM: {
          PREQUEL_UNDEFINED: 'PREQUEL_UNDEFINED',
        },
      };
    },

    methods: {

      /**
       * At right click, open contextmenu to edit data.
       * @param ev $event
       */
      dataModifier: function(ev) {
        if (ev.target.id === this.ENUM.PREQUEL_UNDEFINED) {
          return true;
        }

        if (this.view.cell.selected.length) {
          this.view.cell.selected.classList.remove('bg-white', 'border', 'cursor-text');
          this.view.cell.selected.classList.add('ellipsis', 'hover:underline', 'hover:bg-gray-300');
          this.view.cell.selected.contentEditable = false;
          this.view.cell.selected                 = {};
        }

        this.view.cell.selected = ev.target;
        this.view.cell.editing  = true;

        this.view.cell.selected.contentEditable = true;
        this.view.cell.selected.classList.remove('ellipsis', 'hover:underline', 'hover:bg-gray-300');
        this.view.cell.selected.classList.add('bg-white', 'border', 'cursor-text');

        return true;
      },

      /**
       * Prettify table column names.
       *
       * @param str
       * @returns {string|string|*}
       */
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
