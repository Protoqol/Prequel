<template>
    <div>
        <button :class="readability ? 'readability-button-enabled' : 'readability-button-disabled'"
                :title="trans('header.buttons.readability')"
                @click="readabilityButtonHandler">
            <font-awesome-icon class="ml-1" icon="glasses"/>&nbsp;
        </button>

        <button class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
                :title="trans('header.buttons.dark_mode')"
                :class="darkMode ? 'dark-mode-button-enabled' : 'dark-mode-button-disabled'"
                @click="darkModeButtonHandler">
            <font-awesome-icon class="ml-1" icon="adjust"/>&nbsp;
        </button>

        <button :class="showSideBar ? 'sidebar-button-enabled' : 'sidebar-button-disabled'"
                :title="trans('header.buttons.side_bar')"
                @click="sideBarButtonHandler">
            <font-awesome-icon class="ml-1"
                               :class="showSideBar ? 'chevron-point-left' : 'chevron-point-right'"
                               icon="chevron-circle-up"/>&nbsp;
        </button>

        <button class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
                :title="trans('header.buttons.refresh')"
                @click="refreshButtonHandler">
            <font-awesome-icon class="ml-1" icon="sync-alt"/>&nbsp;
        </button>
    </div>
</template>

<script>
export default {
    name: "SettingButtons",
    data () {
        return {
            sideBarStatusText: "Collapse",
            showSideBar      : false,
            readability      : true,
            darkMode         : false,
        };
    },

    created () {
        this.darkMode = JSON.parse(localStorage.getItem("dark-mode")) || false;
        this.changeTheme();
    },

    methods: {

        /**
       | Handles config changes.
       | Holds data like readability or side bar preferences in localStorage
       */
        configHandler: function () {
            if (window.localStorage.getItem("readability")) {
                this.readability = (window.localStorage.getItem("readability") === "true");
            }
            else {
                window.localStorage.setItem("readability", "true");
            }

            if (window.localStorage.getItem("showSidebar")) {
                this.showSideBar = (window.localStorage.getItem("showSidebar") === "false");
            }
            else {
                window.localStorage.setItem("showSidebar", "false");
            }
        },

        refreshButtonHandler: function () {
            this.$emit("refresh");
        },

        /**
       | Handles collapse button action
       | Emits event to collapse/expand sidebar.
       */
        sideBarButtonHandler: function () {
            this.showSideBar       = !this.showSideBar;
            this.sideBarStatusText = this.showSideBar ? "Collapse" : "Expand";
            this.$emit("collapseSideBar");
        },

        /**
       | Handles readability button actions.
       | Emits event to change readability globally.
       */
        readabilityButtonHandler: function () {
            this.readability = !this.readability;
            this.$emit("enhanceReadability");
        },

        /**
       | Handles dark mode button actions.
       */
        darkModeButtonHandler: function () {
            this.darkMode            = !this.darkMode;
            this.$root.view.darkMode = this.darkMode;
            localStorage.setItem("dark-mode", JSON.stringify(this.darkMode));
            this.changeTheme();
        },

        /**
       | Change theme to dark mode
       */
        changeTheme: function () {
            if (this.darkMode) {
                document.body.classList.add("theme-dark");
            }
            else {
                document.body.classList.remove("theme-dark");
            }
        },
    },
};
</script>

<style scoped lang="scss">
    button {
        @media (min-width : 700px) and (max-width : 1400px) {
            @apply mr-2;
        }

        @media (min-width : 1401px) {
            @apply mr-4;
        }
        @apply flex;
        @apply justify-center;
        @apply items-center;
        @apply h-10;
        @apply w-10;
        @apply rounded;
        @apply shadow;

        &:active {
            @apply bg-indigo-200;
        }
    }

    .dark-mode-button-enabled {
        color            : #ffffff;
        background-color : var(--button-background);
        transition       : 0.5s ease;

        &:hover {
            background-color : var(--button-background-hover);
            transition       : 0.5s ease;
        }
    }

    .dark-mode-button-disabled {
        color            : #2d3748;
        background-color : transparent;
        transition       : 0.5s ease;

        &:hover {
            background-color : #667eea;
            transition       : 0.5s ease;
        }
    }

    .readability-button-enabled {
        color            : #ffffff;
        background-color : var(--button-background);
        transition       : 0.5s ease;

        &:hover {
            background-color : var(--button-background-hover);
            transition       : 0.5s ease;
        }
    }

    .readability-button-disabled {
        color            : #2d3748;
        background-color : transparent;
        transition       : 0.5s ease;

        &:hover {
            background-color : var(--button-background-hover);
            transition       : 0.5s ease;
        }
    }

    .sidebar-button-enabled {
        color            : #2d3748;
        background-color : transparent;
        transition       : 0.5s ease;

        &:hover {
            background-color : #667eea;
            transition       : 0.5s ease;
        }
    }

    .sidebar-button-disabled {
        background-color : var(--button-background-hover);
        color            : #ffffff;
        transition       : 0.5s ease;

        &:hover {
            background-color : var(--button-background-hover);
            transition       : 0.5s ease;
        }
    }

    .chevron-point-left {
        transform  : rotate(270deg);
        transition : 0.5s ease;
    }

    .chevron-point-right {
        transform  : rotate(90deg);
        transition : 0.5s ease;
    }
</style>
