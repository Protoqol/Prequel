<template>
    <!--
        Order of attributes:
             1. Vue operators
             2. Native attributes (id, class etc.)
             3. Vue bindings
             4. Vue events
             5. Vue loops
        -->
    <div v-cloak>
        <Header :error="prequel.errorDetailed"
                :activeTable="table.currentActiveName"
                :env="prequel.env"
                :loading="table.loading"
                :tableLoading="table.tableLoading"
                @quickFind="quickFind($event)"
                @shouldBeLoading="table.loading = true"
                @enhanceReadability="view.readability = (!view.readability)"
                @collapseSideBar="view.collapsed = (!view.collapsed)"/>

        <div v-if="!prequel.error" class="w-full flex justify-center">
            <div class="content flex">
                <transition name="slide-fade" mode="in-out">
                    <SideBar v-if="!view.collapsed"
                             :class="view.collapsed ? 'hidden' : 'w-1/5'"
                             :readability="view.readability"
                             :table-data="prequel.data"
                             @tableSelect="getTableData($event)"/>
                </transition>
                <MainContent :class="view.collapsed ? 'w-full' : 'w-4/5'"
                             :readability="view.readability"
                             :loading="table.loading"
                             :welcome-shown="view.welcomeShown"
                             :table-load-error="table.error.loadError"
                             :table-error-detailed="table.error.loadErrorMessage"
                             :data="table.data"
                             :structure="table.structure"/>
            </div>
        </div>

        <PrequelError v-if="prequel.error"
                      :error-detailed="prequel.errorDetailed"
                      :env="prequel.env"/>
    </div>
</template>

<script>
  import Header       from './components/Header/Header';
  import SideBar      from './components/SideBar/SideBar';
  import MainContent  from './components/MainContent/MainContent';
  import axios        from 'axios';
  import PrequelError from './components/Elements/PrequelError';

  export default {
    name      : 'App',
    components: {
      PrequelError,
      MainContent,
      SideBar,
      Header,
    },

    data() {
      return {

        /**
         * Holds data dat comes directly from Prequel.
         */
        prequel: {
          error        : window.Prequel.error.error, // Object
          errorDetailed: window.Prequel.error,       // String
          data         : window.Prequel.databases,   // Object
          env          : window.Prequel.env,         // Object
        },

        /**
         * Holds data about current table.
         */
        table: {
          database         : '',
          table            : '',
          structure        : [],
          data             : {},
          currentActiveName: '',
          currentTablePage : 1,
          loading          : false,
          tableLoading     : false,
          error            : {
            loadError       : false,
            loadErrorMessage: '',
          },
        },

        /**
         * Holds data about view options.
         */
        view: {
          collapsed   : false,
          readability : true,
          welcomeShown: false,
          params      : new URLSearchParams(window.location.search),
        },
      };
    },

    created() {
      if (this.view.params.get('database') && this.view.params.get('table')) {
        this.getTableData(`${this.view.params.get('database')}.${this.view.params.get('table')}`, false);
      }
    },

    mounted() {
      console.log('mounted');
    },

    methods: {

      /**
       * Update url query parameters to match current database and table.
       */
      updateUrl: function() {

        this.view.params.set('database', this.table.database);
        this.view.params.set('table', this.table.table);

        let baseUrl = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let url     = baseUrl + '?' + this.view.params.toString();

        window.history.pushState({path: url}, '', url);
      },

      /**
       * Asynchronously get table data.
       *
       * @param databaseTable Should be formatted as `database.table`.
       * @param dynamicLoad Dynamically figure out databaseTable OR use databaseTable as is.
       * @returns {Promise<boolean>}
       */
      getTableData: async function(databaseTable, dynamicLoad = true) {
        if (!databaseTable.target && dynamicLoad) {
          return false;
        }

        this.resetTableView();

        let loadWasSuccess = false,
            result         = {},
            error          = {},
            table          = (dynamicLoad
                              ? databaseTable.target.title || databaseTable.target.value
                              : databaseTable).split('.');

        this.table.currentActiveName = dynamicLoad ? databaseTable.target.title : databaseTable;
        this.table.loading           = true;
        this.table.tableLoading      = true;
        this.view.welcomeShown       = true;
        this.table.database          = table[0];
        this.table.table             = table[1];

        try {
          result = await axios.get(
              `database/${this.table.database}/${this.table.table}/data/get?page=${this.table.currentTablePage}`,
          );
        }
        catch (err) {
          error = err;
        }
        finally {
          this.table.loading      = false;
          this.table.tableLoading = false;

          if (typeof result === 'object' && result.data) {
            loadWasSuccess             = true;
            this.table.data            = result.data.data.data;
            this.table.structure       = result.data.structure;
            this.table.error.loadError = false;
            this.updateUrl();
          }

          if (typeof error === 'object' && error.response) {
            loadWasSuccess                    = false;
            this.table.data                   = {};
            this.table.structure              = [];
            this.table.error.loadError        = true;
            this.table.error.loadErrorMessage = error.response.data.message;
          }
        }
        return loadWasSuccess;
      },

      /**
       * Resets table data to default values.
       */
      resetTableView: function() {
        this.table.loading                = true;
        this.table.current                = {};
        this.table.error.loadError        = false;
        this.table.error.loadErrorMessage = '';
      },

      /**
       * Reacts to event emitted by Quick Find input in <Header>
       *
       * Only looks through currently active table.
       */
      quickFind: async function(event) {
        if (!event.target.value) {
          return false;
        }

        let result = {},
            error  = {},
            query  = event.target.value;

        this.table.loading = true;

        try {
          result = await axios.get(`database/${this.table.database}/${this.table.table}/query/${query}/get`);
        }
        catch (err) {
          error = err;
        }
        finally {
          this.table.loading = false;
          this.table.data    = result.data;
        }

        return !!this.table.data;
      },

    },
  };
</script>

<style lang="scss">

    /**
        Disable outline
    */
    :focus {
        outline: 0;
    }

    /**
        Scrollbar style
    */
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
        border-radius: 10px;
        transition: .2s ease;
    }

    ::-webkit-scrollbar {
        width: 5px;
        height: 10px;
        background-color: #f5f5f5;
        transition: .2s ease;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: rgba(73, 125, 189, 0.5);
        transition: .2s ease;
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
