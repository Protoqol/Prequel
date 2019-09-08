<template>
    <div class="sql-runner-wrapper">
        <form>
            <label v-highlightjs="query">
                <textarea ref="sql_field" class="mysql" @keydown.meta.enter="runSql" placeholder="SQL Query..."
                          v-model="query"></textarea>
            </label>
            <div class="buttons">
                <button @click.prevent="runSql">RUN SQL</button>
                <button @click.prevent="runSql">LAST QUERY</button>
                <button @click.prevent="runSql">EMPTY FIELD</button>
            </div>
        </form>
        <div v-for="res in data">
            <Table v-if="res && res.length !== 0" :data="res.data" :structure="res.columns"
                   :readability="$root.view.readability"></Table>
        </div>
    </div>
</template>

<script>
  import Table from '../../BrowseMode/Table/Table'
  import api   from 'axios'

  export default {
    name      : 'RunSQL',
    components: { Table },
    data () {
      return {
        'query': '',
        'data' : [],
      }
    },

    methods: {
      runSql: function () {
        if (!this.query) {
          let self = this

          this.$refs.sql_field.style = 'background: #ec6368; color: white;'
          setTimeout(function () {
            self.$refs.sql_field.style = ''
          }, 2500)
          return false
        }

        let obj = {
          query: this.query,
        }

        api.post(`/database/sql/${this.$root.table.database}/${this.$root.table.table}/run`, obj).then(res => {
          this.data = res.data
          console.log(res)
        }).catch(err => {
          console.log(err)
        })
      },
    },
  }
</script>

<style scoped lang="scss">
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
        @apply border-b-4;
        @apply border-indigo-700;

        transition       : all .2s;

        &:hover {
            transition       : all .2s;
            background-color : var(--button-background-hover);
        }

        &:active {
            transition       : all .2s;
            background-color : var(--button-background-active);
            @apply border-transparent;
            @apply shadow-none;
        }

        &:disabled, &[disabled] {
            @apply bg-gray-400;
            @apply shadow-none;
            @apply cursor-default;
            @apply border-b-4;
            @apply border-gray-400;
        }

        @media (min-width : 700px) and (max-width : 1500px) {
            @apply text-sm;
        }
    }

    .sql-runner-wrapper {
        @apply flex;
        @apply justify-center;
        @apply w-full;


        form {
            @apply w-full;

            .buttons {
                @apply w-full;
                @apply flex;
                @apply flex-row;

                button {
                    @apply px-4;
                }
            }

            label {
                @apply w-full;

                textarea {
                    font-family : "Fira Code Retina", Ubuntu, monospace;
                    resize      : none;
                    @apply w-3/4;
                    @apply h-24;
                    @apply text-left;
                    @apply bg-gray-300;
                    @apply block;
                    @apply tracking-wide;
                    @apply text-gray-700;
                    @apply rounded;
                    @apply m-2;
                    @apply p-2;
                }
            }
        }
    }


</style>
