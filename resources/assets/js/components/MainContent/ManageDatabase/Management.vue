<template>
    <div class="database-management">
        <h1>Overview</h1>
        <div class="status-cards">
            <Migrations/>

            <StatusDisplay header="Queries per second average"
                           :value="app.serverInfo.QUERIES_PER_SECOND_AVG ? app.serverInfo.QUERIES_PER_SECOND_AVG : 'Could not retrieve'"
                           :unit="app.serverInfo.QUERIES_PER_SECOND_AVG ? 'queries/second' : '...'"/>

            <StatusDisplay header="Active Threads"
                           :value="app.serverInfo.THREADS ? app.serverInfo.THREADS : 'Could not retrieve...'"
                           :unit="app.serverInfo.THREADS ? 'Threads' : ''"/>

            <StatusDisplay header="Open Tables"
                           :value="app.serverInfo.OPEN_TABLES ? app.serverInfo.OPEN_TABLES : 'Could not retrieve...'"
                           :unit="app.serverInfo.OPEN_TABLES ? 'Tables' : ''"/>
        </div>
        <div class="status-cards">
            <StatusDisplay :header="`Permissions for user '${$root.prequel.env.user}'`"
                           :value="readableArray(app.permissions)"/>
            <StatusDisplay header="Placeholder" value="Placeholder"/>
            <StatusDisplay header="Placeholder" value="Placeholder"/>
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
      getData: function() {
        api.get('status').then(res => {
          this.app = res.data;
        });
      },

      /**
       * Create readable string from array
       * @param arr
       */
      readableArray: function(arr) {
        return 'TODO';
        // @TODO
        // let readableString = '';
        //
        // for (let i = 0; i < arr; i++) {
        //   console.log(arr[i]);
        //   if (arr[i]) {
        //     readableString += arr[i].value();
        //   }
        // }
        //
        // return readableString;
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
