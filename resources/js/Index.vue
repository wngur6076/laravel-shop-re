<template>
    <div id="main">
        <header id="js-header" v-show="$auth.check()" class="u-header u-header--static">
            <navigationMenu></navigationMenu>
        </header>

        <!-- 로그인했을 때 오른쪽사이드바와 컨텐츠를 위해서 -->
        <div class="container g-pt-100 g-pb-20" v-if="$auth.check()">
            <div class="row justify-content-between">
                <router-view></router-view>

                <sidebar-right></sidebar-right>
            </div>

            <!-- 새 게시글 작성 Modal -->
            <create-product></create-product>
        </div>

        <div id="container" v-else>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import navigationMenu from './components/Header.vue'
import sidebarRight from './components/SidebarRight.vue'
import CreateProduct from './components/CreateProduct'
import autosize from 'autosize';

export default {
    components: {
        navigationMenu, sidebarRight, CreateProduct
    },

    updated() {
        autosize(this.$el.querySelector('textarea'))
    },
}
</script>
