<template>
    <div id="main">
        <header id="js-header" v-show="$auth.check()" class="u-header u-header--static">
            <navigationMenu></navigationMenu>
        </header>

        <!-- <div id="content">
            <router-view></router-view>
        </div> -->

        <!-- Blog Classic Blocks -->
        <div class="container g-pt-100 g-pb-20">
            <div class="row justify-content-between">
                <div class="col-lg-9 g-mb-80">
                    <div class="g-pr-20--lg">
                        <div class="masonry-grid row g-mb-70">
                            <div class="masonry-grid-sizer col-sm-1"></div>

                            <div class="masonry-grid-item col-sm-6 g-mb-30">
                                <!-- Blog Classic Blocks -->
                                <article class="u-shadow-v11">
                                    <img class="img-fluid w-100" src="unify/assets/img-temp/500x450/img7.jpg"
                                        alt="Image Description">
                                    <div class="g-bg-white g-pa-30">
                                        <span
                                            class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">1
                                            June 2017</span>
                                        <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                            <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                                href="#">Exclusive interview with InVision's CEO</a>
                                        </h2>
                                        <p class="g-color-gray-dark-v4 g-line-height-1_8">Clark Valberg is the founder
                                            and CEO of InVision. If you are a designer...</p>
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
                            </div>

                            <div class="masonry-grid-item col-sm-6 g-mb-30">
                                <!-- Blog Classic Blocks -->
                                <article class="u-shadow-v11">
                                    <!-- Youtube Example -->
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe width="100%" src="//www.youtube.com/embed/Squv4KI751w" frameborder="0"
                                            allowfullscreen></iframe>
                                    </div>
                                    <!-- End Youtube Example -->

                                    <div class="g-bg-white g-pa-30">
                                        <span
                                            class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">29
                                            May 2017</span>
                                        <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                            <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                                href="#">New Rolls Royce Wraith coupe</a>
                                        </h2>
                                        <p class="g-color-gray-dark-v4 g-line-height-1_8">Once someone starts using your
                                            app, they need to know where to go.</p>
                                        <a class="g-font-size-13" href="#">Read more...</a>

                                        <hr class="g-my-20">

                                        <ul class="list-inline d-flex justify-content-between mb-0">
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">
                                                    <i
                                                        class="align-middle g-font-size-default mr-1 icon-finance-206 u-line-icon-pro"></i>
                                                    55 Comments
                                                </a>
                                            </li>
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <i
                                                    class="align-middle g-color-primary g-font-size-default mr-1 icon-medical-022 u-line-icon-pro"></i>
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">99</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <!-- End Blog Classic Blocks -->
                            </div>

                            <div class="masonry-grid-item col-sm-6 g-mb-30">
                                <!-- Blog Classic Blocks -->
                                <article class="u-shadow-v11">
                                    <!-- Facebook Example -->
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe
                                            src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FSpaceX%2Fvideos%2Fvb.353851465130%2F10156509755310131%2F%3Ftype%3D3&show_text=0&width=560"
                                            width="560" height="315" style="border:none;overflow:hidden" scrolling="no"
                                            frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                    <!-- End Facebook Example -->

                                    <div class="g-bg-white g-pa-30">
                                        <span
                                            class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">31
                                            May 2017</span>
                                        <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                            <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                                href="#">In the future, design principles won’t be about design</a>
                                        </h2>
                                        <p class="g-color-gray-dark-v4 g-line-height-1_8">In an attempt to answer those
                                            questions, I poured over the biggest collections of design principles on the
                                            internet [1][2], and came to the following conclusion.</p>
                                        <a class="g-font-size-13" href="#">Read more...</a>

                                        <hr class="g-my-20">

                                        <ul class="list-inline d-flex justify-content-between mb-0">
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">
                                                    <i
                                                        class="align-middle g-font-size-default mr-1 icon-finance-206 u-line-icon-pro"></i>
                                                    2 Comments
                                                </a>
                                            </li>
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <i
                                                    class="align-middle g-color-primary g-font-size-default mr-1 icon-medical-022 u-line-icon-pro"></i>
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">3</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <!-- End Blog Classic Blocks -->
                            </div>

                            <div class="masonry-grid-item col-sm-6 g-mb-30">
                                <!-- Blog Classic Blocks -->
                                <article class="u-shadow-v11">
                                    <img class="img-fluid w-100" src="unify/assets/img-temp/500x450/img1.jpg"
                                        alt="Image Description">
                                    <div class="g-bg-white g-pa-30">
                                        <span
                                            class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">31
                                            May 2017</span>
                                        <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                            <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                                href="#">A UX strategy for the Ultimate Product Launch</a>
                                        </h2>
                                        <p class="g-color-gray-dark-v4 g-line-height-1_8">Product teams working with low
                                            access to users and a long time to market, usually enterprise level
                                            services.</p>
                                        <a class="g-font-size-13" href="#">Read more...</a>

                                        <hr class="g-my-20">

                                        <ul class="list-inline d-flex justify-content-between mb-0">
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">
                                                    <i
                                                        class="align-middle g-font-size-default mr-1 icon-finance-206 u-line-icon-pro"></i>
                                                    76 Comments
                                                </a>
                                            </li>
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <i
                                                    class="align-middle g-color-primary g-font-size-default mr-1 icon-medical-022 u-line-icon-pro"></i>
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">99</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <!-- End Blog Classic Blocks -->
                            </div>

                            <div class="masonry-grid-item col-sm-6 g-mb-30">
                                <!-- Blog Classic Blocks -->
                                <article class="u-shadow-v11">
                                    <img class="img-fluid w-100" src="unify/assets/img-temp/500x450/img9.jpg"
                                        alt="Image Description">
                                    <div class="g-bg-white g-pa-30">
                                        <span
                                            class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">29
                                            May 2017</span>
                                        <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                            <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                                href="#">Accessibility - Apple</a>
                                        </h2>
                                        <p class="g-color-gray-dark-v4 g-line-height-1_8">Apple Watch now has fitness
                                            algorithms designed for wheelchair users. Instead of steps, the Workout.</p>
                                        <a class="g-font-size-13" href="#">Read more...</a>

                                        <hr class="g-my-20">

                                        <ul class="list-inline d-flex justify-content-between mb-0">
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">
                                                    <i
                                                        class="align-middle g-font-size-default mr-1 icon-finance-206 u-line-icon-pro"></i>
                                                    24 Comments
                                                </a>
                                            </li>
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <i
                                                    class="align-middle g-color-primary g-font-size-default mr-1 icon-medical-022 u-line-icon-pro"></i>
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">46</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <!-- End Blog Classic Blocks -->
                            </div>

                            <div class="masonry-grid-item col-sm-6 g-mb-30">
                                <!-- Blog Classic Blocks -->
                                <article class="u-shadow-v11">
                                    <img class="img-fluid w-100" src="unify/assets/img-temp/450x300/img1.jpg"
                                        alt="Image Description">
                                    <div class="g-bg-white g-pa-30">
                                        <span
                                            class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">31
                                            May 2017</span>
                                        <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                                            <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                                href="#">Announcing a free plan for small teams</a>
                                        </h2>
                                        <p class="g-color-gray-dark-v4 g-line-height-1_8">At Wake, our mission has
                                            always been focused on bringing openness and transparency to the design
                                            process.</p>
                                        <a class="g-font-size-13" href="#">Read more...</a>

                                        <hr class="g-my-20">

                                        <ul class="list-inline d-flex justify-content-between mb-0">
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">
                                                    <i
                                                        class="align-middle g-font-size-default mr-1 icon-finance-206 u-line-icon-pro"></i>
                                                    8 Comments
                                                </a>
                                            </li>
                                            <li class="list-inline-item g-color-gray-dark-v4">
                                                <i
                                                    class="align-middle g-color-primary g-font-size-default mr-1 icon-medical-022 u-line-icon-pro"></i>
                                                <a class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-cursor-pointer g-text-underline--none--hover"
                                                    href="#">35</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <!-- End Blog Classic Blocks -->
                            </div>
                        </div>

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
                                    <a class="u-pagination-v1__item u-pagination-v1-4 g-rounded-50 g-pa-7-14"
                                        href="#">2</a>
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
                            <h3 class="h5 g-color-black g-font-weight-600 mb-4">Pages</h3>
                            <ul class="list-unstyled g-font-size-13 mb-0">
                                <li><a class="d-block active u-link-v5 g-color-black g-bg-gray-light-v5 g-font-weight-600 g-rounded-50 g-px-20 g-py-8" href="#">
                                    <i class="mr-2 fa fa-angle-right"></i> 상점</a>
                                </li>
                                <li><a class="d-block u-link-v5 g-color-gray-dark-v4 rounded g-px-20 g-py-8" href="#"><i
                                            class="mr-2 fa fa-angle-right"></i> 공지</a>
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
                                    <h3 class="h5 g-color-black g-font-weight-600 mb-4">Links</h3>
                                    <ul class="list-unstyled g-font-size-13 mb-0">
                                        <li>
                                            <article class="media g-mb-35">
                                                <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                                    src="unify/assets/img-temp/100x100/img1.jpg"
                                                    alt="Image Description">
                                                <div class="media-body">
                                                    <h4 class="h6 g-color-black g-font-weight-600">KakaoTalk</h4>
                                                    <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                                        href="#">Follow</a>
                                                </div>
                                            </article>
                                        </li>
                                        <li>
                                            <article class="media g-mb-35">
                                                <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                                    src="unify/assets/img-temp/100x100/img3.jpg"
                                                    alt="Image Description">
                                                <div class="media-body">
                                                    <h4 class="h6 g-color-black g-font-weight-600">Discord</h4>
                                                    <a class="btn u-btn-outline-primary g-font-size-11 g-rounded-25"
                                                        href="#">Follow</a>
                                                </div>
                                            </article>
                                        </li>
                                        <li>
                                            <article class="media">
                                                <img class="d-flex g-width-40 g-height-40 rounded-circle mr-3"
                                                    src="unify/assets/img-temp/100x100/img2.jpg"
                                                    alt="Image Description">
                                                <div class="media-body">
                                                    <h4 class="h6 g-color-black g-font-weight-600">Telegram</h4>
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
                                                href="#">서든어택</a>
                                        </li>
                                        <li class="list-inline-item g-mb-10">
                                            <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                                href="#">배틀그라운드</a>
                                        </li>
                                        <li class="list-inline-item g-mb-10">
                                            <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                                href="#">메이플스토리</a>
                                        </li>
                                        <li class="list-inline-item g-mb-10">
                                            <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                                href="#">오버워치</a>
                                        </li>
                                        <li class="list-inline-item g-mb-10">
                                            <a class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-rounded-50 g-py-4 g-px-15"
                                                href="#">기타</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Tags -->

                                <hr class="g-brd-gray-light-v4 g-my-50">

                                <!-- Newsletter -->
                                <div class="g-mb-50">
                                    <h3 class="h5 g-color-black g-font-weight-600 mb-4">Inquiry</h3>
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