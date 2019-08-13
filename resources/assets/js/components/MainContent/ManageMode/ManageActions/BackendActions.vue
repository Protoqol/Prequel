<template>
    <div class="button-actions">
        <h2 class="text-center">Actions</h2>
        <div class="button-wrapper">
            <div class="buttons">
                <div class="action">
                    <button title="Generate new model" :disabled="tableHasModel" @click="generateModel">
                        <font-awesome-icon class="fa" icon="table"/>
                        <p>{{ tableHasModel ? 'Model exists' : 'Generate Model'}}</p>
                    </button>
                    <div class="runnable" :class="tableHasModel ? 'pill-green' : 'pill-red'">
                        <p>{{ tableHasModel ? tableHasModel : 'No existing model' }}</p>
                    </div>
                </div>
                <div class="action">
                    <button title="Generate new factory">
                        <font-awesome-icon class="fa" icon="industry"/>
                        <p>{{ tableHasFactory ? 'Factory exists' : 'Generate Factory'}}</p>
                    </button>
                    <div class="runnable" :class="tableHasFactory ? 'pill-green' : 'pill-red'">
                        <p>No existing factory</p>
                    </div>
                </div>
                <div class="action">
                    <button title="Generate new seeder" :disabled="tableHasSeeder !== false" @click="generateSeeder">
                        <font-awesome-icon class="fa" icon="seedling"/>
                        <p>{{ tableHasSeeder ? 'Seeder exists' : 'Generate Seeder'}}</p>
                    </button>
                    <button v-if="tableHasSeeder !== false" class="runnable" :disabled="tableHasSeeder === false"
                            @click="runSeeder">
                        Run seeder <label>
                        <input type="number" :disabled="tableHasSeeder === false" v-model="seederCount"
                               name="seedercount"
                               @click.stop>
                    </label> time{{seederCount > 1 ? 's' : ''}}
                    </button>
                    <div v-else class="runnable pill-red">
                        <p>No existing seeder</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mt-20 text-left" @click="logEmpty">Log</h2>
        <div id="logUtil" class="logger">
            <span v-for="log in log" v-html="log"></span>
            <span>> </span>
        </div>
    </div>
</template>

<script>
  import api from 'axios'

  export default {
    name: 'BackendActions',

    data () {
      return {
        tableHasModel  : false,
        tableHasFactory: false,
        tableHasSeeder : false,
        seederCount    : 5,
        log            : [
          '',
        ],
      }
    },

    mounted () {
      this.getInfo()

      // @TODO Find a more elegant solution to automatically scroll to bottom after a new log entry.
      let self = this
      setInterval(function () {
        self.logScrollBottom()
      }, 250)
    },

    methods: {

      /**
       * Generate a seeder
       */
      generateSeeder: async function () {
        this.clog(`Generating seeder for ${this.tableHasModel}...`)

        await api.get(`/database/seed/${this.$root.table.database}/${this.$root.table.table}/generate`).then(res => {
          if (res) {
            this.clog(`Seeder generation for ${this.$root.table.table} completed successfully`)
          }
        }).catch(err => {
          this.clog(`${err.response.data.message}`, 'error')
        }).finally(() => {
          this.getInfo()
        })
      },

      /**
       * Run the seeder
       */
      runSeeder: async function () {
        let seederCountLock = this.seederCount

        if (seederCountLock > 1) {
          this.clog(`Running seeder for ${this.$root.table.table} ${seederCountLock} times...`)
        }
        else {
          this.clog(`Running seeder for ${this.tableHasModel} ${seederCountLock} time...`)
        }

        let ranIntoError = false
        for (let i = 1; i <= seederCountLock; i++) {
          await api.get(`database/seed/${this.$root.table.database}/${this.$root.table.table}/run`).then(res => {
            if (res) {
              this.clog(`Seeding request #${i} complete`)
            }
          }).catch(err => {
            this.clog(`${err.response.data.message}`, 'error')
            ranIntoError = true
          })

          if (ranIntoError === true) {
            this.clog('Your request was halted because of the error stated above.', 'info')
            break
          }
        }
      },

      /**
       * Generate a model
       */
      generateModel: async function () {
        this.clog(`Generating model for ${this.$root.table.table}...`)

        await api.get(`/database/model/${this.$root.table.database}/${this.$root.table.table}`).then(res => {
          if (res) {
            this.clog(`Model generation for ${this.$root.table.table} completed successfully`)
          }
        }).catch(err => {
          this.clog(`${err.response.data.message}`, 'error')
        }).finally(() => {
          this.getInfo()
        })
      },

      /**
       * Get laravel specific information about table
       */
      getInfo: function () {
        api.get(`/database/info/${this.$root.table.database}/${this.$root.table.table}`).then(res => {
          this.tableHasModel   = res.data.model
          this.tableHasFactory = res.data.factory
          this.tableHasSeeder  = res.data.seeder
        }).catch(err => {
          console.error(err)
        })
      },

      /**
       * Pseudo console log
       * @param str
       * @param type
       */
      clog: function (str, type = 'neutral') {

        switch (type) {
          case 'neutral':
            this.log.push(`> ${str}<br>`)
            break
          case 'error':
            this.log.push(`><span class="text-red-400"> ERROR: ${str}<br></span>`)
            break
          case 'info':
            this.log.push(`><span class="text-orange-400"> INFO: ${str}<br></span>`)
            break
        }

        this.logScrollBottom()
      },

      /**
       * Empty the log
       */
      logEmpty: function () {
        this.log = []
      },

      /**
       * Scroll to bottom in the log
       */
      logScrollBottom: function () {
        let log       = document.getElementById('logUtil')
        log.scrollTop = log.scrollHeight
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

    h2 {
        @apply text-xl;
        @apply font-semibold;
        @apply text-gray-800;
        @apply mb-3;
    }

    .logger {
        @apply w-full;
        @apply h-48;
        @apply overflow-auto;
        @apply -mt-2;
        @apply p-2;
        @apply rounded;
        @apply bg-gray-900;
        color : #65ead2;

        &:last-child {
            &:after {
                content       : '>   ';
                height        : 20px;
                margin-bottom : -4px;
                background    : #65ead2;
                opacity       : 0;
                display       : inline-block;
                animation     : blink 2s linear infinite alternate
            }
        }

        @media (min-width : 700px) and (max-width : 1500px) {
            @apply text-sm;
        }
    }

    @keyframes blink {
        0% {
            opacity : 1;
        }
        25% {
            opacity : 0;
        }
        50% {
            opacity : 1;
        }
        75% {
            opacity : 0;
        }
        100% {
            opacity : 1;
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
                        width : 55%;
                        @apply bg-green-500;
                        @apply text-white;
                        @apply rounded-full;
                        @apply border;

                        @media (min-width : 700px) and (max-width : 1500px) {
                            @apply text-sm;
                        }
                    }

                    .pill-red {
                        width            : 55%;
                        background-color : #ec6368;
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
</style>
