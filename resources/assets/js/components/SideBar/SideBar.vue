<template>
    <div style="min-width: 15%; width: 17%;" class="inline-block">
        <label>
            <input class="ml-2 appearance-none border w-full rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none"
                   style="width: 97%;"
                   type="text"
                   placeholder="Look for table...">
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
    props     : ['readability', 'tableData'],
  };
</script>
