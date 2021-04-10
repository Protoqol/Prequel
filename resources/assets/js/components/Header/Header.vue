<template>
    <div class="header-container">
        <div class="header-flexbox">
            <PrequelLogo class="header-left" :env="env"/>

            <TableFilter v-if="!error.error" class="header-middle"
                         :activeTable="activeTable"
                         :showFilter="showFilter"
                         :tableLoading="tableLoading"
                         :tableStructure="tableStructure"
                         :searchColumn="searchColumn"
                         :number-of-records="numberOfRecords"
                         :loading="loading"
                         @shouldBeLoading="$emit('shouldBeLoading', $event)"
                         @searchInTable="$emit('searchInTable', $event)"/>

            <SettingButtons v-if="!error.error" class="header-right"
                            @collapseSideBar="$emit('collapseSideBar')"
                            @enhanceReadability="$emit('enhanceReadability')"
                            @setDarkMode="changeTheme($event)"
                            @refresh="$emit('refresh')"/>
        </div>
        <span class="header-bottom"></span>
    </div>
</template>

<script>

import PrequelLogo    from "./HeaderSections/PrequelLogo";
import TableFilter    from "./HeaderSections/TableFilter";
import SettingButtons from "./HeaderSections/SettingButtons";

export default {
    name      : "Header",
    components: { SettingButtons, TableFilter, PrequelLogo },
    props     : [
        "error",
        "activeTable",
        "showFilter",
        "env",
        "loading",
        "tableLoading",
        "tableStructure",
        "searchColumn",
        "numberOfRecords",
    ],

    methods: {
        changeTheme: function (ev) {
            if (ev) {
                document.body.className += " " + "theme-dark";
            }
            else {
                document.body.classList.remove("theme-dark");
            }
        },
    },
};
</script>


<style lang="scss">
    @keyframes color-rotate {
        0% {
            @apply border-red-300;
        }
        25% {
            @apply border-indigo-500;
        }
        50% {
            @apply border-blue-700;
        }
        75% {
            @apply border-green-500;
        }
        100% {
            @apply border-indigo-300;
        }
    }

    /**
        Header - Container
    */
    .header-container {
        @apply flex;
        @apply flex-col;
        @apply justify-center;
        @apply items-center;
        @apply pt-5;
        @apply border-t-4;
        @apply border-indigo-500;
        animation : color-rotate 5s linear infinite alternate;

        .header-flexbox {
            @apply flex;
            @apply w-5/6;
            @apply pb-4;
            @apply border-b;
            border-color : var(--border-color);

            /**
                Header - Left - Logo, Connection information
            */
            .header-left {
                @apply w-1/4;
            }

            /**
                Header - Middle - Search in table inputs
            */
            .header-middle {
                @apply w-2/4;
                @apply flex;
                @apply flex-col;
                @apply justify-center;
                @apply items-center;
                margin-top : -5px;
            }

            /**
                Header - Right - Configuration buttons
             */
            .header-right {
                @apply w-1/4;
                @apply flex;
                @apply flex-row;
                @apply justify-end;
                @apply items-center;
            }
        }

        /**
            Header - Bottom - Divider
        */
        .header-bottom {
            @apply block;
            @apply mt-4;
            @apply w-5/6;
            border-bottom : 1px solid var(--header-bottom-border-color);
        }
    }

</style>
