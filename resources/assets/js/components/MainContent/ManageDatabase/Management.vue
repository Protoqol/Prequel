<template>
    <!-- @TODO Make badges less hardcoded ex. separate components.   -->
    <div class="database-management">
        <h1>Overview</h1>
        <div class="status-cards" v-cloak>
            <Migrations/>

            <StatusDisplay header="Average Query Speed"
                           :value="app.serverInfo.QUERIES_PER_SECOND_AVG ? app.serverInfo.QUERIES_PER_SECOND_AVG : 'Could not retrieve'"
                           :unit="app.serverInfo.QUERIES_PER_SECOND_AVG ? 'queries per second' : '...'">
                <slot ref="alert">
                    <span class="badge-good">New</span>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Active Threads"
                           :value="app.serverInfo.THREADS ? app.serverInfo.THREADS : 'Could not retrieve...'"
                           :unit="app.serverInfo.THREADS ? 'Threads' : ''">
                <slot ref="alert">
                    <span class="badge-critical">New</span>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Open Tables"
                           :value="app.serverInfo.OPEN_TABLES ? app.serverInfo.OPEN_TABLES : 'Could not retrieve...'"
                           :unit="app.serverInfo.OPEN_TABLES ? 'Tables' : ''">
                <slot ref="alert">
                    <span class="badge-warning">New</span>
                </slot>
            </StatusDisplay>
        </div>
        <div class="status-cards">
            <!--            <StatusDisplay :header="`Permissions for user '${$root.prequel.env.user}'`"-->
            <!--                           :value="readableArray(app.permissions)"/>-->

            <StatusDisplay header="Uptime in hours"
                           :value="app.serverInfo.UPTIME ? secsToHours(app.serverInfo.UPTIME) : 'Could not retrieve...'"
                           :unit="app.serverInfo.UPTIME ? 'hours' : ''">
                <slot ref="alert">
                    <span class="badge-neutral">New</span>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Uptime in minutes"
                           :value="app.serverInfo.UPTIME ? secsToMins(app.serverInfo.UPTIME) : 'Could not retrieve...'"
                           :unit="app.serverInfo.UPTIME ? 'minutes' : ''">
                <slot ref="alert">
                    <span class="badge-neutral">New</span>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Uptime in seconds"
                           :value="app.serverInfo.UPTIME ? app.serverInfo.UPTIME : 'Could not retrieve...'"
                           :unit="app.serverInfo.UPTIME ? 'seconds' : ''">
                <slot ref="alert">
                    <span class="badge-neutral">New</span>
                </slot>
            </StatusDisplay>
        </div>
    </div>
</template>

<script>
  import api           from 'axios';
  import Migrations    from './Migrations';
  import StatusDisplay from './StatusDisplay';

  export default {
    name      : 'Management',
    components: {StatusDisplay, Migrations},
    data() {
      return {
        app: {},
      };
    },

    created() {
      let self = this;
      this.getData();

      setInterval(function() {
        self.getData();
      }, 10000);
    },

    methods: {
      /**
       * Get status data
       */
      getData: function() {
        api.get('status').then(res => {
          this.app = res.data;
        });
      },

      /**
       * @TODO
       * Create readable string from array
       * @param privs
       */
      readableArray: function(privs) {
        // if (privs.HAS_ALL) {
        //   return 'User has all permissions';
        // }
        //
        // let readableString = '';
        //
        // for (let priv in privs) {
        //   if (priv === true) {
        //     readableString += priv;
        //   }
        // }
        //
        // return readableString;
      },

      /**
       * Seconds to hours
       */
      secsToHours: function(str) {
        let secs = parseFloat(str);
        return Math.round(secs / 60 / 60);
      },

      /**
       * Seconds to hours
       */
      secsToMins: function(str) {
        let secs = parseFloat(str);
        return Math.round(secs / 60);
      },

    },
  };
</script>

<style scoped lang="scss">
    .database-management {

        h1 {
            @apply text-center;
            @apply text-header;
            @apply font-normal;
            @apply text-lg;
            @apply pt-1;
            @apply mb-1;
            @apply pl-2;
            @apply border-t;
            @apply rounded;
        }

        .status-cards {
            @apply flex;
            @apply flex-wrap;
            @apply bg-gray-100;
            @apply border-t;
            @apply border-b;

            .badge-neutral {
                @apply rounded-full;
                @apply bg-blue-300;
                @apply uppercase;
                @apply px-2;
                @apply py-1;
                @apply text-xs;
                @apply font-medium;
                @apply mr-3;
            }

            .badge-warning {
                @apply rounded-full;
                @apply bg-orange-300;
                @apply text-white;
                @apply uppercase;
                @apply px-2;
                @apply py-1;
                @apply text-xs;
                @apply font-bold;
                @apply mr-3;
            }

            .badge-critical {
                @apply rounded-full;
                @apply bg-red-300;
                @apply text-white;
                @apply uppercase;
                @apply px-2;
                @apply py-1;
                @apply text-xs;
                @apply font-bold;
                @apply mr-3;
            }

            .badge-good {
                @apply rounded-full;
                @apply bg-green-300;
                @apply text-white;
                @apply uppercase;
                @apply px-2;
                @apply py-1;
                @apply text-xs;
                @apply font-bold;
                @apply mr-3;
            }
        }

        .button-wrapper {
            @apply flex;
            @apply justify-center;
            @apply my-2;

            a {
                @apply text-white;
                @apply font-bold;
                @apply py-1;
                @apply px-4;
                @apply rounded-full;
                @apply mx-1;
            }
        }
    }
</style>
