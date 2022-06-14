<template>
  <div class="new-row-tab-wrapper">
    <div class="action-wrapper">
      <ActionInfo class="w-1/2" title="Export" description="Export this table's data and structure"></ActionInfo>
      <ActionInfo class="w-1/2" title="Import" description="Import data to this table"></ActionInfo>
    </div>

    <div class="action-wrapper">
      <form class="new-row-form" @submit="exportTable">
        <label for="structure_only">
          <input type="checkbox" v-model="structure_only" name="structure_only" id="structure_only">
          <span>Only export structure?</span>
        </label>
        <button class="button" @click="exportTable" title="Start export">
          <i class="ri-arrow-left-up-fill mr-1"></i>
          Export
        </button>
      </form>

      <form class="new-row-form" @submit="exportTable">
        <label for="file">
          <input type="file" accept=".sql" name="file" id="file">
        </label>
        <button class="button" @click="exportTable" title="Start export">
          <i class="ri-arrow-right-down-fill mr-1"></i>
          Import
        </button>
      </form>
    </div>

    <div class="action-wrapper">
      <div class="action-info-wrapper w-1/2">
        <div class="result" v-if="resultExport !== null">
          SQL dump created, located in <br>
          <pre>{{ resultExport }}</pre>
        </div>
        <div class="error" v-if="errorExport !== null">
          Something went wrong
          <pre>{{ errorExport }}</pre>
        </div>
      </div>
      <div class="action-info-wrapper w-1/2">
        <div class="result" v-if="resultImport !== null">
          SQL dump created, located in <br>
          <pre>{{ resultImport }}</pre>
        </div>
        <div class="error" v-if="errorImport !== null">
          Something went wrong
          <pre>{{ errorImport }}</pre>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ActionInfo from "./ActionInfo";
import axios      from "axios";

export default {
  name      : "Export",
  components: {ActionInfo},
  data() {
    return {
      structure_only: false,
      file          : null,
      resultExport  : null,
      errorExport   : null,
      resultImport  : null,
      errorImport   : null,
    };
  },
  methods: {
    exportTable(e) {
      e.preventDefault();

      axios.post(`database/sql/${this.$root.table.database}/${this.$root.table.table}/export`, {
        structure_only: this.structure_only,
      }).then(res => {
        this.resultExport = res.data.location;
      }).catch(err => {
        this.errorExport = err.response.data.message;
      });
    },
  },
};
</script>

<style scoped lang="scss">
.new-row-tab-wrapper {
  @apply flex;
  @apply flex-col;

  .action-wrapper {
    @apply flex;
    @apply flex-row;

    .result {
      @apply bg-purple-300;
      @apply m-2;
      @apply px-3;
      @apply py-1;
    }

    .error {
      @apply bg-red-300;
      @apply m-2;
      @apply px-3;
      @apply py-1;
    }

    button {
      @apply m-auto;
      @apply py-1;
      @apply px-3;
      @apply my-2;
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

    .new-row-form {
      background-color: var(--manage-navbar-bg);
      @apply rounded;
      @apply w-3/5;
      @apply px-3;
      @apply m-2;
      @apply flex;
      @apply flex-row;
      @apply justify-between;
      @apply items-center;

      label {
        @apply flex;
        @apply flex-row;
        @apply items-center;
        @apply justify-center;
        @apply gap-x-2;
        @apply font-semibold;
        color: var(--text-secondary-color);

        span {
          @media (min-width: 700px) and (max-width: 1500px) {
            @apply text-sm;
          }
        }

        small {
          @apply font-thin;
          @apply lowercase;
          @apply ml-2;
        }

        input {
          @apply bg-gray-200;
          @apply block;
          @apply tracking-wide;
          @apply text-gray-700;
          @apply text-xs;
          @apply font-bold;
          @apply p-2;
          @apply rounded;
        }
      }

      .buttons {
        @apply h-full;
      }
    }
  }
}

</style>
