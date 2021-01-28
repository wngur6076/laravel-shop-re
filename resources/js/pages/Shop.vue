<template>
    <!-- Blog Classic Blocks -->
    <div class="col-lg-9 g-mb-80">
        <div class="spinner" v-if="$root.loading"></div>
        <div class="g-pr-20--lg" v-else-if="items.length">
            <vue-masonry-wall :items="items" :options="options" class="row g-mb-70">
                <template v-slot:default="{item}">
                    <!-- Blog Classic Blocks -->
                    <article class="u-shadow-v11" v-if="item != undefined">
                        <!-- Youtube Example -->
                        <div class="embed-responsive embed-responsive-16by9" v-if="item.video">
                            <iframe width="100%" :src="item.video" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <!-- End Youtube Example -->
                        <img class="img-fluid w-100" :src="item.image" v-else
                            alt="Image Description">

                        <div class="g-bg-white g-pa-30">
                            <div class="list-inline d-flex justify-content-between mb-0 align-items-center">
                                <span class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">{{ item.created_date }}</span>

                                <div class="dropdown-group" v-if="authorization.accept($auth.user(), item)">
                                    <div class="dropdown-button btn-more rounded-circle" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item pointer-none">{{ $auth.user().name }}</button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" data-toggle="modal" data-target="#editProduct" @click="getId(item, 1)"><i class="fas fa-pencil-alt"></i> <span class="g-ml-3">게시물 수정</span></button>
                                        <button class="dropdown-item" @click="destroy(item)"><i class="fas fa-trash"></i> <span class="g-ml-3">게시물 삭제</span></button>
                                    </div>
                                </div>
                            </div>
                            <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer product-title" data-toggle="modal" data-target="#readProduct"
                                @click="getId(item, 2)">
                                    {{ item.title }}
                                </a>
                            </h2>
                            <p class="g-color-gray-dark-v4 g-line-height-1_8 product-body">{{ item.excerpt }}</p>
                            <ul class="u-list-inline mb-0">
                                <li v-for="(tag, key) in item.tags" :key="key" class="list-inline-item g-mb-5">
                                    <router-link :to="{ name: 'tags.shop', params: { slug: tag.slug } }" class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-10 g-py-4 g-px-10">
                                        {{ tag.text }}
                                    </router-link>
                                </li>
                            </ul>

                            <hr class="g-mt-0 g-mb-20">

                            <ul class="list-inline d-flex justify-content-between mb-0 align-items-center">
                                <li class="list-inline-item g-color-gray-dark-v4">
                                    <favorite :product="item"></favorite>
                                </li>
                                <li class="list-inline-item g-color-gray-dark-v4"  data-toggle="modal" data-target="#payment">
                                    <div class="d-inline-block g-pos-rel">
                                        <a class="btn u-btn-outline-primary g-font-size-13 payment" @click="getId(item, 3)"><span>구매하기</span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </article>
                    <!-- End Blog Classic Blocks -->
                </template>
            </vue-masonry-wall>

            <pagination :meta="meta" :links="links"></pagination>
        </div>

        <div v-else class="alert alert-warning text-center">
            <div v-if="$route.params.slug == 'favorites'">
                <strong>즐겨찾기</strong> 존재하지 않습니다.
            </div>
            <div v-else>
                <strong>죄송합니다.</strong> 아직 상품 준비 중입니다.
            </div>
        </div>

        <!-- 새 게시글 작성 Modal -->
        <create-product v-if="$root.isShowModal == 0" @created="add"></create-product>
        <!-- 게시글 수정 Modal -->
        <edit-product v-if="$root.isShowModal == 1" :id="selectedId" @updated="edit"></edit-product>
        <!-- 게시글 읽기 Modal -->
        <read-product v-if="$root.isShowModal == 2" :id="selectedId"></read-product>
        <!-- 구매하기 Modal -->
        <payment v-if="$root.isShowModal == 3" :id="selectedId"></payment>
    </div>
    <!-- End Blog Classic Blocks -->

</template>

<script>
import Favorite from '../components/Favorite.vue';
import VueMasonryWall from "vue-masonry-wall";
import Pagination from '../components/Pagination'
import CreateProduct from '../components/CreateProduct'
import ReadProduct from '../components/ReadProduct'
import EditProduct from '../components/EditProduct'
import Payment from '../components/Payment'
import autosize from 'autosize';

export default {
    components: {
        VueMasonryWall, Pagination, Favorite,
        CreateProduct, ReadProduct, EditProduct, Payment
    },

    data() {
        return {
            options: {
                width: 387,
                padding: 15,
            },

            items: [],
            meta: {},
            links: {},

            endpoint: '',

            selectedId: '',
        }
    },

    watch: {
        "$route": 'fetchProducts'
    },

    mounted () {
        this.fetchProducts();
    },

    updated() {
        autosize(this.$el.querySelector('textarea'))
    },

    methods: {
        fetchProducts() {
            this.$root.loading = true;
            if (this.$route.name == 'tags.shop')
                this.endpoint = `/tags/${this.$route.params.slug}/products`
            else
                this.endpoint = '/products'

            axios.get(this.endpoint, { params: this.$route.query })
                .then(({ data }) => {
                    // console.log(data);
                    this.items = data.data
                    this.meta = data.meta;
                    this.links = data.links;

                    this.$root.loading = false;
                })
        },

        add(product) {
            // this.items.unshift(product);
            this.fetchProducts()
        },

        edit(product) {
            this.items.splice(this.findItemIndex(), 1, product);
        },

        destroy(item) {
            this.getId(item, -1)

            this.$toast.question('정말 삭제 하시겠습니까?', "확인", {
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Hey',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', (instance, toast) => {

                    this.delete();

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }, true],
                ['<button>NO</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }],
            ]
            })
        },

        delete() {
            axios.delete(`products/${this.selectedId}`)
                .then(({ data })  => {
                    // this.items.splice(this.findItemIndex(), 1)
                    this.fetchProducts()
                    this.$toast.success(data.message, "Success", { timeout: 2000 })
                })
        },

        findItemIndex() {
            return this.items.findIndex(item => item.id == this.selectedId)
        },

        getId(item, val) {
            this.selectedId = item.id
            this.$root.isShowModal = val
        },
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/_variables.scss';

    .product-body, .product-title {
        word-break: break-all;
    }

    .dropdown-item {
        &.pointer-none { pointer-events: none; }
    }

    .btn-more {
        cursor: pointer;
        padding: 0 10px;
        &:hover {
            background-color: $light-white;
        }
    }

    .payment {
        span {
            color: rgb(114,192,44);
        }
        &:hover {
            span {
                color: $white;
            }
        }
    }
</style>
