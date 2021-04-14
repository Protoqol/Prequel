<template>
    <div>
        <div class="header-left-logo">
            <div class="header-left-logo-image">
                <a href="/prequel" :title="trans('general.home')">
                    <img width="35rem" height="35rem" alt="Protoqol Prequel" :src="$root.prequel.asset.logo">
                </a>
            </div>
            <h1 class="header-left-logo-text text-logo">
                <span>Prequel</span>
                <a href="https://github.com/Protoqol" target="_blank" title="Creator of Prequel">PROTOQOL</a>
            </h1>
        </div>
        <div class="header-left-connection">
            <p title="Current connection">
                <span :title="'User: ' + env.user" v-html="lenCheck(env.user)"></span>@<span
                :title="'Host: ' + env.host"
                v-html="lenCheck(env.host)"></span>:<span
                :title="'Port: ' + env.port" v-html="lenCheck(env.port)"></span>/<span
                :title="'Database: ' + env.database"
                v-html="lenCheck(env.database)"></span>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name : "PrequelLogo",
    props: ["env"],

    methods: {

        /**
       | Check length and cut down if too long.
       */
        lenCheck: function(val) {
            val = val + "";
            if (val.length > 10) {
                return val.substr(0, 7) + "...";
            }
            return val;
        },

    },
};
</script>

<style scoped lang="scss">
    .header-left-logo {
        @apply flex;
        @apply flex-row;
        @apply justify-start;
        @apply items-center;

        .header-left-logo-image {
            @apply mr-1;

            img {
                -moz-user-select    : none;
                -webkit-user-drag   : none;
                -webkit-user-select : none;
                -ms-user-select     : none;
            }
        }

        .header-left-logo-text {
            @apply text-2xl;
            letter-spacing : 1px;
            color          : var(--header-text-color);

            @media (min-width : 700px) and (max-width : 1400px) {
                @apply font-bold;
            }

            span {
                @apply font-bold;
            }

            a {
                @media (min-width : 700px) and (max-width : 1400px) {
                    display : none;
                }

                @media (min-width : 1401px) {
                    letter-spacing : normal;
                    @apply not-italic;
                    @apply text-xs;
                    @apply font-light;
                }
            }
        }
    }

    .header-left-connection {
        @apply ml-2;
        @apply mt-1;
        @apply self-center;
        @apply flex;
        @apply flex-row;
        @apply items-center;
        @apply mr-1;
        @apply tracking-wide;
        @apply text-gray-700;

        @media (min-width : 700px) and (max-width : 1400px) {
            @apply text-sm;
        }
    }
</style>
