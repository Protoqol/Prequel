<template>
    <div class="header-container">
        <div class="header-flexbox">
            <div class="header-left">
                <div class="header-left-logo">
                    <div class="header-left-logo-image">
                        <img width="32rem" height="32rem" alt="Protoqol Prequel"
                             :src="$root.prequel.asset.logo">
                    </div>
                    <h1 class="header-left-logo-text text-logo">
                        <span>Laravel</span> Prequel
                        <a href="https://github.com/Protoqol"
                           target="_blank"
                           title="Creator of Laravel Prequel">
                            PROTOQOL
                        </a>
                    </h1>
                </div>
                <div class="header-left-connection">
                    <p title="Current connection" class="text-secondary">
                        {{env.user}}@{{env.host}}:{{env.port}}/{{env.database}}
                    </p>
                </div>
            </div>

            <div v-if="!error.error" class="header-middle">
                <h1 v-if="activeTable">
                    <span v-if="!tableLoading" id="header-table-message">
                        <font-awesome-icon class="fa" icon="table"/>
                        {{activeTable}} <small>({{ numberOfPages }} records)</small>
                    </span>
                    <img v-else width="20" height="20" :src="$root.prequel.asset.loader" alt="Loading table data...">
                </h1>

                <label v-if="activeTable">

                    <input class="search-column-input" list="columnList" type="text" name="column" autocomplete="off"
                           placeholder="Column..." v-model="input.column" :disabled="loading">
                    <datalist id="columnList">
                        <option v-for="struct in tableStructure" :value="struct.Field"></option>
                    </datalist>

                    <select class="search-type-input" name="queryType" v-model="input.queryType">
                        <option>=</option>
                        <option>!=</option>
                        <option>LIKE</option>
                    </select>

                    <!-- Type should be based on selected column     -->
                    <input class="search-value-input" name="value" placeholder="Value..."
                           :type="'text'"
                           :disabled="loading"
                           v-model="input.value"
                           @keyup.enter="searchHandler"
                           @keyup.esc="resetInputs">

                    <button class="search-get-button" title="Run query (ENTER)" @click="searchHandler">
                        Get
                    </button>
                    <button class="search-reset-button" title="Reset query (ESC)" @click="resetHandler">
                        Reset
                    </button>
                </label>
            </div>

            <div v-if="!error.error" class="header-right">
                <button :class="readability ? 'readability-button-enabled' : 'readability-button-disabled'"
                        :title="`Enhance readability (${readability ? 'Enabled' : 'Disabled'})`"
                        @click="readabilityButtonHandler">
                    <font-awesome-icon class="ml-1" icon="glasses"/>&nbsp;
                </button>

                <button class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
                        title="Set Dark Mode (Not available yet)"
                        :class="view.darkMode ? 'dark-mode-button-enabled' : 'dark-mode-button-disabled'"
                        @click="darkModeButtonHandler">
                    <font-awesome-icon class="ml-1" icon="adjust"/>&nbsp;
                </button>

                <button :class="showSideBar ? 'sidebar-button-enabled' : 'sidebar-button-disabled'"
                        :title="`${sideBarStatusText} side bar`"
                        @click="sideBarButtonHandler">
                    <font-awesome-icon class="ml-1"
                                       :class="showSideBar ? 'chevron-point-left' : 'chevron-point-right'"
                                       icon="chevron-circle-up"/>&nbsp;
                </button>
            </div>
        </div>
        <span class="header-bottom"></span>
    </div>
</template>

<script>

  export default {
    name : 'Header',
    props: [
      'error',
      'activeTable',
      'env',
      'loading',
      'tableLoading',
      'tableStructure',
      'searchColumn',
      'numberOfPages',
    ],

    data() {
      return {
        sideBarStatusText: 'Collapse',
        showSideBar      : false,
        readability      : true,

        view: {
          darkMode: false,
        },

        input: {
          availableColumns: [],
          column          : '',
          value           : '',
          queryType       : '=',
        },
      };
    },

    created() {
      this.view.darkMode = JSON.parse(localStorage.getItem('dark-mode')) || false;
      this.changeTheme();
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
          this.input.column    = '';
          this.input.value     = '';
          this.input.queryType = '=';
        }
      },
    },

    methods: {

      /**
       | This is not working as intended. @TODO
       | Handles config changes.
       | Holds data like readability or side bar preferences in localStorage
       */
      configHandler: function() {
        if (window.localStorage.getItem('readability')) {
          this.readability = (window.localStorage.getItem('readability') === 'true');
        }
        else {
          window.localStorage.setItem('readability', 'true');
        }

        if (window.localStorage.getItem('showSidebar')) {
          this.showSideBar = (window.localStorage.getItem('showSidebar') === 'false');
        }
        else {
          window.localStorage.setItem('showSidebar', 'false');
        }

        // add theme button handler code here potentially
      },

      /**
       | Reset input fields
       */
      resetInputs: function() {
        this.input.column    = '';
        this.input.value     = '';
        this.input.queryType = '=';
      },

      /**
       | Reset query
       */
      resetHandler: function() {
        this.$emit('resetSearchInTable');
        this.resetInputs();
      },

      /**
       | Handle input when searching for data inside a table
       */
      searchHandler: function() {
        let columnInputEl = document.querySelector('input[name=column]');
        let valueInputEl  = document.querySelector('input[name=value]');

        if (this.input.column.length === 0) {
          columnInputEl.classList.add('border-red-500');

          setTimeout(function() {
            columnInputEl.classList.remove('border-red-500');
          }, 750);
        }

        if (this.input.value.length === 0) {
          valueInputEl.classList.add('border-red-500');

          setTimeout(function() {
            valueInputEl.classList.remove('border-red-500');
          }, 750);
        }

        if (this.input.value.length > 0 && this.input.column.length > 0) {
          this.$emit('shouldBeLoading');
          this.$emit('searchInTable', {
            column   : this.input.column,
            value    : this.input.value,
            queryType: this.input.queryType,
          });
          return true;
        }

        return false;
      },

      /**
       | Handles collapse button action
       | Emits event to collapse/expand sidebar.
       */
      sideBarButtonHandler: function() {
        this.showSideBar       = !this.showSideBar;
        this.sideBarStatusText = this.showSideBar ? 'Collapse' : 'Expand';
        this.$emit('collapseSideBar');
      },

      /**
       | Handles readability button actions.
       | Emits event to change readability globally.
       */
      readabilityButtonHandler: function() {
        this.readability = !this.readability;
        this.$emit('enhanceReadability');
      },

      /**
       | Handles dark mode button actions.
       | Emits event to change theme globally.
       */
      darkModeButtonHandler: function() {
        this.view.darkMode = !this.view.darkMode;
        localStorage.setItem('dark-mode', JSON.stringify(this.view.darkMode));
        this.changeTheme();
      },

      changeTheme: function() {
          if(this.view.darkMode) {
              document.body.className += ' ' + 'theme-dark';
          } else {
              document.body.classList.remove("theme-dark");
          }
      }
    },
  };
</script>


<style lang="scss">
    /**
        Header - Container
    */
    .header-container {
        @apply flex;
        @apply flex-col;
        @apply justify-center;
        @apply items-center;
        @apply mt-5;

        .header-flexbox {
            @apply flex;
            @apply w-5/6;

            /**
                Header - Left - Logo, Connection information
            */
            .header-left {
                @apply w-1/4;

                .header-left-logo {
                    @apply flex;
                    @apply flex-row;

                    .header-left-logo-image {
                        @apply mr-1;
                        @apply mt-1;

                        img {
                            user-select: none;
                            -moz-user-select: none;
                            -webkit-user-drag: none;
                            -webkit-user-select: none;
                            -ms-user-select: none;
                        }
                    }

                    .header-left-logo-text {
                        @apply text-2xl;

                        span {
                            @apply font-bold;
                        }

                        a {
                            @apply not-italic;
                            @apply text-xs;
                            @apply font-light;
                        }
                    }
                }

                .header-left-connection {
                    @apply ml-2;
                    @apply mt-1;
                    @apply self-center;
                    @apply flex ;
                    @apply flex-row;
                    @apply items-center;
                    @apply mr-1 ;
                    @apply tracking-wide;
                    @apply text-gray-700;
                }
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
                        border-style: var(--input-border);

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
                        border-style: var(--input-border);

                        &:focus {
                            @apply outline-none;
                        }
                    }

                    .search-get-button {
                        @apply bg-indigo-500;
                        @apply mx-1;
                        @apply text-white;
                        @apply font-semibold;
                        @apply py-1;
                        @apply px-3;
                        @apply rounded;
                        @apply shadow;

                        &:hover {
                            @apply bg-indigo-400;
                        }

                        &:active {
                            @apply bg-indigo-300;
                        }
                    }

                    .search-reset-button {
                        @apply bg-indigo-300;
                        @apply text-white;
                        @apply font-semibold;
                        @apply py-1;
                        @apply px-2;
                        @apply rounded;
                        @apply shadow;

                        &:hover {
                            @apply bg-indigo-200;
                        }

                        &:active {
                            @apply bg-indigo-100;
                        }
                    }
                }
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

                button {
                    @apply mr-4;
                    @apply flex;
                    @apply justify-center;
                    @apply items-center;
                    @apply h-10;
                    @apply w-10;
                    @apply rounded;
                    @apply shadow;

                    &:hover {
                        @apply bg-indigo-100;
                    }

                    &:active {
                        @apply bg-indigo-200;
                    }
                }

                .dark-mode-button-enabled {
                    color: #fff;
                    background-color: #667eea;
                    transition: 0.5s ease;

                    &:hover {
                        background-color: rgba(105, 144, 255, 0.7);
                        transition: 0.5s ease;
                    }
                }

                .dark-mode-button-disabled {
                    color: #2d3748;
                    background-color: transparent;
                    transition: 0.5s ease;

                    &:hover {
                        background-color: #667eea;
                        transition: 0.5s ease;
                    }
                }

                .readability-button-enabled {
                    color: #fff;
                    background-color: #667eea;
                    transition: 0.5s ease;

                    &:hover {
                        background-color: rgba(105, 144, 255, 0.7);
                        transition: 0.5s ease;
                    }
                }

                .readability-button-disabled {
                    color: #2d3748;
                    background-color: transparent;
                    transition: 0.5s ease;

                    &:hover {
                        background-color: #667eea;
                        transition: 0.5s ease;
                    }
                }

                .sidebar-button-enabled {
                    color: #2d3748;
                    background-color: transparent;
                    transition: 0.5s ease;

                    &:hover {
                        background-color: #667eea;
                        transition: 0.5s ease;
                    }
                }

                .sidebar-button-disabled {
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
            }
        }

        /**
            Header - Bottom - Divider
        */
        .header-bottom {
            @apply block;
            @apply mt-4;
            @apply w-5/6;
            border-bottom: 1px solid var(--header-bottom-border-color);
        }
    }

</style>
