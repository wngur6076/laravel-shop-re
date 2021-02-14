<template>
    <div id="main">
        <header id="js-header" v-if="$auth.check()" class="u-header u-header--static">
            <navigationMenu></navigationMenu>
        </header>

        <!-- 로그인했을 때 오른쪽사이드바와 컨텐츠를 위해서 -->
        <div class="container g-pt-100 g-pb-20" v-if="$auth.check()">
            <div class="row justify-content-between">
                <router-view></router-view>

                <sidebar-right></sidebar-right>
            </div>
        </div>

        <div id="container" v-else>
            <router-view></router-view>
        </div>

        <!-- 맨위로가기 버튼 -->
        <a class="js-go-to u-go-to-v1" data-type="fixed" data-position='{
                "bottom": 15,
                "right": 15
            }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
                <i class="hs-icon hs-icon-arrow-top"></i>
        </a>
    </div>
</template>

<script>
import navigationMenu from './components/Header.vue'
import sidebarRight from './components/SidebarRight.vue'

export default {
    components: {
        navigationMenu, sidebarRight
    },
}
</script>
