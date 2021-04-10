<template>
    <div>
        <h1 v-if="activeTable">
                    <span v-if="!tableLoading" id="header-table-message">
                        <font-awesome-icon class="fa" icon="table"/>
                        {{ activeTable }} <small>({{ numberOfRecords }} {{trans('header.records')}})</small>
                    </span>
            <img v-else width="20" height="20" :src="$root.prequel.asset.loader" alt="Loading table data...">
        </h1>

        <label v-if="activeTable && showFilter">

            <input class="search-column-input" list="columnList" type="text" name="column" autocomplete="off"
                   :placeholder="trans('header.column')" v-model="input.column" :disabled="loading">
            <datalist id="columnList">
                <option v-for="struct in tableStructure" :value="struct.Field"></option>
            </datalist>

            <select class="search-type-input" name="queryType" v-model="input.queryType">
                <option>=</option>
                <option>!=</option>
                <option>LIKE</option>
            </select>

            <!-- @TODO Type should be based on selected column     -->
            <input class="search-value-input" name="value" :placeholder="trans('header.value')"
                   :type="'text'"
                   :disabled="loading"
                   v-model="input.value"
                   @keyup.enter="searchHandler"
                   @keyup.esc="resetInputs">

            <button class="search-get-button" :title="trans('header.buttons.get.title')" @click="searchHandler">
                {{trans('header.buttons.get.text')}}
            </button>
            <button class="search-reset-button" :title="trans('header.buttons.reset.title')"
                    @click="resetHandler">
                {{trans('header.buttons.reset.text')}}
            </button>
        </label>
    </div>
</template>

<script>
export default {
    name : "TableFilter",
    props: [
        "activeTable",
        "showFilter",
        "tableLoading",
        "loading",
        "tableStructure",
        "searchColumn",
        "numberOfRecords",
    ],

    data() {
        return {
            input: {
                availableColumns: [],
                column          : "",
                value           : "",
                queryType       : "=",
            },
        };
    },

    methods: {
        /**
       | Reset input fields
       */
        resetInputs: function() {
            this.input.column    = "";
            this.input.value     = "";
            this.input.queryType = "=";
        },

        /**
       | Reset query
       */
        resetHandler: function() {
            this.$emit("resetSearchInTable");
            this.resetInputs();
        },

        /**
       | Handle input when searching for data inside a table
       */
        searchHandler: function() {
            let columnInputEl = document.querySelector("input[name=column]");
            let valueInputEl  = document.querySelector("input[name=value]");

            if (this.input.column.length === 0) {
                columnInputEl.classList.add("border-red-500");

                setTimeout(function() {
                    columnInputEl.classList.remove("border-red-500");
                }, 750);
            }

            if (this.input.value.length === 0) {
                valueInputEl.classList.add("border-red-500");

                setTimeout(function() {
                    valueInputEl.classList.remove("border-red-500");
                }, 750);
            }

            if (this.input.value.length > 0 && this.input.column.length > 0) {
                this.$emit("shouldBeLoading");
                this.$emit("searchInTable", {
                    column   : this.input.column,
                    value    : this.input.value,
                    queryType: this.input.queryType,
                });
                return true;
            }

            return false;
        },
    },

    watch: {
        searchColumn: function(newVal) {
            this.input.column = newVal;
        },

        tableStructure: function(newVal) {
            this.input.availableColumns = newVal;
        },

        activeTable: function(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.input.column    = "";
                this.input.value     = "";
                this.input.queryType = "=";
            }
        },
    },
};
</script>

<style scoped lang="scss">
    h1 {
        @apply text-lg;
        @apply flex;
        @apply flex-row;
        @apply justify-center;
        @apply items-center;
        @apply font-semibold;

        span {
            @apply text-gray-600;
            @apply font-thin;
        }

        img {
            @apply mb-1;
        }

        .fa {
            @apply mr-1;

            &:hover {
                @apply text-gray-700;
            }
        }
    }

    label {
        @apply flex;
        @apply flex-row;

        .search-column-input {
            @apply bg-input;
            @apply shadow;
            @apply appearance-none;
            @apply border;
            @apply rounded;
            @apply w-1/3;
            @apply py-2;
            @apply px-3;
            @apply text-secondary;
            @apply leading-tight;
            border-style : var(--input-border);

            &:focus {
                @apply outline-none;
            }
        }

        .search-type-input {
            @apply m-2;
            @apply bg-transparent;
            @apply font-bold ;
            @apply text-lg;
            @apply bg-input;
            @apply text-secondary;
        }

        .search-value-input {
            @apply bg-input;
            @apply shadow;
            @apply appearance-none;
            @apply border;
            @apply rounded;
            @apply w-3/5;
            @apply py-2;
            @apply px-3 ;
            @apply text-secondary;
            @apply leading-tight;
            border-style : var(--input-border);

            &:focus {
                @apply outline-none;
            }
        }

        .search-get-button {
            background-color : var(--button-background);
            @apply mx-1;
            @apply text-white;
            @apply font-semibold;
            @apply py-1;
            @apply px-3;
            @apply rounded;
            @apply shadow;

            &:hover {
                background-color : var(--button-background-hover);
            }

            &:active {
                background-color : var(--button-background-active);
            }
        }

        .search-reset-button {
            background-color : var(--button-background-light);
            @apply text-white;
            @apply font-semibold;
            @apply py-1;
            @apply px-2;
            @apply rounded;
            @apply shadow;

            &:hover {
                background-color : var(--button-background-light-hover);
            }

            &:active {
                background-color : var(--button-background-light-active);
            }
        }
    }
</style>
