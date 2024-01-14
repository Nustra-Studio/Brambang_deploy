    <!DOCTYPE html>
    <html lang="en" data-footer="true">
    <head>
        @include('layout.header')
        @stack('custom-style')
    </head>

    <body>
        <div id="root">
        {{-- sidebar --}}
            @include('layout.sidebar')
        <main>
            @yield('content')
        </main>
        <!-- Layout Footer Start -->
            @include('layout.footer')
        <!-- Layout Footer End -->
        </div>

        <!-- Theme Settings Modal Start -->
        {{-- setting --}}
            @include('layout.setting')
        <!-- Search Modal End -->

        <!-- Vendor Scripts Start -->
        <script src="js/vendor/jquery-3.5.1.min.js"></script>
        <script src="js/vendor/bootstrap.bundle.min.js"></script>
        <script src="js/vendor/OverlayScrollbars.min.js"></script>
        <script src="js/vendor/autoComplete.min.js"></script>
        <script src="js/vendor/clamp.min.js"></script>
        <script src="icon/acorn-icons.js"></script>
        <script src="icon/acorn-icons-interface.js"></script>
        <script src="icon/acorn-icons-commerce.js"></script>

        <script src="js/vendor/Chart.bundle.min.js"></script>

        <script src="js/vendor/chartjs-plugin-rounded-bar.min.js"></script>

        <script src="js/vendor/jquery.barrating.min.js"></script>

        <!-- Vendor Scripts End -->
        @stack('custom-scripts')
        <!-- Template Base Scripts Start -->
        <script src="js/base/helpers.js"></script>
        <script src="js/base/globals.js"></script>
        <script src="js/base/nav.js"></script>
        <script src="js/base/search.js"></script>
        <script src="js/base/settings.js"></script>
        <!-- Template Base Scripts End -->
        <!-- Page Specific Scripts Start -->

        <script src="js/cs/charts.extend.js"></script>
        <script src="js/plugin/charts.js"></script>

        <script src="js/pages/dashboard.js"></script>

        <script src="js/common.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Page Specific Scripts End -->
    </body>
    </html>
