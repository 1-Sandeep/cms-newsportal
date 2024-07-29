<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap/css') }}">
    <!-- Bootstrap Toggle -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/bootstrap-toggle.min.css') }}">
    <!-- Sweet Alert-->
    <link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    {{-- <!-- Google tag (gtag.js) --> --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LV2QJ2N2S6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-LV2QJ2N2S6');
    </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @guest
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                    height="60" width="60">
            </div>
        @endguest

        @auth
            @include('layouts.navigation')

            @include('layouts.sidebar')
        @endauth

        @yield('content')

        @auth
            @include('layouts.footer')
        @endauth

        <!-- jQuery -->
        <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
        <!-- Bootstrap Toggle -->
        <script src="{{ asset('backend/dist/js/bootstrap-toggle.min.js') }}"></script>
        <!-- SweetAlert -->
        <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>

        <!-- Tiny MCE -->
        <script src="https://cdn.tiny.cloud/1/2j5hx44mnplsxletoqoajrmiit0gyisjx212tnwkdi0f0zdv/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea.tinyMCE', // Replace this CSS selector to match the placeholder element for TinyMCE
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });
        </script>
        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

        @if (session('success'))
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}'
                    });
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            </script>
        @endif

        @yield('script')
</body>

</html>
