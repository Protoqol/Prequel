<template>
  <div>
    <div class="header-left-logo">
      <div class="header-left-logo-image">
        <a href="/prequel" :title="trans('general.home')">
          <svg class="fill-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path fill="none" d="M0 0h24v24H0z"/>
            <path
                d="M21 9.5v3c0 2.485-4.03 4.5-9 4.5s-9-2.015-9-4.5v-3c0 2.485 4.03 4.5 9 4.5s9-2.015 9-4.5zm-18 5c0 2.485 4.03 4.5 9 4.5s9-2.015 9-4.5v3c0 2.485-4.03 4.5-9 4.5s-9-2.015-9-4.5v-3zm9-2.5c-4.97 0-9-2.015-9-4.5S7.03 3 12 3s9 2.015 9 4.5-4.03 4.5-9 4.5z"/>
          </svg>
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
  @apply text-gray-700;

  @media (min-width: 700px) and (max-width: 1400px) {
    @apply text-sm;
  }
}
</style>
