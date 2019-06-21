<template>
    <div class="block h-full bg-white rounded shadow">

        <div v-if="!welcomeShown">
            <Welcome/>
        </div>

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
</template>

<script>
  import Table       from './Table/Table';
  import TableStatus from './Table/TableStatus';
  import Welcome     from '../Elements/Welcome';

  export default {
    name      : 'MainContent',
    components: {Welcome, TableStatus, Table},
    props     : ['structure', 'data', 'readability', 'loading', 'tableLoadError', 'tableErrorDetailed', 'welcomeShown'],
  };
</script>
