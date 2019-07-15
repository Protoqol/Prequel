<template>
    <div>
        <Migrations/>
        <CurrentDatabaseSpeed/>
    </div>
</template>

<script>
  import Migrations           from './Migrations';
  import CurrentDatabaseSpeed from './DatabaseStatus';

  export default {
    name      : 'Management',
    components: {CurrentDatabaseSpeed, Migrations},
  };
</script>

<style scoped>

</style>
