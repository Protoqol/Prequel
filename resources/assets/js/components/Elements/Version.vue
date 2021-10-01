<template>
    <div v-if="newVersionAvailable !== '0'" id="version" :class="newVersionAvailable !== '0' ? 'cursor-pointer' : ''"
         :title="`Current version (${currentVersion})`" @click="autoUpdater">
        <div v-if="newVersionAvailable !== '0'" class="notification" title="There's a new version available">!</div>
        <p :class="newVersionAvailable !== '0' ? 'text-red-300' : 'text-gray-400'">{{ currentVersion }}</p>
    </div>
</template>

<script>
import api from "axios";

export default {
    name: "Version",
    data () {
        return {
            newVersionAvailable: "0",
            currentVersion     : "v1.22.1",
        };
    },

    mounted () {
        this.checkVersion();
    },

    methods: {
        checkVersion: function () {
            api.get("https://protoqol.nl/api/prequel-version").then(res => {
                if (this.currentVersion !== res.data.newest_version) {
	//  this.newVersionAvailable = res.data.newest_version;
                }
            }).catch(err => {
                //
            });
        },

        autoUpdater: function () {
            let data = {
                "newest_version" : this.newVersionAvailable,
                "current_version": this.current_version,
            };

            Swal.fire({
                title             : "There's a new version available!",
                text              : `Try updating to ${this.newVersionAvailable} with the auto-updater!`,
                confirmButtonText : "Try auto-update",
                confirmButtonColor: "#657eea",
                showCancelButton  : true,
                preConfirm        : () => {
                    return api.post("update", data).then(res => {
                        if (res) {
                            return res.data;
                        }
                    });
                },
            }).then(res => {
                if (res.value) {
                    Swal.fire({
                        title: "Auto-updater logs",
                        text : `${res.value.log}`,
                    });
                }
            });
        },
    },
};
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
        }
        75% {
            @apply bg-green-500;
        }
        100% {
            @apply bg-indigo-300;
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
