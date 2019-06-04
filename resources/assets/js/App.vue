<template>
    <div v-cloak>
        <Header @enhanceReadability="readableNames = (!readableNames)"
                @collapseSideBar="collapsed = (!collapsed)"></Header>
        <div class="w-full flex justify-center">
            <div class="content flex">
                <transition name="slide-fade" mode="in-out">
                    <SideBar v-if="!collapsed" :class="collapsed ? 'hidden' : 'w-1/5'"
                             :readability="readableNames"
                             @tableSelect="getTableData($event)"></SideBar>
                </transition>
                <MainContent class="transition-ease"
                             :class="setCorrectWidthForMainContent"
                             :loading="tableDataLoading"
                             :tableData="currentlySelectedTableData"></MainContent>

            </div>
        </div>
    </div>
</template>

<script>
    import Header from "./components/Header"
    import SideBar from "./components/SideBar"
    import MainContent from "./components/MainContent"
    import axios from 'axios'

    export default {
        name: "App",
        components: {MainContent, SideBar, Header},
        data() {
            return {
                databases: window.Prequel.databases,
                currentlySelectedTableData: {},
                tableDataLoading: false,
                collapsed: false,
                readableNames: true
            }
        },
        updated() {
            // Keep main content a fixed width
            this.setCorrectWidthForMainContent(this.collapsed);
        },
        created() {
            // for debug purposes
            let tmp   = {}
            tmp.title = 'bookeep.invoices';
            this.getTableData(tmp);
        },
        methods: {
            getTableData: function (selectedTable) {
                let table             = selectedTable.title || selectedTable.value;
                let separated         = table.split('.');
                this.tableDataLoading = true;

                axios.get(`database/${separated[0]}/${separated[1]}/columns/get`)
                    .then(res => {
                        this.currentlySelectedTableData = res.data;
                        this.tableDataLoading           = false;
                    })
                    .catch(err => {
                        console.error(err);
                    });
            },
            setCorrectWidthForMainContent: function (collapsed) {
                setTimeout(function () {
                    return collapsed ? 'w-full' : 'w-4/5';
                }, 200);
            }
        }
    }
</script>

<style lang="scss">
    :focus {
        outline: 0;
    }

    /**
        Main content container
    */
    .content {
        width: 95%;
    }

    /**
        Main content transition
    */
    .transition-ease {
        transition: width 12s ease;
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
