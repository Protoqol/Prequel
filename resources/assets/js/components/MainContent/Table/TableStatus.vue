<template>
    <div class="w-full flex justify-center">

        <div v-if="loading && !tableLoadError" class="flex flex-row items-center justify-center my-12 w-full">
            <img class="loader-color-fix" width="20" height="20" :src="$root.prequel.asset.loader"
                 alt="Loading table data...">
            <p class="ml-2 text-gray-500">
                Loading table data...
            </p>
        </div>

        <div v-if="tableLoadError && !loading" class="flex flex-col items-center justify-center my-12 w-full">
            <h1 class="mb-2 text-xl text-red-500">
                There was an error while loading this table. See the following:
            </h1>
            <pre class="whitespace-normal p-2 rounded bg-gray-300 text-center max-w-2xl" v-highlightjs>
                <code class="sql">{{tableErrorDetailed ? tableErrorDetailed : 'Could not resolve error'}}</code>
            </pre>
            <h4 class="mt-4 text-center uppercase text-lg text-normal text-red-500">
                Prequel suggests looking at the following points
            </h4>
            <code v-for="error in errorResolver(tableErrorDetailed)">
                - {{error}}
            </code>
        </div>

    </div>
</template>

<script>
  export default {
    name   : 'TableStatus',
    props  : ['loading', 'tableErrorDetailed', 'tableLoadError'],
    methods: {
      errorResolver: function(errorMsg) {
        let errorCollection = [];

        if (errorMsg.includes('1370')) {
          errorCollection.push('The current user might not have permission to look into this table.');
          errorCollection.push('This table might be malformed OR this table is a view.');
        }

        if (errorCollection.length === 0) {
          errorCollection.push('Prequel could not make sense of the current error!');
        }

        return errorCollection;
      },
    },
  };
</script>

<style scoped>
    .loader-color-fix {
        filter: hue-rotate(23deg);
    }
</style>
