<template>
    <div class="navbar-wrapper">
        <ul>
            <li :title="trans('table_management.insert_new_row')" @click.prevent="setActiveTab($event)">
                <a id="tab-newRow" :class="this.activeClassName">
                    {{trans('table_management.insert_new_row')}}
                </a>
            </li>
            <li :title="trans('table_management.view_structure')" @click.prevent="setActiveTab($event)">
                <a id="tab-structure" :class="this.inactiveClassName">
                    {{trans('table_management.view_structure')}}
                </a>
            </li>
<!--            <li :title="trans('table_management.run_sql')" @click.prevent="setActiveTab($event)">-->
<!--                <a id="tab-query" :class="this.inactiveClassName">-->
<!--                    {{trans('table_management.run_sql')}}-->
<!--                </a>-->
<!--            </li>-->
            <!-- @TODO Implement -->
<!--            <li :title="trans('table_management.import')" @click.prevent="setActiveTab($event)">
                <a id="tab-import" :class="this.inactiveClassName">
                    {{trans('table_management.import')}}
                </a>
            </li>
            <li :title="trans('table_management.export')" @click.prevent="setActiveTab($event)">
                <a id="tab-export" :class="this.inactiveClassName">
                    {{trans('table_management.export')}}
                </a>
            </li>
            <li :title="trans('table_management.export')" @click.prevent="setActiveTab($event)">
                <a id="tab-log" :class="this.inactiveClassName">
                    {{trans('table_management.log')}}
                </a>
            </li>
            <li :title="trans('table_management.export')" @click.prevent="setActiveTab($event)">
                <a id="tab-settings" :class="this.inactiveClassName">
                    {{trans('table_management.settings')}}
                </a>
            </li>-->
        </ul>
    </div>
</template>

<script>
export default {
    name: "ManageNavbar",
    data () {
        return {
            "activeTabId"      : "tab-newRow",
            "activeClassName"  : "active",
            "inactiveClassName": "inactive",
        };
    },

    mounted () {
        this.getActiveTab();
    },

    methods: {
        setActiveTab: function (e) {
            let el     = e.srcElement;
            let prevEl = document.getElementById(this.activeTabId);

            if (prevEl.classList.contains(this.activeClassName)) {
                prevEl.classList.remove(this.activeClassName);
                prevEl.classList.add(this.inactiveClassName);
            }

            if (el.classList.contains(this.inactiveClassName)) {
                el.classList.remove(this.inactiveClassName);
                el.classList.add(this.activeClassName);
            }

            this.activeTabId = el.id;

            this.$emit("changeTab", el);
        },

        getActiveTab: function () {
            let e        = {};
            e.srcElement = document.getElementById((new URLSearchParams(window.location.search)).get("tab"));
            this.setActiveTab(e);
        },

    },
};
</script>

<style scoped lang="scss">
    .navbar-wrapper {
        background-color : var(--manage-navbar-bg);
        @apply p-2;
        @apply shadow;
        @apply rounded;

        ul {
            @apply flex;
            @apply items-center;

            li {
                @apply mr-3;
                @apply text-white;
                @apply cursor-pointer;

                a {
                    @apply text-center;
                }

                .active {
                    background-color : var(--button-background);
                    @apply inline-block;
                    @apply rounded;
                    @apply py-1;
                    @apply px-3;
                    @apply text-white;
                    @apply shadow;
                }

                .inactive {
                    color : var(--manage-navbar-inactive-text-color);
                    @apply inline-block;
                    @apply border;
                    @apply border-indigo-300;
                    @apply rounded;
                    @apply py-1;
                    @apply px-3;

                    &:hover {
                        background-color : var(--manage-navbar-inactive-bg-hover-color);
                        @apply border-indigo-200;
                    }
                }
            }
        }
    }
</style>
