<template>
    <!-- Blog Classic Blocks -->
    <div class="col-lg-9 g-mb-80">
        <div class="g-pr-20--lg">
            <vue-masonry-wall :items="items" :options="options" class="row g-mb-70">
                <template v-slot:default="{item}">
                    <!-- Blog Classic Blocks -->
                    <article class="u-shadow-v11">
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
                            <p class="g-color-gray-dark-v4 g-line-height-1_8">{{ item.excerpt }}</p>
                            <a class="g-font-size-13" href="#">Read more...</a>

                            <hr class="g-my-20">

                            <ul class="list-inline d-flex justify-content-between mb-0 align-items-center">
                                <li class="list-inline-item g-color-gray-dark-v4">
                                    <a class="favorite favorited">
                                        <i class="fas fa-star fa-2x"></i>
                                        <span class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-text-underline--none--hover"
                                            href="#">57</span>
                                    </a>
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

            <!-- Pagination -->
            <nav id="stickyblock-end" class="text-center" aria-label="Page Navigation">
                <ul class="list-inline">
                    <li class="list-inline-item float-left g-hidden-xs-down">
                        <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                            href="#" aria-label="Previous">
                            <span aria-hidden="true">
                                <i class="fa fa-angle-left g-mr-5"></i> Previous
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="u-pagination-v1__item u-pagination-v1-4 u-pagination-v1-4--active g-rounded-50 g-pa-7-14"
                            href="#">1</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="u-pagination-v1__item u-pagination-v1-4 g-rounded-50 g-pa-7-14" href="#">2</a>
                    </li>
                    <li class="list-inline-item float-right g-hidden-xs-down">
                        <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                            href="#" aria-label="Next">
                            <span aria-hidden="true">
                                Next <i class="fa fa-angle-right g-ml-5"></i>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- End Pagination -->
        </div>
    </div>
    <!-- End Blog Classic Blocks -->

</template>

<script>
    import VueMasonryWall from "vue-masonry-wall";

    export default {
        components: {
            VueMasonryWall
        },

        data() {
            return {
                options: {
                    width: 387,
                    padding: 15,
                },

                items: [],
            }
        },

        mounted () {
            this.fetchProducts();
        },

        methods: {
            fetchProducts() {
                axios.get('/products', { params: this.$route.query })
                    .then(({ data }) => {
                        // console.log(data);
                        this.items = data.data;
                        this.meta = data.meta;
                        this.links = data.links;
                    })
            },
        },
    }
</script>

<style lang="scss" scoped>
@import 'resources/sass/_variables.scss';

    .favorite {
        cursor: pointer;
        color: $gray;
        &.favorited, &.favorited:hover {
            color: $orange;
        }
    }
</style>
