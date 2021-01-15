<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- ================== BEGIN BASE JS ================== -->
{{-- <script src="{{ asset('/color/assets/js/theme/default.min.js') }}"></script> --}}
<!-- ================== END BASE JS ================== -->

<!-- JS Implementing Plugins -->
<script src="{{ asset('unify/assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
<script src="{{ asset('unify/assets/vendor/masonry/dist/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('unify/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}">
</script>

<!-- JS Unify -->
<script src="{{ asset('unify/assets/js/hs.core.js') }}"></script>
<script src="{{ asset('unify/assets/js/components/hs.header.js') }}"></script>
<script src="{{ asset('unify/assets/js/helpers/hs.hamburgers.js') }}"></script>
<script src="{{ asset('unify/assets/js/components/hs.tabs.js') }}"></script>
<script src="{{ asset('unify/assets/js/components/hs.sticky-block.js') }}"></script>
<script src="{{ asset('unify/assets/js/components/hs.go-to.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
    $(document).ready(function () {
        // initialization of tabs
        $.HSCore.components.HSTabs.init('[role="tablist"]');
        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

    });

    $(window).on('load', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#js-header'));
        $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            pageContainer: $('.container'),
            breakpoint: 991
        });

        // initialization of masonry
        $('.masonry-grid').imagesLoaded().then(function () {
            $('.masonry-grid').masonry({
                columnWidth: '.masonry-grid-sizer',
                itemSelector: '.masonry-grid-item',
                percentPosition: true
            });
        });

        // initialization of sticky blocks
        setTimeout(function () {
            $.HSCore.components.HSStickyBlock.init('.js-sticky-block');
        }, 300);
    });

    $(window).on('resize', function () {
        setTimeout(function () {
            $.HSCore.components.HSTabs.init('[role="tablist"]');
        }, 200);
    });
</script>

@stack('scripts')
