<template>
    <div class="sidebar-wrapper">
        <label>
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
        <TableMenu :table-data="tableData"
                   :readability="readability"
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
