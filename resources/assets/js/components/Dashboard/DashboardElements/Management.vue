<template>
    <div class="database-management">
        <div class="overview">
            <h1>{{trans('dashboard.overview')}}</h1>
            <div class="status-cards" v-cloak>
                <Migrations/>

                <StatusDisplay v-if="app.serverInfo"
                               :header="trans('dashboard.avg_query_speed.header')"
                               :value="app.serverInfo.QUERIES_PER_SECOND_AVG "
                               :unit="trans('dashboard.avg_query_speed.unit')">

                    <slot v-if="app.serverInfo.QUERIES_PER_SECOND_AVG" ref="alert">
                        <Badge type='neutral' :text="trans('general.neutral')"/>
                    </slot>
                </StatusDisplay>

                <StatusDisplay v-if="app.serverInfo"
                               :header="trans('dashboard.active_threads.header')"
                               :value="app.serverInfo.THREADS ? app.serverInfo.THREADS : 'Could not retrieve...'"
                               :unit="trans('dashboard.active_threads.unit')">
                    <slot v-if="app.serverInfo.THREADS" ref="alert">
                        <Badge v-if="app.serverInfo.THREADS && app.serverInfo.THREADS > 0"
                               type='good' :text="trans('general.good')"/>
                        <Badge v-else type='warning' :text="trans('general.warning')"/>
                    </slot>
                </StatusDisplay>

                <StatusDisplay v-if="app.serverInfo"
                               :header="trans('dashboard.open_tables.header')"
                               :value="app.serverInfo.OPEN_TABLES ? app.serverInfo.OPEN_TABLES : 'Could not retrieve...'"
                               :unit="trans('dashboard.open_tables.unit')">
                    <slot v-if="app.serverInfo.OPEN_TABLES" ref="alert">
                        <Badge type="neutral" :text="trans('general.neutral')"/>
                    </slot>
                </StatusDisplay>
            </div>
            <div class="status-cards">
                <!--            <StatusDisplay :header="`Permissions for user '${$root.prequel.env.user}'`"-->
                <!--                           :value="readableArray(app.permissions)"/>-->

                <StatusDisplay v-if="app.serverInfo"
                               :header="trans('dashboard.uptime_hours.header')"
                               :value="app.serverInfo.UPTIME ? secsToHours(app.serverInfo.UPTIME) : 'Could not retrieve...'"
                               :unit="trans('dashboard.uptime_hours.unit')">
                    <slot v-if="app.serverInfo.UPTIME" ref="alert">
                        <Badge type="neutral" :text="trans('general.neutral')"/>
                    </slot>
                </StatusDisplay>

                <StatusDisplay v-if="app.serverInfo"
                               :header="trans('dashboard.uptime_minutes.header')"
                               :value="app.serverInfo.UPTIME ? secsToMins(app.serverInfo.UPTIME) : 'Could not retrieve...'"
                               :unit="trans('dashboard.uptime_minutes.unit')">
                    <slot v-if="app.serverInfo.UPTIME" ref="alert">
                        <Badge type="neutral" :text="trans('general.neutral')"/>
                    </slot>
                </StatusDisplay>

                <StatusDisplay v-if="app.serverInfo"
                               :header="trans('dashboard.uptime_seconds.header')"
                               :value="app.serverInfo.UPTIME ? app.serverInfo.UPTIME : 'Could not retrieve...'"
                               :unit="trans('dashboard.uptime_seconds.unit')">
                    <slot v-if="app.serverInfo.UPTIME" ref="alert">
                        <Badge type="neutral" :text="trans('general.neutral')"/>
                    </slot>
                </StatusDisplay>
            </div>
        </div>
        <div class="settings">
            <h1>{{trans('dashboard.settings')}}</h1>
            <Settings/>
        </div>
    </div>
</template>

<script>
  import api           from 'axios';
  import Migrations    from './Migrations';
  import StatusDisplay from './StatusDisplay';
  import Badge         from '../../Elements/Badge';
  import Settings      from './Settings';

  export default {
    name      : 'Management',
    components: {Settings, Badge, StatusDisplay, Migrations},
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
       * @TODO Check if user has enough privileges
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
            @apply pl-2;
            @apply border-t;
            border-color: var(--border-color);
            @apply rounded;
        }

        .overview {
            @apply mb-4;

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

        .settings {

        }
    }
</style>
