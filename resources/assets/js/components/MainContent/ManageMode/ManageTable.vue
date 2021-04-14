<template>
    <div class="management-wrapper">
        <ManageNavbar @changeTab="changeTab($event)"/>
        <div class="tab-content">
            <CreateRow v-if="activeTab === 'tab-newRow'" :structure="structure"/>
            <ViewStructure v-if="activeTab === 'tab-structure'" :structure="structure"/>
            <RunSQL v-if="activeTab === 'tab-query'"/>
            <Import v-if="activeTab === 'tab-import'"/>
            <Export v-if="activeTab === 'tab-export'"/>
        </div>
    </div>
</template>

<script>
import ManageNavbar  from "./ManageNavbar";
import CreateRow     from "./ManageActions/CreateRow";
import RunSQL        from "./ManageActions/RunSQL";
import ViewStructure from "./ManageActions/ViewStructure";
import Import        from "./ManageActions/Import";
import Export        from "./ManageActions/Export";

export default {
    name      : "ManageTable",
    components: { Export, Import, ViewStructure, RunSQL, CreateRow, ManageNavbar },
    props     : ["data", "structure"],

    data () {
        return {
            activeTab: "tab-newRow",
        };
    },

    mounted () {
        let url        = new URLSearchParams(window.location.search);
        this.activeTab = url.get("tab");
    },

    methods: {
        changeTab: function ({ id }) {
            this.activeTab      = id;
            this.$root.view.tab = id;
            this.$root.updateUrl();
        },
    },
};

</script>
