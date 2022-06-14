<template>
  <div>
    <ul class="menu-ul" v-for="database in tableData">
      <div slot="header mb-2">
        <div class="list-header"
             :title="`${database.official_name} (${database.tables.length} ${trans('general.tables')})`"
             :value="database.official_name">

          > {{ readability ? database.pretty_name : database.official_name }}

          <span class="text-xs font-normal">
                ({{ getNoTables(database) }})
          </span>
        </div>
      </div>
      <label class="py-2">
        <input class="table-search-input"
               type="text"
               list="tableSearch"
               autocomplete="on"
               @keyup.enter="$emit('searchingForTable', $event)"
               :placeholder="trans('side_bar.look_for_table')">

        <datalist id="tableSearch">
          <option v-for="table in tableFlat"
                  :value="table"></option>
        </datalist>
      </label>
      <Accordion>
        <li v-if="database.tables.length !== 0"
            class="list-sub"
            :title="`${database.official_name}.${table.name.official}`"
            :value="table.name.official"
            @click="$emit('tableSelect', $event)"
            v-for="table in database.tables">

          <i class="ri-table-2 mr-1" :title="`${database.official_name}.${table.name.official}`"></i>

          <span class="table-name-animation overflow-hidden text-ellipsis"
                style="max-width: 90%;"
                :title="database.official_name + '.' + table.name.official">
              {{ readability ? table.name.pretty : table.name.official }}
          </span>
        </li>
        <li v-if="database.tables.length === 0"
            class="menu-li-no-content">
          {{ trans('table_menu.empty_table') }}
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
  props     : ["tableData", "tableFlat", "readability"],

  methods: {

    /**
     * Get number of tables
     * @param db
     * @returns {number|*}
     */
    getNoTables: function (db) {
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
    font-family: sans-serif !important;
    font-size: .95rem !important;
    font-weight: 400 !important;
    max-width: 100%;
    @apply text-black;
    @apply whitespace-nowrap;
    @apply text-ellipsis;
    @apply overflow-hidden;

    &:nth-child(even) {
      @apply bg-gray-100;
    }

    &:nth-child(odd) {
      @apply bg-white;
    }
  }

  .list-header {
    background: var(--page-background-color);
    @apply text-gray-400;
    @apply text-sm;
    @apply font-normal;
    @apply border-b;
    border-color: var(--border-color);
    @apply py-1;
    @apply px-2;
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
    @apply text-xs;
    @apply text-left;

    &:hover {
      @apply text-purple-500;
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
