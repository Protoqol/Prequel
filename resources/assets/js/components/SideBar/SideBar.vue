<template>
    <div class="sidebar-wrapper">
        <label>
            <input class="table-search-input"
                   type="text"
                   list="tableSearch"
                   autocomplete="on"
                   @keyup.enter="$emit('searchingForTable', $event)"
                   placeholder="Look for table...">

            <datalist id="tableSearch">
                <option v-for="table in tableFlat"
                        :value="table"></option>
            </datalist>
        </label>
        <TableMenu :table-data="tableData"
                   :readability="readability"
                   @tableSelect="$emit('tableSelect', $event)"></TableMenu>
    </div>
</template>

<script>
  import Accordion from './Accordion';
  import TableMenu from './TableMenu';

  export default {
    name      : 'SideBar',
    components: {TableMenu, Accordion},
    props     : ['readability', 'tableData', 'tableFlat'],
  };
</script>

<style lang="scss">
    .sidebar-wrapper {
        @apply inline-block;
        min-width: 15%;
        width: 17%;

        .table-search-input {
            @apply bg-white;
            @apply ml-2;
            @apply appearance-none;
            @apply border;
            @apply w-full;
            @apply rounded;
            @apply py-2;
            @apply px-3;
            @apply text-gray-700;
            @apply leading-tight;
            width: 97%;

            &:focus {
                @apply outline-none;
            }
        }

    }
</style>
