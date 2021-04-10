<!-- NOTE This is the root Prequel Vue instance -->

<template>
    <!--
        Order of element attributes:
             1. Vue operators
             2. Native attributes (id, class etc.)
             3. Vue bindings
             4. Vue events
             5. Vue loops
    -->
    <div v-cloak>
        <SwitchMode :modus="view.modus.mode" @switchMode="switchMode($event)"/>
        <Version/>

        <Header :error="prequel.errorDetailed"
                :activeTable="table.currentActiveName"
                :showFilter="view.modus.mode !== view.modus.enum.MANAGE"
                :tableStructure="table.structure"
                :env="prequel.env"
                :loading="table.loading"
                :tableLoading="table.tableLoading"
                :searchColumn="table.search.column"
                :numberOfRecords="table.numberOfRecords"
                @searchInTable="searchInTable($event)"
                @resetSearchInTable="checkUrlParameters"
                @shouldBeLoading="table.loading = true"
                @enhanceReadability="readabilityEnhancer"
                @collapseSideBar="sideBarCollapseHandler"
                @refresh="getTableData(`${table.database}.${table.table}`, false, true)"/>

        <Paginator
                v-if="table.currentActiveName.length !== 0 && !prequel.error && view.modus.mode === view.modus.enum.BROWSE"
                :currentPage="table.pagination.currentPage"
                :numberOfPages="table.pagination.numberOfPages"
                @pageChange="changePage($event)"/>

        <div v-else class="block w-1 h-1 my-2"></div>

        <div v-if="!prequel.error" class="main-content">
            <div class="wrapper">
                <transition name="slide-fade" mode="in-out">
                    <SideBar v-if="!view.collapsed"
                             :class="view.collapsed ? 'hidden' : 'w-1/5'"
                             :readability="view.readability"
                             :table-data="prequel.data"
                             :table-flat="prequel.flat"
                             @searchingForTable="searchForTable($event)"
                             @tableSelect="getTableData($event)"/>
                </transition>

                <MainContent class="table-wrapper"
                             :class="view.collapsed ? 'main-content-collapsed' : 'main-content-expanded'"
                             :mode="view.modus.mode"
                             :readability="view.readability"
                             :loading="table.loading"
                             :welcome-shown="view.welcomeShown"
                             :table-load-error="table.error.loadError"
                             :table-error-detailed="table.error.loadErrorMessage"
                             :data="table.data"
                             :structure="table.structure"
                             @columnSelect="columnSelect($event)"/>
            </div>
        </div>

        <PrequelError v-if="prequel.error" :error-detailed="prequel.errorDetailed" :env="prequel.env"/>
    </div>
</template>

<script>
import axios        from "axios";
import Header       from "../Header/Header";
import SideBar      from "../SideBar/SideBarWrapper";
import MainContent  from "../MainContent/ContentWrapper";
import PrequelError from "./PrequelError";
import Paginator    from "../MainContent/BrowseMode/Table/Paginator";
import SwitchMode   from "../Elements/SwitchMode";
import Version      from "../Elements/Version";

export default {
    name      : "Prequel",
    components: {
        Version,
        SwitchMode,
        Paginator,
        PrequelError,
        MainContent,
        SideBar,
        Header,
    },

    data () {
        return {

            /**
         |---------------------------------------------
         | Holds data that comes directly from the back-end.
         |---------------------------------------------
         */
            prequel: {
                error        : window.Prequel.error.error, // Object
                errorDetailed: window.Prequel.error,       // String
                data         : window.Prequel.data,        // Object
                env          : window.Prequel.env,         // Object
                flat         : window.Prequel.flat,        // Array
                lang         : window.Prequel.i18n,        // Object
                api          : {
                    database: "",
                },
                asset        : {
                    logo   : "/vendor/prequel/favicon.png",
                    prequel: "/vendor/prequel/prequel_v1.png",
                    loader : "/vendor/prequel/loader.gif",
                },
            },

            /**
         |---------------------------------------------
         | Holds data about current table.
         |---------------------------------------------
         */
            table: {
                database         : "",
                table            : "",
                structure        : [],
                data             : {},
                currentActiveName: "",
                numberOfRecords  : 1,
                pagination       : {
                    currentPage  : 1,
                    numberOfPages: 1,
                },
                loading          : false,
                tableLoading     : false,
                search           : {
                    column: "",
                },
                error            : {
                    loadError       : false,
                    loadErrorMessage: "",
                },
            },

            /**
         |---------------------------------------------
         | Holds data about the view/UI.
         |---------------------------------------------
         */
            view: {
                tab         : "tab-newRow",
                modus       : {
                    enum: {
                        BROWSE: 0,
                        MANAGE: 1,
                    },
                    mode: 0,
                },
                collapsed   : false,
                readability : true,
                darkMode    : false,
                welcomeShown: false,
                params      : new URLSearchParams(window.location.search),
                menu        : {
                    active_header_color: "rgb(90,103,216)",
                    active_item_color  : "rgb(127,156,245)",
                },
            },
        };
    },

    mounted () {
        if (!this.prequel.error) {
            this.checkUrlParameters();
        }

        window.addEventListener("popstate", this.handlePopState);
    },

    methods: {
        /**
       | Switch between query and browse mode. Only when in actual table.
       */
        switchMode: function (mode) {
            if (this.view.params.has("database") && this.view.params.has("table")) {
                this.view.modus.mode = mode;
                this.updateUrl();
            }
        },

        /**
       | Handles config changes.
       | Holds data like readability or side bar preferences in localStorage
       */
        configHandler: function () {
            if (window.localStorage.getItem("readability")) {
                this.view.readability = (window.localStorage.getItem("readability") === "true");
            }
            else {
                window.localStorage.setItem("readability", "true");
            }

            if (window.localStorage.getItem("showSidebar")) {
                this.view.collapsed = (window.localStorage.getItem("showSidebar") === "false");
            }
            else {
                window.localStorage.setItem("showSidebar", "false");
            }
        },

        /**
       | Change page on paginator change.
       */
        changePage: function (e) {
            this.table.pagination.currentPage = e;
            this.updateUrl();
            this.getTableData(`${this.table.database}.${this.table.table}`, false);
        },

        /**
       | Handles column name click event.
       */
        columnSelect: function (e) {
            this.table.search.column = e.target.id;
        },

        /**
       | Enhance/disable readability
       */
        readabilityEnhancer: function () {
            this.view.readability = (!this.view.readability);
            localStorage.setItem("readability", (!this.view.readability) + "");
        },

        /**
       | Handle actions when sidebar collapses or expands.
       */
        sideBarCollapseHandler: function () {
            let secsBeforeAction = 1000;

            window.localStorage.setItem("showSidebar", (!this.view.collapsed) + "");

            this.view.collapsed = (!this.view.collapsed);
            if (!this.view.collapsed) {
                window.setTimeout(this.setActiveTable, secsBeforeAction);
            }
        },

        /**
       | Open active table in menu, and set it to active. Purely an UI/UX addition.
       | @TODO When tables with same name exist in different databases, resolve to get correct one.
       */
        setActiveTable: function () {
            if (this.view.params.has("database") && this.view.params.has("table")) {
                // Menu header with database name
                let databaseEl = document.querySelector(`li[value=${this.view.params.get("database")}]`);

                // Menu items with table name
                let tableElements = document.querySelectorAll(`li[value=${this.view.params.get("table")}]`);
                let tableEl;

                tableElements.forEach((tableElement) => {
                    let tableName = `${this.view.params.get("database")}.${this.view.params.get("table")}`;
                    if (tableElement.title === tableName) {
                        tableEl = tableElement;
                    }
                });

                // All 'li' elements
                let menuItemElements = document.getElementsByTagName("li");

                // Reset other inactive items to their defaults.
                // Pretty costly operation, @TODO Refactor
                for (let menuElement of menuItemElements) {
                    if (menuElement && menuElement.style.color !== this.view.menu.active_header_color) {
                        menuElement.style.color = "";
                    }

                    if (menuElement && menuElement.style.color !== this.view.menu.active_item_color) {
                        menuElement.style.color = "";
                    }
                }

                // Only click if not already open as this causes it to be closed again.
                if (databaseEl.parentElement.parentElement.title === "CLOSED") {
                    databaseEl.click();
                }

                databaseEl.style.color = this.view.menu.active_header_color;
                tableEl.style.color    = this.view.menu.active_item_color;
            }
        },

        /**
       | Search for a table in de side menu
       */
        searchForTable: function (e) {
            this.getTableData(e.target.value, false);
        },

        /**
       | Check if database and table query parameters were found, and tries to select a table based on those parameters.
       */
        checkUrlParameters: function () {
            if (this.view.params.has("database") && this.view.params.has("table")) {
                if (this.view.params.has("page")) {
                    this.table.pagination.currentPage = this.view.params.get("page");
                }

                this.getTableData(`${this.view.params.get("database")}.${this.view.params.get("table")}`, false);
                this.setActiveTable();
            }

            if (this.view.params.has("mode")) {
                this.view.modus.mode = (this.view.params.get("mode") === "browse") ? 0 : 1;

                if (this.view.params.has("tab")) {
                    this.view.tab = this.view.params.get("tab");
                }
            }

        },

        /**
       | Update url query parameters to match current database and table, only updates when table was loaded.
       */
        updateUrl: function () {
            this.view.params.set("mode", this.view.modus.mode === this.view.modus.enum.BROWSE ? "browse" : "manage");
            this.view.params.set("database", this.table.database);
            this.view.params.set("table", this.table.table);

            if (this.view.modus.mode === this.view.modus.enum.BROWSE) {
                this.view.params.set("page", this.table.pagination.currentPage);
            }
            else {
                this.view.params.set("tab", this.view.tab);
                this.view.params.delete("page");
            }

            let baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            let url     = baseUrl + "?" + this.view.params.toString();

            window.history.pushState({ path: url }, "", url);

            if (!this.view.collapsed) {
                this.setActiveTable();
            }
        },

        /**
       | Asynchronously get table data.
       |
       | @param databaseTable Should be formatted as `database.table`.
       | @param dynamicLoad Dynamically figure out databaseTable OR use databaseTable directly as provided.
       | @returns {Promise<boolean>}
       | @TODO Shorten function.
       */
        getTableData: async function (
            databaseTable    = `${this.table.database}.${this.table.table}`,
            dynamicLoad      = true,
            updateUrlHistory = true) {

            if (!databaseTable.target && dynamicLoad) {
                return false;
            }

            let loadWasSuccess = false,
                result         = {},
                error          = {},
                table          = (dynamicLoad ? databaseTable.target.title : databaseTable).split(".");

            if (this.table.table !== table[1]) {
                this.table.pagination.numberOfPages = 1;
                this.table.pagination.currentPage   = this.view.params.has("page")
                    ? this.view.params.get("page")
                    : 1;
            }

            this.table.currentActiveName = dynamicLoad ? databaseTable.target.title : databaseTable;
            this.table.loading           = true;
            this.table.tableLoading      = true;
            this.view.welcomeShown       = true;
            this.table.database          = table[0];
            this.table.table             = table[1];

            try {
                result = await axios.get(`/database/get/${table[0]}/${table[1]}?page=${this.table.pagination.currentPage}`);
            }
            catch (err) {
                error = err;
            }
            finally {
                this.table.loading      = false;
                this.table.tableLoading = false;

                if (typeof result === "object" && result.data) {
                    loadWasSuccess                      = true;
                    this.table.data                     = result.data.data.data;
                    this.table.pagination.numberOfPages = result.data.data.last_page;
                    this.table.pagination.currentPage   = result.data.data.current_page;
                    this.table.numberOfRecords          = result.data.data.total;
                    this.table.structure                = result.data.structure;
                    this.table.error.loadError          = false;
                    window.scrollTo({
                        top     : 0,
                        left    : 0,
                        behavior: "smooth",
                    });

                    if (updateUrlHistory) {
                        this.updateUrl();
                    }
                }

                if (typeof error === "object" && error.response) {
                    loadWasSuccess                    = false;
                    this.table.data                   = {};
                    this.table.structure              = [];
                    this.table.error.loadError        = true;
                    this.table.error.loadErrorMessage = error.response.data.message;

                    if (updateUrlHistory) {
                        this.updateUrl();
                    }
                }
            }
            return loadWasSuccess;
        },

        /**
       | Reset table data to default values.
       */
        resetTableView: function () {
            this.table.loading                = true;
            this.table.current                = {};
            this.table.error.loadError        = false;
            this.table.error.loadErrorMessage = "";
        },

        /**
       | React to event emitted by Quick Find input in <Header>
       |
       | Only looks through currently active table.
       */
        searchInTable: async function ({ column, value, queryType }) {
            if (!column && !value) {
                return false;
            }

            let result = {},
                error  = {};

            this.table.loading = true;

            try {
                result = await axios.get(
                    `/database/find/${this.table.database}/${this.table.table}/${column}/${queryType}/${value}`);
            }
            catch (err) {
                error = err;
            }
            finally {
                this.table.loading = false;
                this.table.data    = result.data.data;
            }

            return !!this.table.data;
        },

        /**
       * Handles and tracks pop state.
       *
       */
        handlePopState () {
            this.view.params                  = new URLSearchParams(window.location.search);
            this.table.pagination.currentPage = parseInt(this.view.params.get("page"));
            this.table.database               = this.view.params.get("database");
            this.table.table                  = this.view.params.get("table");
            this.getTableData(`${this.table.database}.${this.table.table}`, false, false);
        },
    },
};
</script>

<style lang="scss">

    $break-md : 1400px;


    .slide-fade-enter-active {
        transition : all .2s ease;
    }

    .slide-fade-leave-active {
        transition : all .2s ease;
    }

    .slide-fade-enter, .slide-fade-leave-to {
        opacity : 0;
    }


    .main-content {
        @apply w-full;
        @apply flex;
        @apply justify-center;

        .wrapper {
            @apply flex;
            width : 98%;

            .table-wrapper {
                /*@apply overflow-x-scroll;*/
            }
        }

        .main-content-collapsed {
            width      : 100%;
            max-width  : 100%;
            transition : 1s ease;
        }

        .main-content-expanded {
            width      : 81%;
            max-width  : 81%;
            transition : 1s ease;
        }
    }
</style>
