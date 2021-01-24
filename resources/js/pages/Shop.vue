<template>
    <!-- Blog Classic Blocks -->
    <div class="col-lg-9 g-mb-80">
        <div class="g-pr-20--lg">
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
                            <span
                                class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">{{ item.created_date }}</span>
                            <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                    href="#">{{ item.title }}</a>
                            </h2>
                            <p class="g-color-gray-dark-v4 g-line-height-1_8 product-body">{{ item.excerpt }}</p>
                            <!-- <a class="g-font-size-13" href="#">Read more...</a> -->
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
                                <li class="list-inline-item g-color-gray-dark-v4">
                                    <div class="d-inline-block g-pos-rel">
                                        <a class="btn u-btn-outline-primary g-font-size-13" href="#">구매하기</a>
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

        <!-- 새 게시글 작성 Modal -->
        <create-product @created="add"></create-product>
    </div>
    <!-- End Blog Classic Blocks -->

</template>

<script>
import Favorite from '../components/Favorite.vue';
import VueMasonryWall from "vue-masonry-wall";
import Pagination from '../components/Pagination'
import CreateProduct from '../components/CreateProduct'
import autosize from 'autosize';

export default {
    components: {
        VueMasonryWall, Pagination, CreateProduct, Favorite
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

            endpoint: null
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
            if (this.$route.name == 'tags.shop')
                this.endpoint = `/tags/${this.$route.params.slug}/products`
            else
                this.endpoint = '/products'

            axios.get(this.endpoint, { params: this.$route.query })
                .then(({ data }) => {
                    // console.log(data);
                    this.items = data.data;
                    this.meta = data.meta;
                    this.links = data.links;
                })
        },

        add(product) {
            this.items.unshift(product);
        }
    },
}
</script>

<style lang="scss" scoped>
    .product-body {
        word-break: break-all;
    }
</style>
