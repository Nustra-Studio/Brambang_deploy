    <!DOCTYPE html>
    <html lang="en" data-footer="true">
    <head>
        @include('layout.header')
        @stack('custom-style')
        <script>
            function showAlert(icon, message) {
                Swal.fire({
                    icon: icon,
                    title: message,
                });
            }
        </script>
    </head>

    <body>
        <div id="root">
        {{-- sidebar --}}
            @include('layout.sidebar')
        <main>
            @yield('content')
        </main>
        <!-- Layout Footer Start -->
        <div class="modal fade" id="settingpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>
            @include('layout.footer')
        <!-- Layout Footer End -->
        </div>

        <!-- Theme Settings Modal Start -->
        {{-- setting --}}
            @include('layout.setting')
        <!-- Search Modal End -->

     <!-- Vendor Scripts Start -->
<script src="{{ asset('js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/vendor/OverlayScrollbars.min.js') }}"></script>
<script src="{{ asset('js/vendor/autoComplete.min.js') }}"></script>
<script src="{{ asset('js/vendor/clamp.min.js') }}"></script>
<script src="{{ asset('icon/acorn-icons.js') }}"></script>
<script src="{{ asset('icon/acorn-icons-interface.js') }}"></script>
<script src="{{ asset('icon/acorn-icons-commerce.js') }}"></script>
<script src="{{ asset('js/vendor/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('js/vendor/chartjs-plugin-rounded-bar.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.barrating.min.js') }}"></script>

<!-- Vendor Scripts End -->

@stack('custom-scripts')

<!-- Template Base Scripts Start -->
<script src="{{ asset('js/base/helpers.js') }}"></script>
<script src="{{ asset('js/base/globals.js') }}"></script>
<script src="{{ asset('js/base/nav.js') }}"></script>
<script src="{{ asset('js/base/search.js') }}"></script>
<script src="{{ asset('js/base/settings.js') }}"></script>
<!-- Template Base Scripts End -->

<!-- Page Specific Scripts Start -->
<script src="{{ asset('js/cs/charts.extend.js') }}"></script>
<script src="{{ asset('js/plugin/charts.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

        <!-- Page Specific Scripts End -->
    </body>
    </html>
