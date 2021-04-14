<template>
    <div class="button-actions">
        <h2 class="text-center">Actions</h2>
        <div class="button-wrapper">
            <div class="buttons">
                <div class="action">
                    <button title="Generate new model" :disabled="tableHasModel !== false" @click="generate('model')">
                        <font-awesome-icon class="fa" icon="table"/>
                        <span>{{ tableHasModel ? 'Model exists' : 'Generate Model'}}</span>
                    </button>
                    <div class="runnable ellipseLeft" :class="tableHasModel ? 'pill-green' : 'pill-red'">
                        <span>{{ tableHasModel ? tableHasModel : 'No existing model' }}</span>
                    </div>
                </div>
                <div class="action">
                    <button title="Generate Controller" :disabled="tableHasController !== false"
                            @click="generate('controller')">
                        <font-awesome-icon class="fa" icon="hat-wizard"/>
                        <span>{{ tableHasController ? 'Controller exists' : 'Generate Controller'}}</span>
                    </button>
                    <div class="runnable ellipseLeft" :class="tableHasController ? 'pill-green' : 'pill-red'">
                        {{ tableHasController ? tableHasController : 'No existing controller' }}
                    </div>
                </div>
                <div class="action">
                    <button title="Generate Resource" :disabled="tableHasResource !== false"
                            @click="generate('resource')">
                        <font-awesome-icon class="fa" icon="stream"/>
                        <span>{{ tableHasResource ? 'Resource exists' : 'Generate Resource'}}</span>
                    </button>
                    <div class="runnable ellipseLeft" :class="tableHasResource ? 'pill-green' : 'pill-red'">
                        {{ tableHasResource ? tableHasResource : 'No existing resource' }}
                    </div>
                </div>
                <div class="action">
                    <button title="Generate new factory" :disabled="tableHasFactory" @click="generate('factory')">
                        <font-awesome-icon class="fa" icon="industry"/>
                        <span>{{ tableHasFactory ? 'Factory exists' : 'Generate Factory'}}</span>
                    </button>
                    <div class="runnable ellipseLeft" :class="tableHasFactory ? 'pill-green' : 'pill-red'">
                        {{ tableHasFactory ? tableHasFactory : 'No existing factory' }}
                    </div>
                </div>
                <div class="action">
                    <button title="Generate new seeder" :disabled="tableHasSeeder !== false"
                            @click="generate('seeder')">
                        <font-awesome-icon class="fa" icon="seedling"/>
                        <span>{{ tableHasSeeder ? 'Seeder exists' : 'Generate Seeder'}}</span>
                    </button>
                    <button v-if="tableHasSeeder !== false" class="runnable" :disabled="tableHasSeeder === false"
                            @click="runSeeder">
                        Run seeder <label>
                        <input name="seedercount" type="number" min="1"
                               :disabled="tableHasSeeder === false"
                               v-model="seederCount"
                               @click.stop>
                    </label> time{{seederCount > 1 ? 's' : ''}}
                    </button>
                    <div v-else class="runnable pill-red">
                        {{ tableHasSeeder ? tableHasSeeder : 'No existing seeder' }}
                    </div>
                </div>
            </div>
        </div>

        <div id="logUtil" class="logger">
            <span v-for="log in log" v-html="log"></span>
            <span>> {{ inAction ? 'Working...' : '' }} </span>
        </div>
    </div>
</template>

<script>
import api from "axios";

export default {
    name: "BackendActions",

    data () {
        return {
            tableHasModel     : false,
            tableHasFactory   : false,
            tableHasSeeder    : false,
            tableHasResource  : false,
            tableHasController: false,
            inAction          : false,
            seederCount       : 5,
            log               : [
                "",
            ],
        };
    },

    mounted () {
        this.getInfo();

        // @TODO Find a more elegant solution to automatically scroll to bottom after a new log entry.
        let self = this;
        setInterval(function () {
            self.logScrollBottom();
        }, 250);
    },

    methods: {

        /**
       * Generate `generator` ex. 'model', 'controller', 'resource' etc.
       */
        generate: async function (generator) {
            this.conslog(`Generating ${generator} for ${this.$root.table.table}...`, "start");
            this.inAction = true;

            await api.get(`/database/${generator}/${this.$root.table.database}/${this.$root.table.table}/generate`).
                then(res => {
                    if (res) {
                        this.conslog(`${capitalise(generator)} generation for ${this.$root.table.table} completed successfully`);
                    }
                }).
                catch(err => {
                    this.conslog(`${err.response.data.message}`, "error");
                }).
                finally(() => {
                    this.conslog(`Getting updated data for ${this.$root.table.database}.${this.$root.table.table}...`, "info");
                    this.inAction = true;
                    this.getInfo();
                });
        },

        /**
       * Run the seeder
       */
        runSeeder: async function () {
        // Prevent user from adding additional seeder while in runtime
            let seederCountLock = this.seederCount;

            this.conslog(
                `Running seeder for ${this.$root.table.table} ${seederCountLock} time${seederCountLock > 1 ? "s" : ""}...`,
                "start");

            this.inAction = true;

            let ranIntoError = false;
            for (let i = 1; i <= seederCountLock; i++) {
                await api.get(`database/seeder/${this.$root.table.database}/${this.$root.table.table}/run`).then(res => {
                    if (res) {
                        this.conslog(`Seeding request #${i} complete`);

                        if (i === seederCountLock) {
                            this.conslog("Seeding completed", "info");
                        }
                    }
                }).catch(err => {
                    this.conslog(`${err.response.data.message}`, "error");
                    ranIntoError = true;
                });

                if (ranIntoError === true) {
                    this.conslog("Your request was halted because of the error stated above.", "info");
                    this.inAction = false;
                    break;
                }
            }

            this.conslog(`Getting updated data for ${this.$root.table.database}.${this.$root.table.table}...`, "info");
            this.getInfo();
        },

        /**
       * Get laravel specific information about table
       */
        getInfo: function () {
            api.get(`/database/info/${this.$root.table.database}/${this.$root.table.table}`).then(res => {
                this.tableHasModel      = res.data.model;
                this.tableHasFactory    = res.data.factory;
                this.tableHasSeeder     = res.data.seeder;
                this.tableHasController = res.data.controller;
                this.tableHasResource   = res.data.resource;
            }).catch(err => {
                console.error(err);
            }).finally(() => {
                this.inAction = false;
            });
        },

        /**
       * Pseudo console log
       * @param str
       * @param type
       */
        conslog: function (str, type = "neutral") {

            switch (type) {
            case "neutral":
                this.log.push(`> ${str}<br>`);
                break;
            case "error":
                this.log.push(`><span class="monospaced text-red-400"> ERROR: ${str}<br></span>`);
                break;
            case "info":
                this.log.push(`><span class="monospaced text-orange-400"> INFO: ${str}<br></span>`);
                break;
            case "start":
                this.log.push(`><span class="monospaced text-green-400"> START: ${str}<br></span>`);
                break;
            }

            this.logScrollBottom();
        },

        /**
       * Empty the log
       */
        logEmpty: function () {
            this.log = [];
        },

        /**
       * Scroll to bottom in the log
       */
        logScrollBottom: function () {
            let log = document.getElementById("logUtil");
            if (log) {
                log.scrollTop = log.scrollHeight;
            }
        },
    },
};
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
    }

    .ellipseLeft {
        white-space   : nowrap;
        overflow      : hidden;
        text-overflow : ellipsis;
        direction     : rtl;
    }

    .logger {
        @apply mt-4;
        @apply w-full;
        @apply h-48;
        @apply overflow-auto;
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
        background-color : var(--manage-navbar-bg);
        color            : var(--text-secondary-color);
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
                    @apply mt-3;

                    .runnable, h3 {
                        margin-top : 0 !important;
                        width      : 47%;
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
                        width : 50%;
                        @apply mt-0;
                        @apply flex;
                        @apply flex-row;
                        @apply px-2;
                        @apply ml-0;

                        .fa {
                            @apply w-1/4;
                        }

                        span {
                            @apply text-left;
                            @apply w-3/4;
                        }
                    }

                    .pill-green {
                        width : 47%;
                        @apply bg-green-500;
                        @apply text-white;
                        @apply rounded;
                        @apply border;

                        @media (min-width : 700px) and (max-width : 1500px) {
                            @apply text-sm;
                        }
                    }

                    .pill-red {
                        width            : 47%;
                        background-color : #ec6368;
                        @apply text-white;
                        @apply rounded;
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
