<template>
  <div id="highlight" class="sql-runner-wrapper">
    <ActionInfo title="SQL Query" description="Write and run a raw SQL query"/>
    <form>
      <textarea class="editor" v-model="query"></textarea>

      <div class="buttons">
        <button @click.prevent="runSql">Run SQL</button>
        <button @click.prevent="getLatestQuery">Get Previous Query</button>
        <button @click.prevent="emptyField">Clear Query</button>
      </div>
    </form>
    <div v-if="data" v-for="res in data" class="result-wrapper">
      <h2>
        Results for "<code class="mysql">{{ res.query }}</code>"
      </h2>
      <Table v-if="res && res.length !== 0" class="m-2" :data="res.data" :structure="res.columns"
             :readability="$root.view.readability"></Table>
    </div>
    <div v-if="error" class="result-wrapper">
      <h2 class="text-gray-400">Something went wrong with this query...</h2>
      <h2 class="mysql">
        <code class="mysql">{{ prevQuery }}</code>
      </h2>
    </div>
  </div>
</template>

<script>
import Table      from "../../BrowseMode/Table/Table";
import ActionInfo from "./ActionInfo";
import api        from "axios";

export default {
  name      : "RunSQL",
  components: {Table, ActionInfo},
  data() {
    return {
      "query"    : "SELECT * FROM `##database##`.`##table##` WHERE 1 LIMIT 15;",
      "prevQuery": "",
      "data"     : [],
      "error"    : false,
    };
  },

  mounted() {
    this.query = this.query.replace("##table##", this.$root.table.table);
    this.query = this.query.replace("##database##", this.$root.table.database);
    this.prevQuery = localStorage.getItem("latest_query");
  },

  methods: {
    runSql: function () {
      let obj = {
        query: this.query,
      };

      this.saveQuery(this.query);

      this.data = [];

      api.post(`/database/sql/${this.$root.table.database}/${this.$root.table.table}/run`, obj).then(res => {
        this.error = false;
        this.data = res.data;
      }).catch(err => {
        this.error = true;
      });
    },

    saveQuery: function () {
      localStorage.setItem("latest_query", this.query);
    },

    getLatestQuery: function () {
      let latest = localStorage.getItem("latest_query");
      this.query = latest ? latest : this.query;
    },

    emptyField: function () {
      this.query = "";
    },
  },
};
</script>

<style scoped lang="scss">
button {
  @apply m-auto;
  @apply py-1;
  @apply mt-4;
  @apply flex;
  @apply justify-center;
  background-color: var(--button-background);
  @apply text-white;
  @apply items-center;
  @apply rounded;
  @apply shadow;
  @apply border-b-4;
  @apply border-purple-700;

  transition: all .2s;

  &:hover {
    transition: all .2s;
    background-color: var(--button-background-hover);
  }

  &:active {
    transition: all .2s;
    background-color: var(--button-background-active);
    @apply border-transparent;
    @apply shadow-none;
  }

  &:disabled, &[disabled] {
    @apply bg-gray-400;
    @apply shadow-none;
    @apply cursor-default;
    @apply border-b-4;
    @apply border-gray-400;
  }

  @media (min-width: 700px) and (max-width: 1500px) {
    @apply text-sm;
  }
}

.sql-runner-wrapper {
  @apply flex;
  @apply flex-col;
  @apply justify-center;
  @apply w-full;

  .result-wrapper {
    background-color: var(--manage-navbar-bg);
    @apply m-2;
    @apply p-2;
    @apply rounded;
    @apply text-center;

    h2 {
      font-family: "Fira Code", Ubuntu, monospace !important;
      font-variant-ligatures: no-common-ligatures;
      @apply p-2;
      @apply text-gray-500;
      background-color: var(--manage-navbar-bg);

      code {
        @apply text-gray-900;
      }
    }
  }


  form {
    @apply w-full;

    .editor {
      font-family: monospace;
      height: 250px;
      min-height: 125px;
      @apply text-base;
      @apply w-3/4;
      @apply p-2;
      @apply ml-2;
      @apply mt-2;
      @apply border;
      @apply rounded;

    }

    .buttons {
      @apply flex;
      @apply flex-row;
      @apply justify-center;
      @apply items-center;
      @apply bg-gray-300;

      button {
        @apply px-4;
        @apply mb-2;
      }
    }

    label {
      @apply w-full;

      textarea {
        font-family: "Fira Code", Ubuntu, monospace;
        font-variant-ligatures: no-common-ligatures;
        resize: none;
        @apply w-3/4;
        @apply h-24;
        @apply text-left;
        @apply bg-gray-300;
        @apply block;
        @apply tracking-wide;
        @apply text-gray-700;
        @apply rounded;
        @apply m-2;
        @apply p-2;
      }
    }
  }
}


</style>
