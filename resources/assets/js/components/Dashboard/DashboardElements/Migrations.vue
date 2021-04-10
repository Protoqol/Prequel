<template>
    <div id="migration-wrapper">
        <h1>
            {{trans('general.migrations')}} ({{migrations.pending}}/{{migrations.total}})
        </h1>
        <button :title="migrations.pending === 0 ? trans('dashboard.migrations.no_run_migrations') :
            trans('dashboard.migrations.run_migrations', {'number': migrations.pending})"
                :disabled="migrations.pending === 0" @click="runMigrations">
            <font-awesome-icon v-if='migrations.pending !== 0' class="mr-1" icon="running"/>
            {{migrations.pending === 0 ? trans('dashboard.migrations.no_run_migrations') :
            trans('dashboard.migrations.run_migrations', {'number': migrations.pending})}}
        </button>
        <button :title="migrations.pending === 0 ? trans('dashboard.migrations.reset_migrations', {'number': migrations.total}):
            trans('dashboard.migrations.no_reset_migrations') " :disabled="migrations.pending !== 0"
                @click="resetMigrations">
            <font-awesome-icon v-if='migrations.pending === 0' class="mr-1" icon="running"/>
            {{migrations.pending === 0 ? trans('dashboard.migrations.reset_migrations', {'number': migrations.total}):
            trans('dashboard.migrations.no_reset_migrations') }}
        </button>
    </div>
</template>

<script>
import api from "axios";

export default {
    name: "Migrations",
    data() {
        return {
            migrations: {
                pending: 0,
                total:   0,
            },
        };
    },

    created() {
        api.get("status").then(res => {
            this.migrations.pending = res.data.migrations.pending;
            this.migrations.total   = res.data.migrations.total;
        });
    },

    methods: {
        runMigrations: function() {
            api.get("database/migrations/run").then(res => {
                if (res) {
                    window.location.reload();
                }
            });
        },

        resetMigrations: function() {
            api.get("database/migrations/reset").finally(() => {
                window.location.reload();
            });
        },
    },
};
</script>

<style lang="scss">

    #migration-wrapper {

        @apply flex-1;
        @apply w-40;
        background-color: var(--table-item-overview);
        @apply py-4;
        @apply px-2;
        @apply border-l;
        @apply border-r;
        border-color: var(--border-color);

        h1 {
            @apply text-lg;
            @apply text-left;
            @apply ml-2;
            color: var(--header-text-color);
        }

        h2 {
            @apply ml-2;
            @apply text-sm;
            @apply text-left;
        }

        button {
            @apply w-4/5;
            @apply m-auto;
            @apply mt-2;
            @apply flex;
            @apply justify-center;
            background-color: var(--button-background);
            @apply text-white;
            @apply items-center;
            @apply rounded;
            @apply shadow;

            &:hover {
                background-color: var(--button-background-hover);
            }

            &:active {
                background-color: var(--button-background-active);
                @apply shadow-none;
            }

            &:disabled, &[disabled] {
                background-color: var(--button-background-hover);
                @apply shadow-none;
                @apply cursor-default;

                &:hover {
                    background-color: var(--button-background-hover);
                }
            }
        }
    }
</style>
