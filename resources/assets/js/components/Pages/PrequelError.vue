<template>
    <!--    @TODO Better error resolving/suggestions -->
    <div class="prequel-error">
        <h1>
            <font-awesome-icon icon="exclamation-triangle"></font-awesome-icon>
            {{ trans('error_page.oops') }}
        </h1>
        <h2>
            {{ errorDetailed.detailed }}
        </h2>
        <hr>
        <!--   This if condition is horrible, I know that @TODO     -->
        <div v-if="errorDetailed.detailed !== trans('error_page.disabled')">
            <h3>
                {{trans('error_page.tried_connecting')}}
            </h3>
            <code class="code-block">
                {{env.connection}}://{{env.user}}@{{env.host}}:{{env.port}}/{{env.database}}
                <br>
                <span>{{trans('error_page.example_connection')}}</span>
                <br><br>
                <div class="suggestions">
                    <h4>
                        {{errorSuggestion().length}} suggestion(s) found
                    </h4>
                    <code v-for="error in errorSuggestion()">
                        - {{error}}
                        <br>
                    </code>
                </div>
            </code>
        </div>
    </div>
</template>

<script>
export default {
    name   : "PrequelError",
    props  : ["errorDetailed", "env"],
    data() {
        return {
            standards: {
                port                    : 3306,
                supportedConnectionTypes: ["mysql", "pgsql"],
            },
            prequel: {
                lang: window.Prequel.i18n
            }
        };
    },
    methods: {
        errorSuggestion: function() {
            let suggestionCollection = [];
            let userPort             = parseInt(this.$props.env.port);
            let connection           = this.$props.env.connection;

            let supportedConnectionTypeLength = this.standards.supportedConnectionTypes.length;
            let connectionErrorCounter = false;

            // @TODO More suggestions
            if (userPort !== this.standards.port && connection === "mysql") {
                suggestionCollection.push(
                    `You're using an irregular port number, usually the port is 3306. (Yours is: ${userPort})`);
            }

            for (let i = 0; i < supportedConnectionTypeLength; i++) {
                if (this.standards.supportedConnectionTypes[i] !== connection) {
                    connectionErrorCounter++;
                }

                if(i === supportedConnectionTypeLength - 1 && connectionErrorCounter === supportedConnectionTypeLength){
                    suggestionCollection.push(
                        `Your database connection might not be supported yet, currently supported: ${this.standards.supportedConnectionTypes.map(type => `'${type}'`).join(", ")}. (Yours is: '${connection}').`);
                }
            }

            if (suggestionCollection.length === 0) {
                suggestionCollection.push("Prequel could not suggest any fixes.");
            }

            return suggestionCollection;
        },
    },
};
</script>

<style lang="scss">
    .prequel-error {
        h1 {
            @apply my-2;
            @apply text-5xl;
            @apply text-center;
            @apply text-red-500;
        }

        h2 {
            @apply mb-3;
            @apply text-3xl;
            @apply text-center;
            @apply text-red-500;
        }

        hr {
            @apply border;
            @apply border-gray-300;
            @apply w-2/5;
        }

        h3 {
            @apply text-center;
            @apply text-lg;
            @apply text-gray-900;
        }

        .code-block {
            @apply block;
            margin: 0 auto;
            @apply w-3/4;
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
