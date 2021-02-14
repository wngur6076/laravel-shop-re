<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('unify/assets/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
{{-- <script src="{{ asset('unify/assets/vendor/masonry/dist/masonry.pkgd.min.js') }}"></script> --}}
<script src="{{ asset('unify/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}">
</script>

<!-- JS Unify -->
<script src="{{ asset('unify/assets/js/hs.core.js') }}"></script>
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
</script>
<!-- ================== END BASE JS ================== -->

@stack('scripts')
