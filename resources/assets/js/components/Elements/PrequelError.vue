<template>
    <!--    @TODO Better error resolving/suggestions -->
    <div>
        <h1 class="mt-10 text-center text-3xl text-bold text-red-500">
            Oops... {{ errorDetailed.detailed }}
        </h1>

        <!--   This if condition is horrible, I know that @TODO     -->
        <div v-if="errorDetailed.detailed !== 'Prequel has been disabled.'">
            <h3 class="text-center text-lg text-normal text-gray-900">
                Tried connecting through
            </h3>
            <code class="block w-full text-gray-800 text-center">
                {{env.connection}}://{{env.user}}@{{env.host}}:{{env.port}}/{{env.database}}
                <br><br>
                <h4 class="text-center uppercase text-lg text-normal text-gray-900">
                    {{errorSuggestion().length}} suggestion(s) found
                </h4>
                <code v-for="error in errorSuggestion(env)">
                    - {{error}}
                </code>
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
      errorSuggestion: function(env) {
        let suggestionCollection = [],
            userPort             = parseInt(env.port);

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

<style scoped>

</style>
