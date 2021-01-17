<template>
    <!-- Blog Classic Blocks -->
    <div class="container g-pt-100 g-pb-20">
        <div class="row justify-content-between">
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

            <div class="col-lg-3 g-brd-left--lg g-brd-gray-light-v4 g-mb-80">
                <div class="g-pl-20--lg">
                    <!-- Links -->
                    <div class="g-mb-50">
                        <h3 class="h5 g-color-black g-font-weight-600 mb-4">Links</h3>
                        <ul class="list-unstyled g-font-size-13 mb-0">
                            <li><a class="d-block u-link-v5 g-color-gray-dark-v4 rounded g-px-20 g-py-8" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i> People</a>
                            </li>
                            <li><a class="d-block u-link-v5 g-color-gray-dark-v4 rounded g-px-20 g-py-8" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i> News Publications</a>
                            </li>
                            <li><a class="d-block u-link-v5 g-color-gray-dark-v4 rounded g-px-20 g-py-8" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i> Marketing &amp; IT</a>
                            </li>
                            <li><a class="d-block u-link-v5 g-color-gray-dark-v4 rounded g-px-20 g-py-8" href="#"><i
                                        class="mr-2 fa fa-angle-right"></i> Business Strategy</a>
                            </li>
                            <li><a class="d-block active u-link-v5 g-color-black g-bg-gray-light-v5 g-font-weight-600 g-rounded-50 g-px-20 g-py-8"
                                    href="#"><i class="mr-2 fa fa-angle-right"></i> Untold Stories</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Links -->

                    <hr class="g-brd-gray-light-v4 g-mt-50 mb-0">

                    <div id="stickyblock-start">
                        <div class="js-sticky-block g-sticky-block--lg g-pt-50" data-responsive="true"
                            data-start-point="#stickyblock-start" data-end-point="#stickyblock-end">
                            <!-- Publications -->
                            <div class="g-mb-50">
                                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Publications</h3>
                                <ul class="list-unstyled g-font-size-13 mb-0">
                                    <li>
                                        <article class="media g-mb-35">
                                            <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                                src="/unify/assets/img-temp/100x100/img1.jpg" alt="Image Description">
                                            <div class="media-body">
                                                <h4 class="h6 g-color-black g-font-weight-600">Htmlstream</h4>
                                                <p class="g-color-gray-dark-v4">This is where we sit down, grab a cup of
                                                    coffee and dial in the details.</p>
                                                <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                                    href="#">Follow</a>
                                            </div>
                                        </article>
                                    </li>
                                    <li>
                                        <article class="media g-mb-35">
                                            <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                                src="/unify/assets/img-temp/100x100/img3.jpg" alt="Image Description">
                                            <div class="media-body">
                                                <h4 class="h6 g-color-black g-font-weight-600">Pixeel</h4>
                                                <p class="g-color-gray-dark-v4">This is where we sit down, grab a cup of
                                                    coffee and dial in the details.</p>
                                                <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                                    href="#">Follow</a>
                                            </div>
                                        </article>
                                    </li>
                                    <li>
                                        <article class="media">
                                            <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                                src="/unify/assets/img-temp/100x100/img2.jpg" alt="Image Description">
                                            <div class="media-body">
                                                <h4 class="h6 g-color-black g-font-weight-600">WrapBootstrap</h4>
                                                <p class="g-color-gray-dark-v4">This is where we sit down, grab a cup of
                                                    coffee and dial in the details.</p>
                                                <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                                    href="#">Follow</a>
                                            </div>
                                        </article>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Publications -->

                            <hr class="g-brd-gray-light-v4 g-my-50">

                            <!-- Tags -->
                            <div class="g-mb-40">
                                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Tags</h3>
                                <ul class="u-list-inline mb-0">
                                    <li class="list-inline-item g-mb-10">
                                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                            href="#">Design</a>
                                    </li>
                                    <li class="list-inline-item g-mb-10">
                                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                            href="#">Art</a>
                                    </li>
                                    <li class="list-inline-item g-mb-10">
                                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                            href="#">Graphic</a>
                                    </li>
                                    <li class="list-inline-item g-mb-10">
                                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                            href="#">Front End Development</a>
                                    </li>
                                    <li class="list-inline-item g-mb-10">
                                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                            href="#">CSS</a>
                                    </li>
                                    <li class="list-inline-item g-mb-10">
                                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                            href="#">HTML</a>
                                    </li>
                                    <li class="list-inline-item g-mb-10">
                                        <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                            href="#">Sass</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Tags -->

                            <hr class="g-brd-gray-light-v4 g-my-50">

                            <!-- Newsletter -->
                            <div class="g-mb-50">
                                <h3 class="h5 g-color-black g-font-weight-600 mb-4">Newsletter</h3>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn u-btn-primary g-rounded-left-50 g-py-13 g-px-20">
                                            <i class="icon-communication-062 u-line-icon-pro g-pos-rel g-top-1"></i>
                                        </button>
                                    </span>
                                    <input
                                        class="form-control g-brd-primary g-placeholder-gray-dark-v5 border-left-0 g-rounded-right-50 g-px-15"
                                        type="email" placeholder="Enter your email ...">
                                </div>
                            </div>
                            <!-- End Newsletter -->
                        </div>
                    </div>
                </div>
            </div>
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