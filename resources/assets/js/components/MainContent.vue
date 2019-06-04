<template>
    <div class="block h-full bg-white rounded shadow">
        <span v-if="loading" class="flex mt-24 flex-row items-center justify-center w-full">
            <img class="loader-color-fix" width="20" height="20" src="vendor/prequel/loader.gif"
                 alt="Loading table data...">
            <p class="ml-2 text-gray-500">Loading table data...</p>
        </span>
        <Table v-if="Object.keys(tableData).length !== 0 && !loading" :table="tableData"></Table>
    </div>
</template>

<script>
    import Table from "./Table"

    export default {
        name: "MainContent",
        components: {Table},
        props: ['tableData', 'loading']
    }
</script>

<style scoped>
    .loader-color-fix {
        filter: hue-rotate(23deg);
    }
</style>
