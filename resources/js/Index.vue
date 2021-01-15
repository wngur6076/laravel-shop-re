<template>
    <div id="main" v-if="$auth.check(1)">
        <header id="js-header" class="u-header u-header--static">
            <navigationMenu></navigationMenu>
        </header>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
    <div class="login" v-else>
        <login></login>
    </div>
</template>

<script>
    import navigationMenu from './components/Menu.vue'
import Login from './pages/Login.vue'
    import login from './pages/Login.vue'
    export default {
        data() {
            return {
                //
            }
        },
        components: {
            navigationMenu,
                Login
        }
    }
</script>
