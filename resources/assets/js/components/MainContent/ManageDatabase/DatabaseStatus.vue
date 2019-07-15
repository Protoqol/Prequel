<template>
    <div id="db-status-wrapper">
        <h1>
            Queries per second (243343 p/sec)
        </h1>
        <button title="Run status check">
            <font-awesome-icon class="mr-1" icon="running"/>
            Check query speed
        </button>
    </div>
</template>

<script>
  // @TODO Write logic for this
  export default {
    name: 'DatabaseStatus',
    data() {
      return {
        //
      };
    },

    created() {
      //
    },

    methods: {},
  };
</script>

<style lang="scss">
    #db-status-wrapper {
        @apply w-56;
        @apply bg-gray-100;
        @apply py-4;
        @apply px-2;
        @apply border-l;
        @apply border-r;

        h1 {
            @apply text-lg;
            @apply text-center;
        }

        h2 {
            @apply ml-2;
            @apply text-sm;
            @apply text-left;
        }

        button {
            @apply w-full;
            @apply mt-2;
            @apply flex;
            @apply justify-center;
            @apply bg-indigo-500;
            @apply text-white;
            @apply items-center;
            @apply border;
            @apply rounded;

            &:hover {
                @apply bg-indigo-400;
            }

            &:active {
                @apply bg-indigo-300;
                @apply shadow-none;
            }

            &:disabled, &[disabled] {
                @apply bg-indigo-300;
                @apply shadow-none;
                @apply cursor-default;

                &:hover {
                    @apply bg-indigo-300;
                }
            }
        }
    }
</style>
