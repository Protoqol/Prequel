<template>
    <div class="welcome">
        <div class="img-wrapper">
            <img class="no-drag" width="75" alt="Laravel Prequel" src="/vendor/prequel/favicon.png">
        </div>
        <Migrations/>
    </div>
</template>

<script>
  import Migrations from '../MainContent/ManageDatabase/Migrations';

  export default {
    name      : 'Welcome',
    components: {Migrations},
    data() {
      return {
        url: {
          docs      : 'https://protoqol.github.io/Prequel',
          bug_report: 'https://github.com/Protoqol/Prequel/issues/new?assignees=&labels=bug&template=bug-report.md&title=%5BBUG%5D',
          github    : 'https://github.com/Protoqol/Prequel',
        },
      };
    },
  };
</script>

<style lang="scss">
    .welcome {
        @apply my-2;

        .img-wrapper {
            @apply w-full;
            @apply flex;
            @apply justify-center;
            @apply items-center;
        }

        h1 {
            @apply text-center;
            @apply text-header;
            @apply font-semibold;
            @apply text-2xl;
            @apply mt-2;
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
