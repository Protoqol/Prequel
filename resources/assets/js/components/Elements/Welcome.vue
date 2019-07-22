<template>
    <div class="welcome">
        <div class="img-wrapper">
            <img class="no-drag" width="250" alt="Prequel" :src="$root.prequel.asset.prequel">
        </div>
        <Management/>
    </div>
</template>

<script>
  import Management from '../MainContent/ManageDatabase/Management';

  export default {
    name      : 'Welcome',
    components: {Management},
    data() {
      return {
        //
      };
    },
  };
</script>

<style scoped lang="scss">
    .welcome {
        @apply mt-2;

        .img-wrapper {
            @apply w-full;
            @apply flex;
            @apply justify-center;
            @apply items-center;
            @apply mb-4;
        }

        h1 {
            @apply text-center;
            @apply text-gray-900;
            @apply font-semibold;
            @apply text-2xl;
            @apply mt-2;
            @apply mb-4;
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
