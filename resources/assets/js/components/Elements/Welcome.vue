<template>
    <div class="welcome">
        <div class="img-wrapper">
            <img class="no-drag" width="175" alt="Laravel Prequel" src="/vendor/prequel/favicon.png">
        </div>
        <h1>
            Welcome to Laravel Prequel!
        </h1>
        <div class="button-wrapper">
            <a :href="url.docs"
               target="_blank"
               class="bg-green-500 hover:bg-green-700">
                Docs
            </a>
            <a :href="url.bug_report"
               target="_blank"
               class="bg-red-500 hover:bg-red-700">
                Bug report
            </a>
            <a :href="url.github"
               target="_blank"
               class="bg-blue-500 hover:bg-blue-700">
                Github
            </a>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'Welcome',

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
            @apply text-gray-900;
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
