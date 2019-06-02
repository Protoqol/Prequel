<template>
    <div class="flex flex-col justify-center items-center mt-6">
        <div class="w-3/5 flex flex-row justify-start items-center">
            <div class="mr-1">
                <img class="no-drag" height="40" width="40" alt="Protoqol Prequel" src="/vendor/prequel/favicon.png">
            </div>
            <h1 class="ml-1 text-3xl">
                <span class="font-bold">Protoqol</span>
                Prequel
            </h1>
            <p class="ml-2 self-end flex flex-row items-center ">
                {{host}}:{{port}}&nbsp;
                <font-awesome-icon class="text-gray-600" icon="database"/>&nbsp;
                <span class="italic">{{database}}</span>&nbsp;&nbsp;
                <font-awesome-icon :class="connected ? 'text-green-500' : 'text-red-500'" icon="check-circle"/>
            </p>
        </div>
        <span class="block mt-4 w-3/5 divider-bottom"></span>
    </div>
</template>

<script>
    export default {
        name: "Header",
        data() {
            return {
                database: window.Prequel.env.database,
                host: window.Prequel.env.host,
                port: window.Prequel.env.port,
                connected: window.Prequel.isConnected
            }
        }
    }
</script>

<style>
    .divider-bottom {
        border-bottom: 1px solid #d5dfe9;
    }
</style>
