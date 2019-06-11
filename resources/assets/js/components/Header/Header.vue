<template>
    <div class="flex flex-col justify-center items-center mt-6">
        <div class="flex w-4/5">
            <div class="w-1/3">
                <div class="flex flex-row">
                    <div class="mr-1 mt-1">
                        <img class="no-drag"
                             height="25"
                             width="25"
                             alt="Protoqol Prequel"
                             src="/vendor/prequel/favicon.png">
                    </div>
                    <h1 class="ml-1 text-2xl">
                        <span class="font-bold">Laravel</span>
                        Prequel
                        <a href="https://github.com/Protoqol/Prequel"
                           target="_blank"
                           title="Creator of Laravel Prequel"
                           class="not-italic text-xs font-light">
                            by PROTOQOL
                        </a>
                    </h1>
                </div>
                <div v-if="!error.error">
                    <p title="Current connection"
                       class="ml-2 mt-1 self-center flex flex-row items-center mr-1 tracking-wide text-gray-700">
                        {{env.user}}@{{env.host}}:{{env.port}}/{{env.database}}
                    </p>
                </div>
            </div>
            <div class="w-1/3 flex flex-col justify-center items-center">
                <h1 v-if="activeTable" class="text-lg flex flex-row justify-center items-center font-semibold">
                    <span class="font-normal text-sm mr-2">Table</span>
                    <span v-if="!tableLoading">{{activeTable}}</span>
                    <img v-else width="20" height="20" src="/vendor/prequel/loader.gif"
                         alt="Loading table data...">
                </h1>
                <input v-if="activeTable"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"
                       id="quickfind" name="quickfind" type="text"
                       placeholder="Quickly search this table..."
                       :disabled="loading"
                       @keyup="inputHandler($event)">
            </div>

            <div v-if="!error.error" class="w-1/3 flex flex-row justify-end items-center">
                <!--     Enhance readability button          -->
                <button class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
                        :class="readability ? 'readability-enabled' : 'readability-disabled'"
                        :title="`Enhance readability (${readability ? 'Enabled' : 'Disabled'})`"
                        @click="readabilityButtonHandler">
                    <font-awesome-icon class="ml-1" icon="glasses"/>&nbsp;
                </button>

                <!--     Expand/collapse sidebar button      -->
                <button class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
                        :class="showSideBar ? 'sidebar-enabled' : 'sidebar-disabled'"
                        :title="`${sideBarStatusText} side bar`"
                        @click="sideBarButtonHandler">
                    <font-awesome-icon class="ml-1"
                                       :class="showSideBar ? 'chevron-point-left' : 'chevron-point-right'"
                                       icon="chevron-circle-up"/>&nbsp;
                </button>
            </div>
        </div>

        <!--    Divider    -->
        <span class="block my-4 w-4/5 divider-bottom"></span>
    </div>
</template>

<script>
  import _ from 'lodash';

  export default {
    name   : 'Header',
    props  : ['error', 'activeTable', 'env', 'loading', 'tableLoading'],
    data() {
      return {
        timeBeforeQuickFindMs: 750,
        sideBarStatusText    : 'Collapse',
        showSideBar          : true,
        readability          : true,
        self                 : this, // Needed for debounce
      };
    },
    methods: {
      /**
       * Handles quick find input.
       *
       * Debounce default time is 550!
       */
      searchInTable: _.debounce(function(event) {
        this.$emit('quickFind', event);
      }, 550),

      inputHandler        : function(event) {
        this.$emit('shouldBeLoading');
        this.searchInTable(event);
      },
      /**
       * Handles collapse button action
       * Emits event to collapse/expand sidebar.
       */
      sideBarButtonHandler: function() {
        this.showSideBar       = !this.showSideBar;
        this.sideBarStatusText = this.showSideBar ? 'Collapse' : 'Expand';
        this.$emit('collapseSideBar');
      },

      /**
       * Handles readability button actions.
       * Emits event to change readability globally.
       */
      readabilityButtonHandler: function() {
        this.readability = !this.readability;
        this.$emit('enhanceReadability');
      },

      /**
       * Handles config changes.
       * Holds data like readability or side bar preferences in localStorage
       */
      configHandler: function() {
        // TODO store button states in localStorage or something similair
      },
    },
  };
</script>


<style lang="scss">
    .divider-bottom {
        border-bottom: 1px solid #d5dfe9;
    }

    .readability-enabled {
        color: #fff;
        background-color: #667eea;
        transition: 0.5s ease;

        &:hover {
            background-color: rgba(105, 144, 255, 0.7);
            transition: 0.5s ease;
        }
    }

    .readability-disabled {
        color: #2d3748;
        background-color: transparent;
        transition: 0.5s ease;

        &:hover {
            background-color: #667eea;
            transition: 0.5s ease;
        }
    }

    .sidebar-enabled {
        color: #2d3748;
        background-color: transparent;
        transition: 0.5s ease;

        &:hover {
            background-color: #667eea;
            transition: 0.5s ease;
        }
    }

    .sidebar-disabled {
        background-color: #667eea;
        color: #fff;
        transition: 0.5s ease;

        &:hover {
            background-color: rgba(105, 144, 255, 0.7);
            transition: 0.5s ease;
        }
    }

    .chevron-point-left {
        transform: rotate(270deg);
        transition: 0.5s ease;
    }

    .chevron-point-right {
        transform: rotate(90deg);
        transition: 0.5s ease;
    }
</style>
