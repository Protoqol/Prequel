<template>
    <div>
        <form>
        <textarea>
            SQL Query...
        </textarea>
        </form>
    </div>
</template>

<script>
  export default {
    name: 'RunSQL',
  };
</script>

<style scoped lang="scss">
    textarea {
        @apply text-center;
        @apply bg-gray-400;
        @apply block;
        @apply uppercase;
        @apply tracking-wide;
        @apply text-gray-700;
        @apply text-xs;
        @apply font-bold;
        @apply p-2;
        @apply rounded;
        @apply mb-2;
    }
</style>
