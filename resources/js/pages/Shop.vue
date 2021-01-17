<template>
    <!-- Blog Classic Blocks -->
    <div class="col-lg-9 g-mb-80">
        <div class="g-pr-20--lg">
            <vue-masonry-wall :items="items" :options="options" class="row g-mb-70">
                <template v-slot:default="{item}">
                    <!-- Blog Classic Blocks -->
                    <article class="u-shadow-v11">
                        <img class="img-fluid w-100" src="/unify/assets/img-temp/500x450/img7.jpg"
                            alt="Image Description">
                        <div class="g-bg-white g-pa-30">
                            <span
                                class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">31 MAY 2017</span>
                            <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                    href="#">{{ item.title }}</a>
                            </h2>
                            <p class="g-color-gray-dark-v4 g-line-height-1_8">{{ item.content }}Clark Valberg is the founder and CEO of InVision. If you are a designer...</p>
                            <a class="g-font-size-13" href="#">Read more...</a>

                            <hr class="g-my-20">

                            <ul class="list-inline d-flex justify-content-between mb-0">
                                <li class="list-inline-item g-color-gray-dark-v4">
                                    <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                        href="#">
                                        <i
                                            class="align-middle g-font-size-default mr-1 icon-finance-206 u-line-icon-pro"></i>
                                        10 Comments
                                    </a>
                                </li>
                                <li class="list-inline-item g-color-gray-dark-v4">
                                    <i
                                        class="align-middle g-color-primary g-font-size-default mr-1 icon-medical-022 u-line-icon-pro"></i>
                                    <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                        href="#">57</a>
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
                items: [
                    {
                        title: `In the future, design principles won’t be about design`,
                        content: 'In an attempt to answer those questions, I poured over the biggest collections of design principles on the internet [1][2], and came to the following conclusion.'
                    },
                    {
                        title: `ItemItem 0Item 0Item 0I0`,
                        content: 'waasdasdasdasdasda'
                    },
                    {
                        title: `Itemem 0Item 0Item 0`,
                        content: 'ㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇ'
                    },
                    {
                        title: `ItemItemItem 0Item 0Item 0Item 0Item 0Item 0Item 0`,
                        content: 'ㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇㄴㅁㅇㅁㅇㅁㄴㅇㅁㄴㅇㅁㄴㅇㅁㅁㅁㅁㅈㅇㅁㅈㅇㅇㅇㅇㅇㅇㅇㅁㅈㅇ'
                    },
                ],
            }
        },
    }
</script>
