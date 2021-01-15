<template>
    <div id="login" v-if="$auth.check()">
        <header id="js-header" class="u-header u-header--static">
            <navigationMenu></navigationMenu>
        </header>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
    <div class="not-login" v-else>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import navigationMenu from './components/Menu.vue'

export default {
    data() {
        return {
            //
        }
    },

    components: {
        navigationMenu,
    }
}
</script>
