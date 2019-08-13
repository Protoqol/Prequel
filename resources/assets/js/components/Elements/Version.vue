<template>
    <div id="version" title="Current version (v1.13)">
        <div class="notification" title="There's a new version available">!</div>
        <p>v1.13</p>
    </div>
</template>

<script>
  import api from 'axios'

  export default {
    name: 'Version',
    mounted () {
      this.checkVersion()
    },

    methods: {
      checkVersion: function () {
        let currentVersion = 1.13

        api.get('/version').then(res => {
          // console.log(res)
        }).catch(err => {
          // console.log(err)
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
            opacity: 0;
        }
        75% {
            @apply bg-green-500;
        }
        100% {
            @apply bg-indigo-300;
            opacity: 1;
        }
    }

    #version {
        @apply absolute;
        top   : 10px;
        right : 17px;

        .notification {
            animation : color-rotate 5s linear infinite alternate;
            position      : absolute;
            top           : -2px;
            right         : -13px;
            font-size     : 8px;
            font-weight   : bolder;
            color         : white;
            width         : 12px;
            height        : 12px;
            text-align    : center;
            padding       : 1px;
            border-radius : 100%;
        }

        p {
            color     : #c3c8ca;
            font-size : 13px;
        }
    }
</style>
