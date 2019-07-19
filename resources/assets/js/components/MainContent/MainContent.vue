<template>
    <div class="main-content-wrapper bg-component">

        <div v-if="!welcomeShown">
            <Welcome/>
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
            <ManageTable/>
        </div>
    </div>
</template>

<script>
  import Table       from './Table/Table';
  import TableStatus from './Table/TableStatus';
  import Welcome     from '../Elements/Welcome';
  import Management  from './ManageDatabase/Management';
  import ManageTable from './ManageTable/ManageTable';

  export default {
    name      : 'MainContent',
    components: {ManageTable, Management, Welcome, TableStatus, Table},
    props     : [
      'structure',
      'data',
      'readability',
      'loading',
      'tableLoadError',
      'tableErrorDetailed',
      'welcomeShown',
      'mode',
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
