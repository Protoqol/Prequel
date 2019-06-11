<template>
    <div class="accordion" v-bind:class="theme">
        <div class="header" @click="toggle">
            <slot name="header">HINT</slot>
        </div>
        <transition name="accordion"
                    @before-enter="beforeEnter" @enter="enter"
                    @before-leave="beforeLeave" @leave="leave">
            <div class="animate-all body" v-show="show">
                <div class="body-inner">
                    <slot></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    // Component thanks to https://codepen.io/ktsn
    export default {
        name: 'Accordion',
        props: ['theme'],
        data() {
            return {
                show: false,
            };
        },
        methods: {
            toggle: function () {
                this.show = !this.show;
            },
            beforeEnter: function (el) {
                el.style.height = '0';
            },
            enter: function (el) {
                el.style.height = el.scrollHeight + 'px';
            },
            beforeLeave: function (el) {
                el.style.height = el.scrollHeight + 'px';
            },
            leave: function (el) {
                el.style.height = '0';
            },
        },
    };
</script>

<style scoped>
    .accordion .body {
        overflow: hidden;
        transition: 500ms ease;
    }

    .accordion .body-inner {
        padding: 8px;
        overflow-wrap: break-word;
    }
</style>
