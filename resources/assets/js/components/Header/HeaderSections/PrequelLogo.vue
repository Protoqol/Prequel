<template>
  <div>
    <div class="header-left-logo">
      <div class="header-left-logo-image">
        <a href="/prequel" :title="trans('general.home')">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
               preserveAspectRatio="xMidYMid" width="24" height="24" viewBox="0 0 310 380">
            <defs>
              <filter id="gradient-overlay-1" filterUnits="userSpaceOnUse">
                <feImage x="0" y="0" width="310" height="380" preserveAspectRatio="none"
                         xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMzEwIiBoZWlnaHQ9IjM4MCI+PGxpbmVhckdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjE1NSIgeTE9IjM1IiB4Mj0iMTU1IiB5Mj0iMzQ1Ij4KICA8c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiM1ZTBkOGMiLz4KICA8c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9IiM4YjNjYjciLz4KPC9saW5lYXJHcmFkaWVudD4KPHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmFkKSIvPjwvc3ZnPg=="/>
                <feComposite operator="in" in2="SourceGraphic"/>
                <feBlend in2="SourceGraphic" result="gradientFill"/>
              </filter>
            </defs>
            <path
                d="M310.000,130.001 L310.000,190.002 C310.000,239.702 240.594,280.002 155.000,280.002 C69.406,280.002 -0.000,239.702 -0.000,190.002 L-0.000,130.001 C-0.000,179.702 69.406,220.002 155.000,220.002 C240.594,220.002 310.000,179.702 310.000,130.001 L310.000,130.001 ZM-0.000,230.002 C-0.000,279.703 69.406,320.003 155.000,320.003 C240.594,320.003 310.000,279.703 310.000,230.002 L310.000,290.003 C310.000,339.703 240.594,380.004 155.000,380.004 C69.406,380.004 -0.000,339.703 -0.000,290.003 L-0.000,230.002 L-0.000,230.002 ZM155.000,180.002 C69.406,180.002 -0.000,139.701 -0.000,90.001 C-0.000,40.300 69.406,-0.000 155.000,-0.000 C240.594,-0.000 310.000,40.300 310.000,90.001 C310.000,139.701 240.594,180.002 155.000,180.002 L155.000,180.002 Z"
                class="cls-1"/>
          </svg>
        </a>
      </div>
      <h1 class="header-left-logo-text text-logo">
        <span>Prequel</span>
        <a href="https://github.com/Protoqol" target="_blank" title="Protoqol">Protoqol</a>
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
    lenCheck: function (val) {
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
.cls-1 {
  fill: #c084fc;
}

.header-left-logo {
  @apply flex;
  @apply flex-row;
  @apply justify-start;
  @apply items-center;

  .header-left-logo-image {
    @apply mr-1;

    img {
      -moz-user-select: none;
      -webkit-user-drag: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
  }

  .header-left-logo-text {
    @apply text-2xl;
    letter-spacing: 1px;
    color: var(--header-text-color);

    @media (min-width: 700px) and (max-width: 1400px) {
      @apply font-bold;
    }

    span {
      @apply font-bold;
    }

    a {
      @apply text-gray-400;

      @media (min-width: 700px) and (max-width: 1400px) {
        display: none;
      }

      @media (min-width: 1401px) {
        letter-spacing: normal;
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
  @apply text-gray-400;
  @apply text-xs;
}
</style>
