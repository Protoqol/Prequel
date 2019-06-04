<template>
    <div class="flex flex-col justify-center items-center mt-6">
        <div class="flex w-4/5">

            <div class="w-1/2">

                <!--    Logo and name        -->
                <div class="flex flex-row">
                    <div class="mr-1 mt-1">
                        <img class="no-drag" height="25" width="25" alt="Protoqol Prequel"
                             src="/vendor/prequel/favicon.png">
                    </div>
                    <h1 class="ml-1 text-2xl">
                        <span class="font-bold">Laravel</span> Prequel
                        <a href="https://github.com/Protoqol" target="_blank"
                           title="Creator of Laravel Prequel"
                           class="not-italic text-xs font-light">by
                            PROTOQOL
                        </a>
                    </h1>
                </div>

                <!--     Database information       -->
                <p class="ml-2 mt-1 self-center flex flex-row items-center ">
                <span title="Active database connection" class="mr-1 tracking-wide"
                      :class="connected ? 'text-gray-700' : 'text-red-400'">
                    {{user}}@{{host}}:{{port}}/{{database}}
                    <i v-if="!connected" class="text-red-400">
                        Could not connect to database!
                    </i>
                </span>
                </p>

            </div>

            <div class="w-1/2 flex flex-row justify-end items-center">

                <!--     Make database & table names better readable      -->
                <button class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
                        :title="`Enhance readability (${readability ? 'Enabled' : 'Disabled'})`"
                        :class="readability ? 'bg-indigo-500 text-white hover:text-gray-500' : 'bg-transparent text-gray-800'"
                        @click="readabilityButtonHandler">
                    <font-awesome-icon class="ml-1" icon="glasses"/>&nbsp;
                </button>

                <!--     Expand/collapse sidebar button      -->
                <button class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
                        :class="sideBarStatusText === 'Expand' ? 'bg-indigo-500 text-white hover:text-gray-500' : 'bg-transparent text-gray-800'"
                        :title="`${sideBarStatusText} side bar (${sideBarStatusText === 'Expand' ? 'Enabled' : 'Disabled'})`"
                        @click="sideBarButtonHandler">
                    <font-awesome-icon
                            :class="sideBarStatusText === 'Expand' ? 'chevron-point-right' : 'chevron-point-left'"
                            class="ml-1" icon="chevron-circle-up"/>&nbsp;
                </button>

            </div>
        </div>

        <!--    Divider    -->
        <span class="block my-4 w-4/5 divider-bottom"></span>
    </div>
</template>

<script>
    export default {
        name: "Header",
        data() {
            return {
                database: window.Prequel.env.database,
                host: window.Prequel.env.host,
                port: window.Prequel.env.port,
                connected: window.Prequel.isConnected,
                user: window.Prequel.env.user,
                sideBarStatusText: 'Collapse',
                readability: true
            }
        },
        methods: {
            sideBarButtonHandler: function () {
                this.$emit('collapseSideBar');
                this.sideBarStatusText = (this.sideBarStatusText === 'Expand') ? 'Collapse' : 'Expand';
            },
            readabilityButtonHandler: function () {
                this.readability = (!this.readability);
                this.$emit('enhanceReadability')
            }
        }
    }
</script>

<style>
    .divider-bottom {
        border-bottom: 1px solid #d5dfe9;
    }

    .chevron-point-left {
        transform: rotate(270deg);
        transition: .5s ease;
    }

    .chevron-point-right {
        transform: rotate(90deg);
        transition: .5s ease;
    }
</style>
