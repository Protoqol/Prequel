<!-- @WIP -->

<template>
    <div class="new-row-tab-wrapper">
        <form class="new-row-form" @submit.prevent="saveRow($event)">
            <h2>Creating row in '{{database}}.{{table}}'</h2>
            <label v-for="struct in structure">
                <h1>{{ enhanceReadability(struct.Field) }}</h1> <small>{{struct.Type}}</small>
                <input step=”any”
                       :type="resolveType(struct)"
                       :name="struct.Field"
                       :required="struct.Null !== 'YES'"
                       :maxlength="resolveMaxLength(struct.Type)"
                       :placeholder="struct.Extra || struct.Field"/>
            </label>
            <div class="buttons">
                <!--@TODO Support multiple forms-->
                <!--<button class="new" @click.prevent="insertNewRow">
                    <font-awesome-icon class="mr-1" icon="plus"/>
                    Insert another row
                </button>-->
                <button class="new" title="Insert fake data">
                    <font-awesome-icon class="mr-1" icon="birthday-cake"/>
                    <p>Fake data</p>
                </button>
                <button class="create" type="submit">
                    <font-awesome-icon class="mr-1" icon="save"/>
                    Save row
                </button>
            </div>
        </form>
        <BackendActions :tableHasModel="tableHasModel"/>
    </div>
</template>

<script>
  import api            from 'axios'
  import BackendActions from './BackendActions'

  export default {
    name      : 'CreateRow',
    components: { BackendActions },
    props     : ['structure'],

    data () {
      return {
        database     : '',
        table        : '',
        default      : {
          id       : 1,
          timestamp: '',
        },
        tableHasModel: false,
      }
    },

    mounted () {
      let url       = new URLSearchParams(window.location.search)
      this.database = url.get('database')
      this.table    = url.get('table')
    },

    updated () {
      let url       = new URLSearchParams(window.location.search)
      this.database = url.get('database')
      this.table    = url.get('table')
      this.getDefaults()
    },

    methods: {

      /**
       | Save form in current database table
       */
      saveRow: function (form) {
        let data = {}

        // Build data object containing correct key => value scheme
        for (let input of form.target) {
          if (input.type !== 'submit') {
            data[input.name] = input.value
          }
        }

        api.post(`/database/insert/${this.database}/${this.table}`, { data: data }).
          then(res => {
            if (!res.data.success) {
              throw new Error('Could not insert this data')
            }

            form.target.reset()

            PrequelSuccessToast.fire({
              text: `Inserted row into ${this.table}`,
            }).finally(() => {
              this.$forceUpdate()
            })
          }).
          catch(err => {
            PrequelErrorToast.fire({
              text: err,
            })
          })
      },

      /**
       | Set retrieved defaults in form
       */
      setDefaults: function () {
        document.querySelectorAll('.new-row-form input').forEach((inputEl) => {
          if (inputEl.type === 'datetime-local') {
            inputEl.value = this.default.timestamp
          }

          if (inputEl.name === 'id' || inputEl.placeholder.includes('auto_increment')) {
            inputEl.value = this.default.id
          }
        })
      },

      /**
       | Get defaults for table
       */
      getDefaults: function () {
        this.default.id        = 1
        this.default.timestamp = ''

        api.get(`/database/defaults/${this.database}/${this.table}`).then(res => {
          this.default.id        = parseInt(res.data.id)
          this.default.timestamp = res.data.current_date + ''
          this.tableHasModel     = res.data.tableHasModel
        }).catch(err => {
          console.error(err)
        }).finally(() => {
          this.setDefaults()
        })
      },

      /**
       | Add a new form to save multiple rows/forms at once
       */
      insertNewRow: function () {
        // @TODO Duplicate form
      },

      /**
       | Translate column type to a HTML input type
       */
      resolveType: function ({ Field, Type }) {
        let type         = Type + ''
        let resolvedType = ''

        // Numeric types
        if (type.includes('int')
            || type.includes('bit')
            || type.includes('decimal')
            || type.includes('numeric')
            || type.includes('float')
            || type.includes('real')) {
          resolvedType = 'number'
        }

        // Textual types
        if (type.includes('char') || type.includes('text') || type.includes('string')) {
          resolvedType = 'text'
        }

        // Date(time) types
        if (type.includes('date') || type.includes('time') || type.includes('year')) {
          resolvedType = 'datetime-local'
        }

        // Email type
        if (Field === 'email') {
          resolvedType = 'email'
        }

        return resolvedType
      },

      /**
       | Get max length from column type
       */
      resolveMaxLength: function (type) {

        return type.substring(
          type.lastIndexOf('(') + 1,
          type.lastIndexOf(')'),
        )
      },

      /**
       | Enhance readability for column names.
       |
       | @param str
       | @returns {string}
       */
      enhanceReadability: function (str) {
        if (!this.$root.view.readability) {
          return str
        }

        return prettifyName(str)
      },
    },
  }
</script>

<style scoped lang="scss">
    .new-row-tab-wrapper {
        @apply flex;

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

        h2 {
            @apply text-xl;
            @apply font-semibold;
            @apply text-gray-800;
            @apply mb-3;
            @apply text-center;
        }

        .new-row-form {
            @apply bg-gray-200;
            @apply rounded;
            @apply w-3/5;
            @apply p-5;
            @apply m-2;

            label {
                @apply flex;
                @apply items-center;
                @apply justify-between;
                @apply font-semibold;
                @apply text-gray-700;
                @apply mb-2;

                h1 {
                    @apply w-1/4;

                    @media (min-width : 700px) and (max-width : 1500px) {
                        @apply text-sm;
                    }
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
                    @apply ml-3;
                }

                .new {
                    @apply w-1/2;
                }
            }
        }

        .button-actions {
            @apply bg-gray-200;
            @apply rounded;
            @apply w-2/5;
            @apply p-5;
            @apply m-2;
            @apply flex;
            @apply flex-col;

            .button-wrapper {
                @apply flex;
                @apply flex-row;
                @apply w-full;

                .buttons {
                    height : fit-content;
                    @apply w-full;
                    @apply flex;
                    @apply flex-col;
                    @apply justify-center;
                    @apply items-center;

                    .action {
                        @apply w-full;
                        @apply flex;
                        @apply flex-row;
                        @apply justify-between;
                        @apply items-center;
                        @apply mt-4;

                        .runnable, h3 {
                            margin-top : 0 !important;
                            width      : 55%;
                            @apply rounded-full;
                            @apply m-auto;
                            @apply p-1;
                            @apply mt-4;
                            @apply text-center;

                            input {
                                @apply w-10;
                                @apply px-1;
                                @apply mx-2;
                                @apply text-center;
                                @apply rounded;
                                @apply bg-indigo-300;
                            }
                        }

                        button {
                            @apply mt-0;
                            @apply flex;
                            @apply flex-row;
                            @apply w-2/5;
                            @apply px-2;
                            @apply ml-0;

                            .fa {
                                @apply w-1/4;
                            }

                            p {
                                @apply text-left;
                                @apply w-3/4;
                            }
                        }

                        .pill-green {
                            width            : 55%;
                            background-color : #65ead2;
                            @apply text-white;
                            @apply rounded-full;
                            @apply border;

                            @media (min-width : 700px) and (max-width : 1500px) {
                                @apply text-sm;
                            }
                        }

                        .pill-red {
                            width            : 55%;
                            background-color : #eaa165;
                            @apply text-white;
                            @apply rounded-full;
                            @apply border;

                            @media (min-width : 700px) and (max-width : 1500px) {
                                @apply text-sm;
                            }
                        }
                    }
                }
            }
        }
    }


</style>
