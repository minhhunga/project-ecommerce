<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/assets/images') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/chartist/dist/chartist.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        @include('admin.layout.header')
        
        @include('admin.layout.menu-left')

        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>   
    
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>

    <script src="{{ asset('admin/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/dist/js/waves.js') }}"></script>
    <script src="{{ asset('admin/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/pages/dashboards/dashboard1.js') }}"></script>
    <script src="{{ asset('https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js') }}"></script>
    <script> CKEDITOR.replace('demo'); </script>

</body>
</html>