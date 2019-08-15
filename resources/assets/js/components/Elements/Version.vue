<template>
    <div id="version" :class="newVersionAvailable !== 0 ? 'cursor-pointer' : ''"
         :title="`Current version (${currentVersion})`" @click="autoUpdater">
        <div v-if="newVersionAvailable !== 0" class="notification" title="There's a new version available">!</div>
        <p :class="newVersionAvailable !== 0 ? 'text-red-300' : 'text-gray-400'">{{ currentVersion }}</p>
    </div>
</template>

<script>
  import api from 'axios'

  export default {
    name: 'Version',
    data () {
      return {
        newVersionAvailable: 0,
        currentVersion     : 'v1.13',
      }
    },

    mounted () {
      this.checkVersion()
    },

    methods: {
      checkVersion: function () {
        api.get('https://prequel.protoqol.xyz/api/prequel-version').then(res => {
          if (this.currentVersion !== res.data.newest_version) {
            this.newVersionAvailable = res.data.newest_version
          }
        }).catch(err => {
          //
        })
      },

      autoUpdater: function () {
        // @TODO @TODO!!
        Swal.fire({
          title             : 'There\'s a new version available!',
          text              : `Try updating to ${this.newVersionAvailable} with the auto-updater!`,
          confirmButtonText : 'Try auto-update',
          confirmButtonColor: '#657eea',
          showCancelButton  : true,
        })
      },
    },
  }
</script>

<style scoped lang="scss">
    @keyframes color-rotate {
        0% {
            @apply bg-red-300;
        }
        25% {
            @apply bg-indigo-500;
        }
        50% {
            @apply bg-blue-700;
            opacity : 0;
        }
        75% {
            @apply bg-green-500;
        }
        100% {
            @apply bg-indigo-300;
            opacity : 1;
        }
    }

    #version {
        @apply absolute;
        top   : 10px;
        right : 17px;

        .notification {
            animation   : color-rotate 5s linear infinite reverse;
            top         : -2px;
            right       : -13px;
            font-size   : 8px;
            font-weight : bolder;
            color       : white;
            width       : 12px;
            height      : 12px;
            padding     : 1px;
            @apply absolute;
            @apply text-center;
            @apply rounded-full;
        }

        p {
            font-size : 13px;
        }
    }
</style>
