<template>
    <div class="migration-wrapper">
        <h1>
            <font-awesome-icon icon="asterisk"/>
            Migrations
        </h1>
        <h2 v-if="migrations.pending !== 0">{{migrations.pending}} out of {{migrations.total}} are pending</h2>
        <h2 v-else>All migrations have been run.</h2>
        <button title="Run pending migrations" :disabled="migrations === 0" @click="runMigrations">
            <font-awesome-icon class="mr-1" icon="running"/>
            Run remaining migration(s)
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
        api.get('migrations').then(res => {
          if (res) {
            window.location.reload();
          }
        });
      },
    },
  };
</script>

<style lang="scss">
    .migration-wrapper {
        @apply w-64;

        h1 {
            @apply text-2xl;
            @apply border-b;
            @apply text-center;
        }

        h2 {
            @apply bg-indigo-200;
            @apply text-base;
            @apply text-center;
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
        }
    }
</style>
