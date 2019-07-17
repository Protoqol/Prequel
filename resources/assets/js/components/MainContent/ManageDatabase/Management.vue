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
                    <Badge v-if="app.serverInfo.QUERIES_PER_SECOND_AVG && app.serverInfo.QUERIES_PER_SECOND_AVG === 0"
                           type="critical"/>
                    <Badge v-if="app.serverInfo.QUERIES_PER_SECOND_AVG && app.serverInfo.QUERIES_PER_SECOND_AVG >= 0.3"
                           type="average"/>
                    <Badge v-if="app.serverInfo.QUERIES_PER_SECOND_AVG && app.serverInfo.QUERIES_PER_SECOND_AVG >= 1"
                           type="good"/>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Active Threads"
                           :value="app.serverInfo.THREADS ? app.serverInfo.THREADS : 'Could not retrieve...'"
                           :unit="app.serverInfo.THREADS ? 'threads' : ''">
                <slot ref="alert">
                    <Badge v-if="app.serverInfo.THREADS && app.serverInfo.THREADS > 0" type="good"/>
                    <Badge v-else type="warning"/>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Open Tables"
                           :value="app.serverInfo.OPEN_TABLES ? app.serverInfo.OPEN_TABLES : 'Could not retrieve...'"
                           :unit="app.serverInfo.OPEN_TABLES ? 'tables' : ''">
                <slot ref="alert">
                    <Badge type="neutral" text="OK"/>
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
                    <Badge type="neutral" text="OK"/>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Uptime in minutes"
                           :value="app.serverInfo.UPTIME ? secsToMins(app.serverInfo.UPTIME) : 'Could not retrieve...'"
                           :unit="app.serverInfo.UPTIME ? 'minutes' : ''">
                <slot ref="alert">
                    <Badge type="neutral" text="OK"/>
                </slot>
            </StatusDisplay>

            <StatusDisplay header="Uptime in seconds"
                           :value="app.serverInfo.UPTIME ? app.serverInfo.UPTIME : 'Could not retrieve...'"
                           :unit="app.serverInfo.UPTIME ? 'seconds' : ''">
                <slot ref="alert">
                    <Badge type="neutral" text="OK"/>
                </slot>
            </StatusDisplay>
        </div>
    </div>
</template>

<script>
  import api           from 'axios';
  import Migrations    from './Migrations';
  import StatusDisplay from './StatusDisplay';
  import Badge         from '../../Elements/Badge';

  export default {
    name      : 'Management',
    components: {Badge, StatusDisplay, Migrations},
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
            border-color: var(--border-color);
            @apply rounded;
        }

        .status-cards {
            @apply flex;
            @apply flex-wrap;
            @apply bg-gray-100;
            @apply border-t;
            @apply border-b;
            border-color: var(--border-color);
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
