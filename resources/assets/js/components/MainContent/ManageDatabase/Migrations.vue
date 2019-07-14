<template>
    <div id="migration-wrapper">
        <h1>
            Migrations ({{migrations.pending}}/{{migrations.total}})
        </h1>
        <button title="Run pending migrations" :disabled="migrations.pending === 0" @click="runMigrations">
            <font-awesome-icon v-if='migrations.pending !== 0' class="mr-1" icon="running"/>
            {{migrations.pending === 0 ? 'No pending migrations' : `Run ${migrations.pending} migration(s)`}}
        </button>
        <button title="Run pending migrations" :disabled="migrations.pending !== 0" @click="resetMigrations">
            <font-awesome-icon v-if='migrations.pending === 0' class="mr-1" icon="running"/>
            {{migrations.pending !== 0 ? 'No existing migrations' : `Reset ${migrations.total} migration(s)`}}
        </button>
    </div>
</template>

<script>
  import api from 'axios';

  export default {
    name: 'Migrations',
    data() {
      return {
        migrations: {
          pending: 0,
          total  : 0,
        },
      };
    },

    created() {
      api.get('status').then(res => {
        this.migrations.pending = res.data.migrations.pending;
        this.migrations.total   = res.data.migrations.total;
      });
    },

    methods: {
      runMigrations: function() {
        api.get('run/migrations').then(res => {
          if (res) {
            window.location.reload();
          }
        });
      },

      resetMigrations: function() {
        api.get('reset/migrations').then(res => {
          if (res) {
            window.location.reload();
          }
        });
      },
    },
  };
</script>

<style lang="scss">
    #migration-wrapper {
        @apply w-56;
        @apply bg-gray-100;
        @apply py-4;
        @apply px-2;
        @apply border-l;
        @apply border-r;

        h1 {
            @apply text-lg;
            @apply text-center;
        }

        h2 {
            @apply ml-2;
            @apply text-sm;
            @apply text-left;
        }

        button {
            @apply w-full;
            @apply mt-2;
            @apply flex;
            @apply justify-center;
            @apply bg-indigo-500;
            @apply text-white;
            @apply items-center;
            @apply rounded;
            @apply shadow;

            &:hover {
                @apply bg-indigo-400;
            }

            &:active {
                @apply bg-indigo-300;
                @apply shadow-none;
            }

            &:disabled, &[disabled] {
                @apply bg-indigo-300;
                @apply shadow-none;
                @apply cursor-default;

                &:hover {
                    @apply bg-indigo-300;
                }
            }
        }
    }
</style>
