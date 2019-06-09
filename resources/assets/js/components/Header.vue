<template>
  <div class="flex flex-col justify-center items-center mt-6">
    <div class="flex w-4/5">
      <div class="w-1/2">
        <!--    Logo and name        -->
        <div class="flex flex-row">
          <div class="mr-1 mt-1">
            <img
              class="no-drag"
              height="25"
              width="25"
              alt="Protoqol Prequel"
              src="/vendor/prequel/favicon.png"
            >
          </div>
          <h1 class="ml-1 text-2xl">
            <span class="font-bold">Laravel</span> Prequel
            <a
              href="https://github.com/Protoqol/Prequel"
              target="_blank"
              title="Creator of Laravel Prequel"
              class="not-italic text-xs font-light"
            >
              by
              PROTOQOL
            </a>
          </h1>
        </div>

        <!--     Database information       -->
        <div v-if="!prequelError">
          <p class="ml-2 mt-1 self-center flex flex-row items-center">
            <span
              title="Active database connection"
              class="mr-1 tracking-wide"
              :class="connected ? 'text-gray-700' : 'text-red-400'"
            >
              {{user}}@{{host}}:{{port}}/{{database}}
              <i
                v-if="!connected"
                class="text-red-400"
              >Could not connect to database!</i>
            </span>
          </p>
        </div>
      </div>

      <div v-if="!prequelError" class="w-1/2 flex flex-row justify-end items-center">
        <!--     Enhance readability button          -->
        <button
          class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
          :class="readability ? 'readability-enabled' : 'readability-disabled'"
          :title="`Enhance readability (${readability ? 'Enabled' : 'Disabled'})`"
          @click="readabilityButtonHandler"
        >
          <font-awesome-icon class="ml-1" icon="glasses"/>&nbsp;
        </button>

        <!--     Expand/collapse sidebar button      -->
        <button
          class="mr-4 flex justify-center items-center h-10 w-10 hover:bg-indigo-100 active:bg-indigo-200 rounded shadow"
          :class="showSideBar ? 'sidebar-enabled' : 'sidebar-disabled'"
          :title="`${sideBarStatusText} side bar`"
          @click="sideBarButtonHandler"
        >
          <font-awesome-icon
            class="ml-1"
            :class="showSideBar ? 'chevron-point-left' : 'chevron-point-right'"
            icon="chevron-circle-up"
          />&nbsp;
        </button>
      </div>
    </div>

    <!--    Divider    -->
    <span class="block my-4 w-4/5 divider-bottom"></span>
  </div>
</template>

<script>
export default {
  name: "Header",
  props: ["prequelError"],
  data() {
    return {
      database: window.Prequel.env.database,
      host: window.Prequel.env.host,
      port: window.Prequel.env.port,
      connected: window.Prequel.isConnected,
      user: window.Prequel.env.user,
      sideBarStatusText: "Collapse",
      showSideBar: true,
      readability: true
    };
  },
  methods: {
    sideBarButtonHandler: function() {
      this.showSideBar = !this.showSideBar;
      this.sideBarStatusText = this.showSideBar ? "Collapse" : "Expand";
      this.$emit("collapseSideBar");
    },
    readabilityButtonHandler: function() {
      this.readability = !this.readability;
      this.$emit("enhanceReadability");
    },
    configHandler: function() {
      // TODO store button states in localStorage
    }
  }
};
</script>


<style lang="scss">
.divider-bottom {
  border-bottom: 1px solid #d5dfe9;
}

.readability-enabled {
  color: #fff;
  background-color: #667eea;
  transition: 0.5s ease;

  &:hover {
    background-color: rgba(105, 144, 255, 0.7);
    transition: 0.5s ease;
  }
}

.readability-disabled {
  color: #2d3748;
  background-color: transparent;
  transition: 0.5s ease;

  &:hover {
    background-color: #667eea;
    transition: 0.5s ease;
  }
}

.sidebar-enabled {
  color: #2d3748;
  background-color: transparent;
  transition: 0.5s ease;

  &:hover {
    background-color: #667eea;
    transition: 0.5s ease;
  }
}

.sidebar-disabled {
  background-color: #667eea;
  color: #fff;
  transition: 0.5s ease;

  &:hover {
    background-color: rgba(105, 144, 255, 0.7);
    transition: 0.5s ease;
  }
}

.chevron-point-left {
  transform: rotate(270deg);
  transition: 0.5s ease;
}

.chevron-point-right {
  transform: rotate(90deg);
  transition: 0.5s ease;
}
</style>
