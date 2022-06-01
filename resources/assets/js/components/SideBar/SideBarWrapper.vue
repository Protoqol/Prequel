<template>
  <div class="sidebar-wrapper">
    <TableMenu :table-data="tableData"
               :table-flat="tableFlat"
               :readability="readability"
               @searchingForTable="$emit('searchingForTable', $event)"
               @tableSelect="$emit('tableSelect', $event)"></TableMenu>
  </div>
</template>

<script>
import Accordion from "./Menu/Accordion";
import TableMenu from "./Menu/TableMenu";

export default {
  name      : "SideBar",
  components: {TableMenu, Accordion},
  props     : ["readability", "tableData", "tableFlat"],
};
</script>

<style lang="scss">
.sidebar-wrapper {
  @apply inline-block;
  min-width: 15%;
  width: 17%;
  @apply bg-gray-300;
  @apply pb-2 rounded;

  .table-search-input {
    @apply bg-input;
    border-style: var(--input-border);
    @apply appearance-none;
    @apply border;
    @apply w-full;
    @apply rounded;
    @apply shadow;
    @apply py-2;
    @apply px-3;
    @apply text-secondary;
    @apply leading-tight;
    @apply mb-1;

    &:focus {
      @apply outline-none;
    }
  }

}
</style>
