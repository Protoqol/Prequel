<template>
    <div class="main-content-wrapper bg-component">

        <div v-if="!welcomeShown">
            <Dashboard/>
        </div>

        <div v-if="mode === $root.view.modus.enum.BROWSE">
            <TableStatus v-if="loading || tableLoadError"
                         :loading="loading"
                         :table-error-detailed="tableErrorDetailed"
                         :table-load-error="tableLoadError"/>

            <Table v-if="!loading && !tableLoadError && welcomeShown"
                   :data="data"
                   :readability="readability"
                   :structure="structure"
                   @columnSelect="$emit('columnSelect', $event)"/>
        </div>

        <div v-if="mode === $root.view.modus.enum.MANAGE">
            <ManageTable :data="data" :structure="structure"/>
        </div>
    </div>
</template>

<script>
import Table       from "./BrowseMode/Table/Table";
import TableStatus from "./BrowseMode/Table/TableStatus";
import Dashboard   from "../Dashboard/Dashboard";
import ManageTable from "./ManageMode/ManageTable";

export default {
    name      : "MainContent",
    components: {ManageTable, Dashboard, TableStatus, Table},
    props     : [
        "structure",
        "data",
        "readability",
        "loading",
        "tableLoadError",
        "tableErrorDetailed",
        "welcomeShown",
        "mode",
    ],
};
</script>

<style lang="scss">
    .main-content-wrapper {
        @apply block;
        @apply h-full;
        background-color: var(--main-content);
        @apply rounded;
        @apply shadow;
        @apply ml-1;
    }
</style>
