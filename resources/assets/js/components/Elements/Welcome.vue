<template>
    <div class="welcome">
        <h1>Overview</h1>
        <div class="status-cards">
            <Migrations class="flex-1"/>
            <DatabaseStatus class="flex-1"/>
            <Migrations class="flex-1"/>
        </div>
    </div>
</template>

<script>
  import Migrations     from '../MainContent/ManageDatabase/Migrations';
  import DatabaseStatus from '../MainContent/ManageDatabase/DatabaseStatus';

  export default {
    name      : 'Welcome',
    components: {DatabaseStatus, Migrations},
    data() {
      return {
        //
      };
    },
  };
</script>

<style lang="scss">
    .welcome {
        @apply my-2;

        .status-cards {
            @apply flex;
            @apply flex-wrap;
            @apply mt-2;
            @apply bg-gray-100;
            @apply border-t;
            @apply border-b;
        }

        h1 {
            @apply text-left;
            @apply text-header;
            @apply font-normal;
            @apply text-lg;
            @apply mt-2;
            @apply ml-2;
        }

        .button-wrapper {
            @apply flex;
            @apply justify-center;
            @apply my-2;

            a {
                @apply text-white;
                @apply font-bold;
                @apply py-1;
                @apply px-4;
                @apply rounded-full;
                @apply mx-1;
            }
        }
    }
</style>
