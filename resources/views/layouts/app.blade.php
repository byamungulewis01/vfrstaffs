<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jul 2023 10:57:01 GMT -->

<head>
    <!--  Title -->
    <title>@yield('title') | Vision Found Rwanda</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Vision Found Rwanda Saving Management System" />
    <meta name="author" content="D'amour UWIZEYE" />
    <meta name="keywords" content="VFRStaffs,Vision Found Rwanda Saving Management System" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/icon2.png') }}" />
    <link rel="stylesheet" href="{{ asset('dist/libs/select2/dist/css/select2.min.css') }}">
    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('dist/libs/jquery-raty-js/lib/jquery.raty.css') }}">
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />

    @yield('css')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/icon2.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/icon2.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>

                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ route('home') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('assets/logo.jpg') }}" class="dark-logo" width="220" alt="" />
                        <img src="{{ asset('assets/logo.jpg') }}" class="light-logo" width="220" alt="" />
                    </a>
                    <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8 text-muted"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                @if (auth()->user()->role == '0')
                    @include('layouts.sidebar')
                @elseif(auth()->user()->role == '1')
                    @include('layouts.approval-sidebar')
                @else
                    @include('layouts.member-sidebar')
                @endif
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                @include('layouts.navbar')
            </header>

            <!--  Header End -->
            <div class="container-fluid">
                @yield('body')
            </div>
        </div>
    </div>

    <!--  Customizer -->
    <!--  Import Js Files -->
    <script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--  core files -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <script src="{{ asset('dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dist/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('dist/js/plugins/toastr-init.js') }}"></script>
    <script>
        function disableSubmitButton() {
            document.getElementById('submitButton').disabled = true;
        }
    </script>

    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
            @if (Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
            @if (Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}");
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
        });
        // document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
    @yield('script')

</body>

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jul 2023 10:58:20 GMT -->

</html>
