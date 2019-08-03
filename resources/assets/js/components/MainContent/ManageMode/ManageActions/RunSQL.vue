<template>
    <div>
        <form>
            <label v-highlightjs="query">
                <textarea class="mysql" placeholder="SQL Query..." v-model="query"></textarea>
            </label>
        </form>
    </div>
</template>

<script>
  export default {
    name: 'RunSQL',
    data() {
      return {
        'query': '',
      };
    },
  };
</script>

<style scoped lang="scss">
    textarea {
        font-family : "Fira Code Retina", Ubuntu, monospace;
        @apply w-3/4;
        @apply h-24;
        @apply text-left;
        @apply bg-gray-300;
        @apply block;
        @apply tracking-wide;
        @apply text-gray-700;
        @apply rounded;
        @apply m-2;
        @apply p-2;
    }
</style>
