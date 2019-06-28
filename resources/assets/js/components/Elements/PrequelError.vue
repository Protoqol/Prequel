<template>
    <!--    @TODO Better error resolving/suggestions -->
    <div class="prequel-error">
        <h1>
            Oops... {{ errorDetailed.detailed }}
        </h1>

        <!--   This if condition is horrible, I know that @TODO     -->
        <div v-if="errorDetailed.detailed !== 'Prequel has been disabled.'">
            <h3>
                Tried connecting through
            </h3>
            <code class="code-block">
                {{env.connection}}://{{env.user}}@{{env.host}}:{{env.port}}/{{env.database}}
                <br>
                <span>connection://user@host:port/database</span>
                <br><br>
                <div class="suggestions">
                    <h4>
                        {{errorSuggestion().length}} suggestion(s) found
                    </h4>
                    <code v-for="error in errorSuggestion()">
                        - {{error}}
                    </code>
                </div>
            </code>
        </div>
    </div>
</template>

<script>
  export default {
    name   : 'PrequelError',
    props  : ['errorDetailed', 'env'],
    data() {
      return {
        standards: {
          port: 3306,
        },
      };
    },
    methods: {
      errorSuggestion: function() {
        let suggestionCollection = [];
        let userPort             = parseInt(this.$props.env.port);

        if (userPort !== this.standards.port) {
          suggestionCollection.push(
              `You're using an irregular port number, usually the port is 3306 (Yours is: ${userPort})`);
        }

        if (suggestionCollection.length === 0) {
          suggestionCollection.push('Prequel could not suggest any fixes!');
        }

        return suggestionCollection;
      },
    },
  };
</script>

<style lang="scss">
    .prequel-error {
        h1 {
            @apply mt-10;
            @apply text-3xl;
            @apply text-center;
            @apply text-red-500;
        }

        h3 {
            @apply text-center;
            @apply text-lg;
            @apply text-gray-900;
        }

        .code-block {
            @apply block;
            @apply w-full;
            @apply text-gray-800;
            @apply text-center;

            span {
                @apply text-gray-700;
                @apply text-sm;
            }

            .suggestions {
                @apply bg-white;
                @apply rounded;
                @apply p-2;
                @apply mt-2;

                h4 {
                    @apply text-center;
                    @apply uppercase;
                    @apply text-lg;
                    @apply text-gray-900;
                }
            }
        }
    }
</style>
