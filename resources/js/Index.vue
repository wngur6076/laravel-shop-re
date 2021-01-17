<template>
    <div id="main">
        <header id="js-header" v-if="$auth.check()" class="u-header u-header--static">
            <navigationMenu></navigationMenu>
        </header>

        <div id="container">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
    import navigationMenu from './components/Menu.vue'
    import Shop from './components/Shop.vue'

    export default {
        components: {
            navigationMenu,
            Shop
        }
    }
</script>
