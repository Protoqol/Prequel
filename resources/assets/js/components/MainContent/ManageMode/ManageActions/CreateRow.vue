<template>
    <form>
        <h2>Creating row in '{{database}}.{{table}}'</h2>
        <label v-for="struct in structure">
            <h1>{{ struct.Field }}</h1> <small>{{struct.Type}}</small>
            <input :type="resolveType(struct.Type)"
                   :name="struct.Field"
                   :required="struct.Null !== 'YES'"
                   :maxlength="resolveMaxLength(struct.Type)"
                   :placeholder="struct.Extra || struct.Field"/>
        </label>
        <div class="buttons">
            <button class="create">
                <font-awesome-icon class="mr-1" icon="arrow-alt-circle-up"/>
                Create row
            </button>
            <button class="new">
                <font-awesome-icon class="mr-1" icon="plus"/>
                Insert another row
            </button>
        </div>
    </form>
</template>

<script>
  export default {
    name : 'CreateRow',
    props: ['structure'],
    data() {
      return {
        database: '',
        table   : '',
      };
    },

    updated() {
      let url       = new URLSearchParams(window.location.search);
      this.database = url.get('database');
      this.table    = url.get('table');
    },

    methods: {
      resolveType: function(type) {
        type             = type + '';
        let resolvedType = '';

        // Numeric types
        if (type.includes('int')
            || type.includes('bit')
            || type.includes('decimal')
            || type.includes('numeric')
            || type.includes('float')
            || type.includes('real')) {
          resolvedType = 'number';
        }

        // Textual types
        if (type.includes('char') || type.includes('text') || type.includes('string')) {
          resolvedType = 'text';
        }

        // Date(time) types
        if (type.includes('date') || type.includes('time') || type.includes('year')) {
          resolvedType = 'date';
        }

        return resolvedType;
      },

      resolveMaxLength: function(type) {

        return type.substring(
            type.lastIndexOf('(') + 1,
            type.lastIndexOf(')'),
        );
      },
    },
  };
</script>


<style scoped lang="scss">
    form {
        @apply bg-gray-200;
        @apply rounded;
        @apply w-3/5;
        @apply p-5;
        @apply m-2;

        h2 {
            @apply text-xl;
            @apply font-semibold;
            @apply text-gray-800;
            @apply mb-3;
            @apply text-center;
        }

        label {
            @apply flex;
            @apply items-center;
            @apply justify-between;
            @apply uppercase;
            @apply font-semibold;
            @apply text-gray-700;
            @apply mb-2;

            h1 {
                @apply w-1/4;
            }

            small {
                @apply font-thin;
                @apply lowercase;
                @apply ml-2;
                @apply w-1/4;
            }

            input {
                @apply w-1/2;
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
        }

        .buttons {
            @apply flex;

            .create {
                @apply w-1/2;
            }

            .new {
                @apply w-1/3;
            }

            button {
                @apply m-auto;
                @apply py-1;
                @apply mt-4;
                @apply flex;
                @apply justify-center;
                background-color : var(--button-background);
                @apply text-white;
                @apply items-center;
                @apply rounded;
                @apply shadow;

                &:hover {
                    background-color : var(--button-background-hover);
                }

                &:active {
                    background-color : var(--button-background-active);
                    @apply shadow-none;
                }

                &:disabled, &[disabled] {
                    background-color : var(--button-background-hover);
                    @apply shadow-none;
                    @apply cursor-default;

                    &:hover {
                        background-color : var(--button-background-hover);
                    }
                }
            }
        }
    }


</style>
