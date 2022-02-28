<!-- @WIP -->

<template>
    <div class="new-row-tab-wrapper">
        <div class="action-wrapper">
            <ActionInfo class="w-3/5" title="Insert new row"
                        description="Fill in your data and create a new row"></ActionInfo>
            <ActionInfo class="w-2/5" title="Laravel Actions" description="Generate everything!"></ActionInfo>
        </div>
        <div class="action-wrapper">
            <form class="new-row-form" @submit.prevent="saveRow($event)">
                <h2>Creating row in '{{database}}.{{table}}'</h2>
                <label v-for="struct in structure">
                    <span>{{ enhanceReadability(struct.Field) }}</span> <small>{{struct.Type}}</small>
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
                    <!-- @TODO Insert fake data -->
                    <!-- <button class="new" title="Insert fake data">
                              <font-awesome-icon class="mr-1" icon="birthday-cake"/>
                              <p>Fake data</p>
                        </button>-->
                    <button class="create" type="submit">
                        <font-awesome-icon class="mr-1" icon="save"/>
                        Save row
                    </button>
                </div>
            </form>
            <BackendActions ref="actions"/>
        </div>
    </div>
</template>

<script>
import api            from "axios";
import BackendActions from "./BackendActions";
import ActionInfo     from "./ActionInfo";

export default {
    name      : "CreateRow",
    components: { BackendActions, ActionInfo },
    props     : ["structure"],

    data () {
        return {
            database     : "",
            table        : "",
            requestHasRun: false,
            default      : {
                id       : 1,
                timestamp: "",
            },
        };
    },

    mounted () {
        this.getUrl();
    },

    updated () {
        this.getUrl();
    },

    methods: {

        getUrl: async function () {
            if (this.database !== this.$root.table.database || this.$root.table.table) {
                this.database = this.$root.table.database;
                this.table    = this.$root.table.table;

                await this.getDefaults();
                await this.$refs.actions.getInfo();
            }
        },

        /**
       | Save form in current database table
       */
        saveRow: function (form) {
            let data = {};

            // Build data object containing correct key => value scheme
            for (let input of form.target) {
                if (input.type !== "submit") {
                    data[input.name] = input.value;
                }
            }

            api.post(`/database/insert/${this.database}/${this.table}`, { data: data }).
                then(res => {
                    if (!res.data.success || res.data.success === "") {
                        throw new Error("Could not insert this data");
                    }

                    form.target.reset();

                    PrequelSuccessToast.fire({
                        text: `Inserted row into ${this.table}`,
                    }).finally(() => {
                        this.$refs.actions.conslog(`SUCCESS: Inserted row into ${this.table}`);
                        this.$forceUpdate();
                    });

                }).
                catch(err => {
                    this.$refs.actions.conslog(err.response.data.message, "error");
                    PrequelErrorToast.fire({
                        text: err.response.data.exception,
                    });
                });
        },

        /**
       | Set retrieved defaults in form
       */
        setDefaults: function () {
            document.querySelectorAll(".new-row-form input").forEach((inputEl) => {
                if (inputEl.type === "datetime-local") {
                    inputEl.value = this.default.timestamp;
                }

                if (inputEl.name === "id" || inputEl.placeholder.includes("auto_increment")) {
                    inputEl.value = this.default.id;
                }
            });
        },

        /**
       | Get defaults for table
       */
        getDefaults: function () {
        // Reset
            this.default.id        = 1;
            this.default.timestamp = "";

            api.get(`/database/defaults/${this.database}/${this.table}`).then(res => {
                this.default.id        = parseInt(res.data.id);
                this.default.timestamp = res.data.current_date + "";
            }).catch(err => {
                console.error(err);
            }).finally(() => {
                this.setDefaults();
            });
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
            let type         = Type + "";
            let resolvedType = "";

            // Numeric types
            if (type.includes("int")
            || type.includes("bit")
            || type.includes("decimal")
            || type.includes("numeric")
            || type.includes("float")
            || type.includes("real")) {
                resolvedType = "number";
            }

            // Textual types
            if (type.includes("char") || type.includes("text") || type.includes("string")) {
                resolvedType = "text";
            }

            // Date(time) types
            if (type.includes("date") || type.includes("time") || type.includes("year")) {
                resolvedType = "datetime-local";
            }

            // Email type
            if (Field === "email") {
                resolvedType = "email";
            }

            return resolvedType;
        },

        /**
       | Get max length from column type
       */
        resolveMaxLength: function (type) {

            return type.substring(
                type.lastIndexOf("(") + 1,
                type.lastIndexOf(")"),
            );
        },

        /**
       | Enhance readability for column names.
       |
       | @param str
       | @returns {string}
       */
        enhanceReadability: function (str) {
            if (!this.$root.view.readability) {
                return str;
            }

            return prettifyName(str);
        },
    },
};
</script>

<style scoped lang="scss">
    .new-row-tab-wrapper {
        @apply flex;
        @apply flex-col;

        .action-wrapper {
            @apply flex;
            @apply flex-row;

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
                color : var(--text-secondary-color);
                @apply text-xl;
                @apply font-semibold;
                @apply mb-3;
                @apply text-center;
            }

            .new-row-form {
                background-color : var(--manage-navbar-bg);
                @apply rounded;
                @apply w-3/5;
                @apply p-5;
                @apply m-2;

                label {
                    @apply flex;
                    @apply items-center;
                    @apply justify-between;
                    @apply font-semibold;
                    color : var(--text-secondary-color);
                    @apply mb-2;

                    span {
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
                        @apply bg-gray-200;
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
                    }

                    .new {
                        @apply w-1/2;
                    }
                }
            }
        }
    }


</style>
