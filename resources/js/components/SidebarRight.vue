<template>
    <div class="col-lg-3 g-brd-left--lg g-brd-gray-light-v4 g-mb-80">
        <div class="g-pl-20--lg">
            <!-- pages -->
            <div class="g-mb-50">
                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Pages</h3>
                <ul class="list-unstyled g-font-size-13 mb-0">
                    <router-link v-for="(link, key) in currentLinks" :key="key" tag="li" :to="{ name: link.path,
                    query: $router.currentRoute.query }">
                        <a :class="linkClasses(link.active)" @click="linkActive(key)">
                        <i class="mr-2 fa fa-angle-right"></i> {{ link.name }}</a>
                    </router-link>

                </ul>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true" ref="noticeModal">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">공지</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="linkActive()">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img :src="noticeImageUrl" class="card-img-top" @click="imgPop(noticeImageUrl)" style='cursor:pointer;'>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="linkActive()">확인</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End pages -->
            <hr class="g-brd-gray-light-v4 g-mt-50 mb-0">

            <div id="stickyblock-start">
                <div class="js-sticky-block g-sticky-block--lg g-pt-50" data-responsive="true"
                    data-start-point="#stickyblock-start" data-end-point="#stickyblock-end">
                    <!-- Links -->
                    <div class="g-mb-50">
                        <h3 class="h5 g-color-black g-font-weight-600 mb-4">Links</h3>
                        <ul class="list-unstyled g-font-size-13 mb-0">
                            <li>
                                <article class="media g-mb-35">
                                    <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                        src="/files/logo/KakaoTalk_logo.svg" alt="Image Description">
                                    <div class="media-body">
                                        <h4 class="h6 g-color-black g-font-weight-600">카카오톡</h4>
                                        <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                            href="#">Follow</a>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="media g-mb-35">
                                    <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                        src="/files/logo/Discord_Logo.svg" alt="Image Description">
                                    <div class="media-body">
                                        <h4 class="h6 g-color-black g-font-weight-600">디스코드</h4>
                                        <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                            href="#">Follow</a>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="media">
                                    <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                        src="/files/logo/Telegram_logo.svg" alt="Image Description">
                                    <div class="media-body">
                                        <h4 class="h6 g-color-black g-font-weight-600">텔레그램</h4>
                                        <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                            href="#">Follow</a>
                                    </div>
                                </article>
                            </li>
                        </ul>
                    </div>
                    <!-- End Links -->

                    <hr class="g-brd-gray-light-v4 g-my-50">

                    <!-- Tags -->
                    <div class="g-mb-40">
                        <h3 class="h5 g-color-black g-font-weight-600 mb-4">Tags</h3>
                        <ul class="u-list-inline mb-0">
                            <li class="list-inline-item g-mb-10">
                                <router-link :to="{ name: 'home' }" class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15">
                                    전체
                                </router-link>
                            </li>
                            <li class="list-inline-item g-mb-10">
                                <router-link :to="{ name: 'tags.shop', params: { slug: 'favorites' } }" class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15">
                                    즐겨찾기
                                </router-link>
                            </li>
                            <li v-for="(tag, key) in $root.tags" :key="key" class="list-inline-item g-mb-10">
                                <router-link :to="{ name: 'tags.shop', params: { slug: tag.slug } }" class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15">
                                    {{ tag.text }}
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <!-- End Tags -->

                    <hr class="g-brd-gray-light-v4 g-my-50">

                    <!-- Inquiry -->
                    <div class="g-mb-50">
                        <h3 class="h5 g-color-black g-font-weight-600 mb-4">Search</h3>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn u-btn-primary g-rounded-left-50 g-py-13 g-px-20">
                                    <!-- <i class="icon-communication-062 u-line-icon-pro g-pos-rel g-top-1"></i> -->
                                    <i class="fas fa-search u-line-icon-pro g-pos-rel g-top-1"></i>
                                </button>
                            </span>
                            <input
                                class="form-control g-brd-primary g-placeholder-gray-dark-v5 border-left-0 g-rounded-right-50 g-px-12"
                                type="email" placeholder="Enter your search ...">
                        </div>
                    </div>
                    <!-- End Inquiry -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            links: {
                shop: [
                    {
                        name: '상점',
                        path: 'home',
                        active: true
                    },
                    {
                        name: '공지',
                        path: '',
                        active:  false
                    },
                ],
                charge: [
                    {
                        name: '입금 요청',
                        path: 'charge.deposit',
                        active: true
                    },
                    {
                        name: '상품권 충전',
                        path: 'charge.voucher',
                        active:  false
                    },
                ],
                history: [
                    {
                        name: '충전 내역',
                        path: 'history.charge',
                        active: true
                    },
                    {
                        name: '구매 내역',
                        path: 'history.buy',
                        active:  false
                    },
                ]
            },

            currentLinks: null,

            noticeImageUrl: '/files/notice.gif',
        }

    },

    watch: {
        "$route": 'fetchlinks'
    },

    mounted() {
        this.fetchlinks();
    },

    methods: {
        fetchlinks() {
            switch (this.$route.name) {
                case 'home':
                case 'tags.shop':
                    this.initActive(this.links.shop)
                case 'notice':
                    this.currentLinks = Object.assign({}, this.links.shop);
                    break;
                case 'charge.index':
                    this.initActive(this.links.charge)
                case 'charge.deposit':
                case 'charge.voucher':
                    this.currentLinks = Object.assign({}, this.links.charge);
                    break;
                case 'history.index':
                    this.initActive(this.links.history)
                case 'history.buy':
                case 'history.charge':
                    this.currentLinks = Object.assign({}, this.links.history);
                    break;
            }
        },

        initActive(link) {
            link[0].active = true;
            link[1].active = false;
        },

        linkClasses(active) {
            return [
                'd-block u-link-v5 g-px-20 g-py-8',
                active ? 'g-color-black g-bg-gray-light-v5 g-font-weight-600 g-rounded-50' : 'g-color-gray-dark-v4 rounded'
            ]
        },

        linkActive(key = 0) {
            if (this.currentLinks[key].name == '공지') {
                $(this.$refs.noticeModal).modal('show');
            }

            for (const i in this.currentLinks) {
                this.currentLinks[i].active = false;
                if (i == key)
                    this.currentLinks[i].active = true;
            }
        },

        imgPop(url){
            window.open(url,'_blank','toolbar=no,directories=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=750,left=0,top=0')
        }
    }
}
</script>
