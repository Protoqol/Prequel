<template>
    <div class="switch-container">
        <div class="switch">
            <div id="0" class="tab" :title="trans('switch_mode.browse.title')" @click="browseSwitchHandler">
                <font-awesome-icon icon="eye"/>
                <small>{{trans('switch_mode.browse.text')}}</small>
            </div>
            <div id="1" class="tab" :title="trans('switch_mode.manage.title')" @click="querySwitchHandler">
                <font-awesome-icon icon="wrench"/>
                <small>{{trans('switch_mode.manage.text')}}</small>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name : "SwitchMode",
    props: ["modus"],

    mounted () {
        this.mode = this.$props.modus;
        let url   = new URLSearchParams(window.location.search);

        if (url.has("mode")) {
            this.mode = url.get("mode") === "browse" ? 0 : 1;
        }

        this.checkMode();
    },

    data () {
        return {
        // Make Vue accessible enum version
            enum: {
                BROWSE: 0,
                MANAGE: 1,
            },

            // Default to browsing mode.
            mode: 0,
        };
    },

    methods: {

        /**
       * Resolve what mode is active and set tab-active class for the active mode.
       */
        checkMode: function () {
            let browseSwitch = document.getElementById(this.enum.BROWSE + "");
            let querySwitch  = document.getElementById(this.enum.MANAGE + "");

            if (this.mode === this.enum.BROWSE) {
                if (!browseSwitch.classList.contains("tab-active")) {
                    browseSwitch.classList.add("tab-active");
                    if (querySwitch.classList.contains("tab-active")) {
                        querySwitch.classList.remove("tab-active");
                    }
                }
            }

            if (this.mode === this.enum.MANAGE) {
                if (!querySwitch.classList.contains("tab-active")) {
                    querySwitch.classList.add("tab-active");
                    if (browseSwitch.classList.contains("tab-active")) {
                        browseSwitch.classList.remove("tab-active");
                    }
                }
            }

        },

        /**
       * When clicking on the query switch button.
       * Emit switchMode event, set current mode to query.
       */
        querySwitchHandler: function () {
            this.mode = this.enum.MANAGE;
            this.checkMode();
            this.$emit("switchMode", this.mode);
        },

        /**
       * When clicking on the browse switch button.
       * Emit switchMode event, set current mode to browse.
       */
        browseSwitchHandler: function () {
            this.mode = this.enum.BROWSE;
            this.checkMode();
            this.$emit("switchMode", this.mode);
        },
    },
};
</script>


<style lang="scss">
    .switch-container {
        @apply absolute;
        @apply top-0;
        @apply left-0;

        .switch {
            @apply flex;
            @apply flex-row;
            @media (min-width : 1401px) {
                @apply mx-2;
            }

            .tab {
                color      : var(--header-text-color);
                max-width  : 3rem;
                transition : .2s ease;
                @apply flex;
                @apply flex-col;
                @apply items-center;
                @apply justify-center;
                @apply bg-transparent;
                @apply py-2;
                @apply px-2;
                @apply w-12;
                @apply rounded-b;
                @apply cursor-pointer;


                small {
                    z-index : 5;
                    color   : var(--header-text-color);
                    @apply text-xs;
                }

                &:hover {
                    transition : .2s ease;
                    @apply bg-indigo-400;
                    @apply shadow-none;
                }
            }

            .tab-active {
                transition       : .2s ease;
                background-color : var(--button-background);
                @apply text-gray-300;
                @apply shadow;

                small {
                    @apply text-gray-300;
                    @apply mt-2;
                }
            }
        }
    }

</style>
