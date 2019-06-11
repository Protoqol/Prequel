<template>
    <div class="block h-full bg-white rounded shadow">

        <div v-if="!welcomeShown">
            <Welcome></Welcome>
        </div>

        <TableStatus v-if="loading || tableLoadError"
                     :loading="loading"
                     :table-error-detailed="tableErrorDetailed"
                     :table-load-error="tableLoadError"></TableStatus>

        <Table v-if="!loading && !tableLoadError && Object.keys(data).length !== 0"
               :data="data"
               :structure="structure"></Table>
    </div>
</template>

<script>
  import Table       from './Table/Table';
  import TableStatus from './Table/TableStatus';
  import Welcome     from '../Elements/Welcome';

  export default {
    name      : 'MainContent',
    components: {Welcome, TableStatus, Table},
    props     : ['structure', 'data', 'loading', 'tableLoadError', 'tableErrorDetailed', 'welcomeShown'],
  };
</script>
