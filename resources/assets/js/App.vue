<template>
    <div v-cloak>

        <!--   Header     -->
        <Header @enhanceReadability="readableNames = (!readableNames)"
                :prequelError="prequelError.error"
                :activeTable="activeTable"
                @collapseSideBar="collapsed = (!collapsed)"></Header>

        <!--   Main     -->
        <div v-if="!prequelError.error" class="w-full flex justify-center">
            <div class="content flex">
                <transition name="slide-fade" mode="in-out">
                    <SideBar v-if="!collapsed"
                             :class="collapsed ? 'hidden' : 'w-1/5'"
                             :readability="readableNames"
                             @tableSelect="getTableData($event)"></SideBar>
                </transition>
                <MainContent class="w-full"
                             :class="setCorrectWidthForMainContent"
                             :readability="readableNames"
                             :loading="tableDataLoading"
                             :loadError="tableDataLoadError"
                             :tableError="tableError"
                             :tableData="currentlySelectedTableData"></MainContent>
            </div>
        </div>

        <!--    Error    -->
        <div v-if="prequelError.error">
            <h1 class="mt-10 text-center text-3xl text-bold text-red-500">Oops... {{ prequelError.detailed }}</h1>
            <h3 class="text-center text-lg text-normal text-black">
                Tried with
                <span class="italic text-gray-800">{{env.user}}@{{env.host}}:{{env.port}}/{{env.database}}</span>
            </h3>
        </div>
    </div>
</template>

<script>
    import Header from './components/Header';
    import SideBar from './components/SideBar';
    import MainContent from './components/MainContent';
    import axios from 'axios';

    export default {
        name: 'App',
        components: {MainContent, SideBar, Header},
        data() {
            return {
                prequelError: window.Prequel.error,
                databases: window.Prequel.databases,
                currentlySelectedTableData: {},
                env: {
                    database: window.Prequel.env.database,
                    host: window.Prequel.env.host,
                    port: window.Prequel.env.port,
                    connected: window.Prequel.isConnected,
                    user: window.Prequel.env.user,
                },
                tableDataLoading: false,
                tableDataLoadError: false,
                tableError: '',
                collapsed: false,
                readableNames: true,
                sourcecode: '',
                activeTable: '',
            };
        },
        methods: {
            /**
             * Asynchronously get table data.
             *
             * @param databaseTable Should be formatted as `database.table`.
             * @param dynamic Dynamically figure out databaseTable or use databaseTable as is.
             * @returns {Promise<boolean>}
             */
            getTableData: async function (databaseTable, dynamic = true) {
                if (!databaseTable.target) return false;

                this.activeTable = databaseTable.target.innerText;
                let parsed       = (dynamic ? databaseTable.target.title || databaseTable.target.value : databaseTable).split('.'),
                    res          = {};

                this.tableDataLoading = true;

                try {
                    res = await axios.get(`database/${parsed[0]}/${parsed[1]}/columns/get`);
                } catch (err) {
                    this.tableDataLoadError = true;
                    this.tableError         = err;
                }

                this.tableDataLoading           = false;
                this.currentlySelectedTableData = res.data;
                return (res.status === 200);
            },

            /**
             * Set width when side bar is collapsed
             *
             * @param collapsed
             */
            setCorrectWidthForMainContent: function (collapsed) {
                setTimeout(function () {
                    return collapsed ? 'w-full' : 'w-4/5';
                }, 200);
            },

            /**
             * Figure out first table in first database and set as default view.
             *
             * No longer in use
             */
            setFirstTableInView: function () {
                if (!this.prequelError.error) {
                    for (let prop in this.databases) {
                        if (this.databases.hasOwnProperty(prop)) {
                            let table = this.databases[prop];
                            this.getTableData(`${table.official_name}.${table.tables[0].name.official}`, false);
                            break;
                        }
                    }
                }
            },
        },
    };
</script>

<style lang="scss">
    :focus {
        outline: 0;
    }

    /**
        Main content container
    */
    .content {
        width: 98%;
    }

    /**
        Side bar transition
     */
    .slide-fade-enter-active {
        transition: all .2s ease;
    }

    .slide-fade-leave-active {
        transition: all .2s ease;
    }

    .slide-fade-enter, .slide-fade-leave-to {
        opacity: 0;
    }
</style>
