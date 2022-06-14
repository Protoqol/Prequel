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
  @apply bg-page;

  .table-search-input {
    border-style: var(--input-border);
    @apply appearance-none;
    @apply border;
    @apply w-full;
    @apply py-1;
    @apply px-3;
    @apply text-secondary;
    @apply leading-tight;
    @apply mb-1;
    @apply rounded;

    &:focus {
      @apply outline-none;
    }
  }

}
</style>
