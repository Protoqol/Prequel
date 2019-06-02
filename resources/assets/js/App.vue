<template>
    <div class="w-full h-full flex flex-col justify-center">
        <Header></Header>
        <div class="w-full h-64 flex flex-row">
            <SideBar></SideBar>
            <MainContent></MainContent>
        </div>
    </div>
</template>

<script>
    import Header from "./components/Header"
    import SideBar from "./components/SideBar"
    import MainContent from "./components/MainContent"

    export default {
        name: "App",
        components: {MainContent, SideBar, Header},
        data() {
            return {
                databases: {}
            }
        },
        created() {
            this.databases = window.Prequel.databases;
        }
    }
</script>

<style>

</style>
