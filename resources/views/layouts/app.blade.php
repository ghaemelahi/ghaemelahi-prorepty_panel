<!DOCTYPE html>
<html lang="fa">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="HTML5,CSS3,HTML,Template,multi-page,Farol - Bootstrap 5 Admin Dashboard Template">
    <meta name="description" content="Farol - Bootstrap 5 Admin Dashboard Template">
    <meta name="author" content="Barat Hadian">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/selectize.default.min.css') }}">

    <script src="{{ asset('assets/js/selectedsize13.min.js') }}"></script>
    <script src="{{ asset('assets/js/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

    <script>
        function separate(num) {
            num.value = num.value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
    <link rel="stylesheet" href="{{ asset('assets/css/jalaliDatepicker.css') }}">

    <title>@yield('title')</title>

    @yield('styles')
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="preloader">
            <div class="waviy position-relative">
                <span class="d-inline-block">R</span>
                <span class="d-inline-block">A</span>
                <span class="d-inline-block">G</span>
                <span class="d-inline-block">E</span>
                <span class="d-inline-block">H</span>
            </div>
        </div>
    </div>


    @include('layouts.includes.sidebare')


    <div class="container-fluid">
        <div class="main-content d-flex flex-column">

            @include('layouts.includes.header')

            @include('layouts.includes.messages.messages')


            @yield('content')

            <div class="flex-grow-1"></div>
            <footer class="footer-area bg-white text-center rounded-top-10">
                <p class="fs-14">© <span class="text-primary">راگه</span>. تمام حقوق قالب محفوظ است. طراحی و توسعه
                    توسط<a href="#" target="_blank">R A G E H</a></p>
            </footer>

        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/dragdrop.js') }}"></script>
    <script src="{{ asset('assets/js/rangeslider.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/sweetalert.js') }}"></script> --}}
    <script src="{{ asset('assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/prism.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/amcharts.js') }}"></script>
    @if (!request()->routeIs('dashbord'))
        <script src="{{ asset('assets/js/custom/ecommerce-chart.js') }}"></script>
    @endif
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>
    <script src="{{ asset('assets/js/price.js') }}"></script>
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/JalaliDatePicker-main/dist/jalalidatepicker.min.css') }}" />
    <script type="text/javascript" src="{{ asset('assets/JalaliDatePicker-main/dist/jalalidatepicker.min.js') }}"></script>

    <script>
        jalaliDatepicker.startWatch();
    </script>

    {{-- <script>
         $(document).ready(function() {
            $('.selectize-control').selectize({
                sortField: 'text',
                placeholder: 'جستجو خدمت...',
                dropdownParent: 'body'
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "انتخاب کنید...",
                allowClear: true
            });
        });
    </script>



    <script>
        $('.request-type').change(function() {
            if ($(this).val() === 'ejareh') {
                $('.rent-data').removeClass('content-visibility');
                $('.request-price').addClass('content-visibility');
            } else {
                $('.rent-data').addClass('content-visibility');
                $('.request-price').removeClass(['content-visibility']);
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
